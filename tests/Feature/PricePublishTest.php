<?php

namespace Tests\Feature;

use App\Models\Price;
use App\Models\PricePublication;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PricePublishTest extends TestCase
{
    public function test_price_publication_creates_snapshot_and_clears_cache()
    {
        $admin = User::role('Administrator')->where('is_active', true)->first();
        if (!$admin) {
            $admin = User::first();
        }

        $this->actingAs($admin);

        Cache::put('public_prices', 'cached_content', 3600);

        $prices = Price::where('is_active', true)->get();
        $snapshot = $prices->map(fn ($p) => [
            'id' => $p->id,
            'material' => $p->material,
            'recycler_min' => $p->recycler_min,
            'recycler_max' => $p->recycler_max,
        ])->toArray();

        $pub = PricePublication::create([
            'user_id' => $admin->id,
            'snapshot' => $snapshot,
            'change_summary' => 'Test publication snapshot',
            'published_at' => now(),
        ]);

        $this->assertDatabaseHas('price_publications', [
            'id' => $pub->id,
            'user_id' => $admin->id,
        ]);

        $this->assertNotEmpty($pub->snapshot);
        $this->assertFalse(Cache::has('public_prices'));
    }
}

