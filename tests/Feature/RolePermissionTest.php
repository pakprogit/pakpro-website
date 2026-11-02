<?php

namespace Tests\Feature;

use App\Models\Highlight;
use App\Models\Price;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_price_editor_cannot_access_highlights()
    {
        $priceEditor = User::where('email', 'price.editor@pakpro.co.ke')->first();
        if (!$priceEditor) {
            $priceEditor = User::create([
                'username' => 'peditor',
                'name' => 'Price Editor',
                'email' => 'price.editor@pakpro.co.ke',
                'password_hash' => bcrypt('Password123!'),
                'role' => 'Price editor',
                'is_active' => true,
            ]);
            $priceEditor->assignRole('Price editor');
        }

        $this->actingAs($priceEditor);

        $response = $this->get('/admin/highlights');
        $this->assertContains($response->status(), [403, 302]);
        if ($response->status() === 302) {
            $response->assertRedirect('/admin');
        }
    }

    public function test_price_editor_cannot_access_users()
    {
        $priceEditor = User::where('email', 'price.editor@pakpro.co.ke')->first();
        if (!$priceEditor) {
            $priceEditor = User::create([
                'username' => 'peditor2',
                'name' => 'Price Editor 2',
                'email' => 'price.editor@pakpro.co.ke',
                'password_hash' => bcrypt('Password123!'),
                'role' => 'Price editor',
                'is_active' => true,
            ]);
            $priceEditor->assignRole('Price editor');
        }

        $this->actingAs($priceEditor);

        $response = $this->get('/admin/users');
        $this->assertContains($response->status(), [403, 302]);
        if ($response->status() === 302) {
            $response->assertRedirect('/admin');
        }
    }

    public function test_communications_editor_cannot_access_users()
    {
        $commsEditor = User::where('email', 'comms.editor@pakpro.co.ke')->first();
        if (!$commsEditor) {
            $commsEditor = User::create([
                'username' => 'ceditor',
                'name' => 'Comms Editor',
                'email' => 'comms.editor@pakpro.co.ke',
                'password_hash' => bcrypt('Password123!'),
                'role' => 'Communications editor',
                'is_active' => true,
            ]);
            $commsEditor->assignRole('Communications editor');
        }

        $this->actingAs($commsEditor);

        $response = $this->get('/admin/users');
        $this->assertContains($response->status(), [403, 302]);
        if ($response->status() === 302) {
            $response->assertRedirect('/admin');
        }
    }
}

