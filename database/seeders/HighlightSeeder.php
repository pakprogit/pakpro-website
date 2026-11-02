<?php

namespace Database\Seeders;

use App\Models\Highlight;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HighlightSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $adminId = $admin ? $admin->id : 1;
        $currentMonth = '2026-11-01';

        $placeholders = [
            // Policy tab (3 items)
            [
                'type' => 'policy',
                'month' => $currentMonth,
                'title' => 'National EPR Framework Alignment',
                'summary' => 'Stakeholder consultations advancing compliance reporting under Kenya Environmental Management and Coordination Act.',
                'media_type' => 'video',
                'video_url' => 'assets/video/hero.mp4',
                'poster' => 'mascot_assets/pakpro-04-teaching.png',
                'alt_text' => 'Policy briefing on Extended Producer Responsibility regulations',
                'link_url' => '#policy',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],
            [
                'type' => 'policy',
                'month' => $currentMonth,
                'title' => 'County Waste Segregation Directives',
                'summary' => 'Harmonizing county-level buyback centres and licensing with national recycling targets.',
                'media_type' => 'image',
                'video_url' => null,
                'poster' => null,
                'alt_text' => 'County government officials in waste management session',
                'link_url' => '#policy',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],
            [
                'type' => 'policy',
                'month' => $currentMonth,
                'title' => 'Producer Compliance Certification Standard',
                'summary' => 'Guidelines for producers on calculating obligated packaging tonnage and audit validation.',
                'media_type' => 'image',
                'video_url' => null,
                'poster' => null,
                'alt_text' => 'Compliance guide documentation overview',
                'link_url' => '#policy',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],

            // Projects & Partnerships tab (3 items)
            [
                'type' => 'projects',
                'month' => $currentMonth,
                'title' => 'Aggregator Hub Modernisation',
                'summary' => 'Equipping regional baling stations with high-capacity digital scales and health safeguards.',
                'media_type' => 'image',
                'video_url' => null,
                'poster' => null,
                'alt_text' => 'New baling equipment installed at regional aggregator station',
                'link_url' => '#projects',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],
            [
                'type' => 'projects',
                'month' => $currentMonth,
                'title' => 'Direct Buyback Station Expansion',
                'summary' => 'Launching 15 collection outposts across coastal and peri-urban packaging corridors.',
                'media_type' => 'video',
                'video_url' => 'assets/video/hero.mp4',
                'poster' => 'mascot_assets/pakpro-14-carrying-waste.png',
                'alt_text' => 'Community collection outpost in operation',
                'link_url' => '#projects',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],
            [
                'type' => 'projects',
                'month' => $currentMonth,
                'title' => 'Closed-Loop PET Strapping Pilot',
                'summary' => 'Validating food-grade and industrial rPET quality alongside industrial manufacturing partners.',
                'media_type' => 'image',
                'video_url' => null,
                'poster' => null,
                'alt_text' => 'Recycled PET flakes and strapping production demo',
                'link_url' => '#projects',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],

            // BCC Campaigns tab (3 items)
            [
                'type' => 'bcc',
                'month' => $currentMonth,
                'title' => 'Biz-na-Taka Grassroots Drive',
                'summary' => 'Empowering waste collector networks with financial inclusion, pricing transparency and safety kit distribution.',
                'media_type' => 'image',
                'video_url' => null,
                'poster' => null,
                'alt_text' => 'Biz-na-Taka community engagement event with waste collectors',
                'link_url' => '#bcc',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],
            [
                'type' => 'bcc',
                'month' => $currentMonth,
                'title' => 'School Recycling Champion Challenge',
                'summary' => 'Engaging over 100 secondary schools with interactive separation bins and green club curriculum.',
                'media_type' => 'video',
                'video_url' => 'assets/video/hero.mp4',
                'poster' => 'mascot_assets/pakpro-03-champion.png',
                'alt_text' => 'Students showcasing collected recyclable materials',
                'link_url' => '#bcc',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],
            [
                'type' => 'bcc',
                'month' => $currentMonth,
                'title' => 'Household Segregation Radio & Digital Series',
                'summary' => 'Kiswahili and vernacular campaigns educating consumers on rinsing and sorting post-consumer packaging.',
                'media_type' => 'image',
                'video_url' => null,
                'poster' => null,
                'alt_text' => 'Radio presenter with PAKPRO waste sorting infographic',
                'link_url' => '#bcc',
                'status' => 'published',
                'published_at' => Carbon::now(),
                'created_by' => $adminId,
                'is_placeholder' => true,
            ],
        ];

        foreach ($placeholders as $item) {
            Highlight::create($item);
        }
    }
}

