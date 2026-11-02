<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\Highlight;
use App\Models\Price;
use App\Models\PricePublication;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;

class PublicHomeController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->query('month', Carbon::now()->format('Y-m'));

        // Validate YYYY-MM format
        if (!preg_match('/^\d{4}-\d{2}$/', $selectedMonth)) {
            $selectedMonth = Carbon::now()->format('Y-m');
        }

        $cacheKey = "homepage_data_month_{$selectedMonth}";

        $data = Cache::remember($cacheKey, 3600, function () use ($selectedMonth) {
            $hero = SiteSetting::get('hero', [
                'eyebrow' => 'Packaging Producer Responsibility Organisation',
                'headline' => 'Your PRO of Choice!',
                'text' => 'PAKPRO is an industry-led, not-for-profit organisation working with businesses, communities and waste actors to collect, recover and recycle post-consumer packaging in Kenya.',
                'btn1_label' => 'Join PAKPRO',
                'btn1_url' => 'https://epr.pakpro.co.ke',
                'btn2_label' => 'How EPR works',
                'btn2_url' => '#epr',
                'hero_video' => 'assets/video/hero.mp4',
                'hero_poster' => 'logo/PAKPRO Logo_No background.png',
            ]);

            $marqueeItems = SiteSetting::get('marquee_items', [
                'Industry-led. Not-for-profit. Since 2018.',
                '500+ member companies',
                'KES 225M+ paid to aggregators and waste pickers',
                'Your PRO of Choice!',
            ]);

            $counters = SiteSetting::get('counters', [
                ['prefix' => '', 'number' => '500', 'suffix' => '+', 'label' => 'member companies'],
                ['prefix' => '', 'number' => '43', 'suffix' => '+', 'label' => 'packaging material streams'],
                ['prefix' => 'KES ', 'number' => '225', 'suffix' => 'M+', 'label' => 'paid to aggregators and waste pickers'],
                ['prefix' => '', 'number' => '2018', 'suffix' => '', 'label' => 'year PAKPRO was incorporated'],
            ]);

            $contact = SiteSetting::get('contact', [
                'phone' => '+254 700 000 000',
                'email' => 'info@pakpro.co.ke',
                'address' => 'Nairobi, Kenya',
                'whatsapp' => '+254 700 000 000',
                'map_link' => '#',
                'office_hours' => 'Mon – Fri, 8:00 AM – 5:00 PM EAT',
            ]);

            $socialLinks = SiteSetting::get('social_links', []);

            // Prices
            $prices = Price::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->get();

            // Latest Price Publication
            $latestPublication = PricePublication::latestPublication();
            $lastUpdated = $latestPublication
                ? $latestPublication->published_at->format('j F Y')
                : null;

            // Highlights
            $allowPlaceholders = config('app.allow_placeholder_highlights_on_public', false);
            $startOfMonth = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth()->toDateString();

            $highlightsBase = Highlight::where('month', $startOfMonth)
                ->where('status', 'published')
                ->when(!$allowPlaceholders, function ($q) {
                    $q->where('is_placeholder', false);
                });

            $policyHighlights = (clone $highlightsBase)->where('type', 'policy')->take(3)->get();
            $projectsHighlights = (clone $highlightsBase)->where('type', 'projects')->take(3)->get();
            $bccHighlights = (clone $highlightsBase)->where('type', 'bcc')->take(3)->get();

            // Available months for picker
            $availableMonths = Highlight::where('status', 'published')
                ->when(!$allowPlaceholders, function ($q) {
                    $q->where('is_placeholder', false);
                })
                ->selectRaw('DISTINCT month')
                ->orderBy('month', 'desc')
                ->pluck('month')
                ->map(fn($d) => Carbon::parse($d)->format('Y-m'))
                ->unique()
                ->values()
                ->toArray();

            if (empty($availableMonths)) {
                $availableMonths = [Carbon::now()->format('Y-m')];
            }

            return compact(
                'hero',
                'marqueeItems',
                'counters',
                'contact',
                'socialLinks',
                'prices',
                'lastUpdated',
                'policyHighlights',
                'projectsHighlights',
                'bccHighlights',
                'availableMonths'
            );
        });

        return view('public.index', array_merge($data, [
            'selectedMonth' => $selectedMonth,
            'selectedMonthFormatted' => Carbon::createFromFormat('Y-m', $selectedMonth)->format('F Y'),
        ]));
    }

    public function submitContact(Request $request)
    {
        // 1. Honeypot check
        if (!empty($request->input('website')) || !empty($request->input('bot_field')) || !empty($request->input('website_hp'))) {
            abort(422, 'Spam detected');
        }

        // 2. Rate limiting (max 5 requests per 10 minutes per IP)
        $ip = $request->ip();
        $rateLimitKey = 'contact_form:' . $ip;
        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return redirect()->back()
                ->withErrors(['rate_limit' => "Too many submissions. Please try again in {$seconds} seconds."])
                ->withInput();
        }
        RateLimiter::hit($rateLimitKey, 600);

        // 3. Validation
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:3000',
        ]);

        // 4. Sanitize
        $cleanData = [
            'name' => strip_tags(trim($validated['name'])),
            'email' => filter_var(trim($validated['email']), FILTER_SANITIZE_EMAIL),
            'subject' => strip_tags(trim($validated['subject'] ?? 'General Enquiry')),
            'message' => htmlspecialchars(trim($validated['message']), ENT_QUOTES, 'UTF-8'),
        ];

        // 5. Store
        FormSubmission::create([
            'type' => 'contact',
            'data' => $cleanData,
            'is_anonymous' => false,
            'ip_address' => $ip,
            'user_agent' => $request->userAgent(),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Thank you for your message! Our team will contact you shortly.');
    }
}

