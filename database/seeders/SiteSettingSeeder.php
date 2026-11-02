<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::set('hero', [
            'eyebrow' => 'Extended Producer Responsibility in Action',
            'headline' => 'Powering Kenya\'s Circular Packaging Economy',
            'text' => 'PAKPRO brings together brand owners, retailers, aggregators, and recyclers to collect, sort, and process post-consumer packaging across Kenya.',
            'btn1_label' => 'Join PAKPRO',
            'btn1_url' => 'https://epr.pakpro.co.ke',
            'btn2_label' => 'Our Programmes',
            'btn2_url' => '#programmes',
            'hero_video' => 'assets/video/hero.mp4',
            'hero_poster' => 'logo/PAKPRO Logo_No background.png',
        ]);

        SiteSetting::set('marquee_items', [
            'Industry-led. Not-for-profit. Since 2018.',
            '500+ member companies',
            'KES 225M+ paid to aggregators and waste pickers',
            'Your PRO of Choice!',
        ]);

        SiteSetting::set('counters', [
            [
                'prefix' => '',
                'number' => '500',
                'suffix' => '+',
                'label' => 'Member Companies',
            ],
            [
                'prefix' => 'KES ',
                'number' => '225',
                'suffix' => 'M+',
                'label' => 'Paid to Aggregators & Waste Pickers',
            ],
            [
                'prefix' => '',
                'number' => '47',
                'suffix' => '',
                'label' => 'Counties Active',
            ],
            [
                'prefix' => '',
                'number' => '85',
                'suffix' => '%',
                'label' => 'Recovery Target by 2030',
            ],
        ]);

        SiteSetting::set('contact', [
            'phone' => '+254 700 000 000',
            'email' => 'info@pakpro.co.ke',
            'address' => 'Nairobi, Kenya',
            'whatsapp' => '+254 700 000 000',
            'map_link' => 'https://maps.google.com',
            'office_hours' => 'Mon – Fri, 8:00 AM – 5:00 PM EAT',
        ]);

        SiteSetting::set('social_links', [
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/company/pakpro-kenya'],
            ['platform' => 'X / Twitter', 'url' => 'https://twitter.com/pakprokenya'],
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/pakprokenya'],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com/@pakprokenya'],
        ]);
    }
}

