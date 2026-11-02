<?php

namespace Tests\Feature;

use App\Models\Price;
use Tests\TestCase;

class PublicWebsiteTest extends TestCase
{
    public function test_public_homepage_renders_and_contains_mypakpro_login_pointing_to_backend()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Ensure My PAKPRO login links to /admin
        $content = $response->getContent();
        $this->assertStringContainsString('My PAKPRO login', $content);
        $this->assertStringContainsString('/admin', $content);

        // Ensure prices table contains seeded material
        $this->assertStringContainsString('PET / Quincha', $content);
    }

    public function test_contact_form_submission_with_honeypot_blocking()
    {
        // Normal legitimate submission
        $response = $this->post('/contact', [
            'name' => 'John Kamau',
            'email' => 'john.kamau@example.com',
            'phone' => '+254712345678',
            'subject' => 'Recycling Inquiry',
            'message' => 'Hello, I want to learn more about PAKPRO recycling programs.',
            'website_hp' => '', // honeypot left blank
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Bot submission with filled honeypot
        $botResponse = $this->post('/contact', [
            'name' => 'Spam Bot',
            'email' => 'spambot@example.com',
            'message' => 'Buy cheap links now',
            'website_hp' => 'http://spam-link.com', // honeypot filled!
        ]);

        $botResponse->assertStatus(422);
    }
}

