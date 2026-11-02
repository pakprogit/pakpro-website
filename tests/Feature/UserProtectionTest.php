<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class UserProtectionTest extends TestCase
{
    public function test_system_protects_minimum_two_administrators()
    {
        $adminCount = User::countActiveAdministrators();
        $this->assertGreaterThanOrEqual(2, $adminCount, 'At least 2 active administrators must exist');
    }

    public function test_invitation_token_flow_and_expiry()
    {
        $user = User::create([
            'username' => 'invitee_' . uniqid(),
            'name' => 'Invitee User',
            'email' => 'invitee_' . uniqid() . '@pakpro.co.ke',
            'password_hash' => bcrypt('TempPass123!'),
            'role' => 'Price editor',
            'is_active' => true,
            'invitation_token' => 'valid-test-token-' . uniqid(),
            'invitation_expires_at' => now()->addHours(48),
        ]);

        $response = $this->get("/invitation/{$user->invitation_token}");
        $response->assertStatus(200);

        // Expired token test
        $user->invitation_expires_at = now()->subHour();
        $user->save();

        $expiredResponse = $this->get("/invitation/{$user->invitation_token}");
        $expiredResponse->assertStatus(410);
    }
}

