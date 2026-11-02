<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Open questions logged for staff review:
     * 1. PET strapping (closed loop) prices missing.
     * 2. Milk pouches values are identical to Monolayer flexibles (confirm).
     * 3. "Quincha" and "Gunias" regional packaging wording to confirm.
     */
    public function run(): void
    {
        $prices = [
            [
                'material' => 'PET / Quincha',
                'recycler_min' => 18,
                'recycler_max' => 23,
                'aggregator_min' => 10,
                'aggregator_max' => 23,
                'note' => 'Wording "Quincha" to confirm',
                'sort_order' => 1,
            ],
            [
                'material' => 'Coloured PET',
                'recycler_min' => 10,
                'recycler_max' => 10,
                'aggregator_min' => 10,
                'aggregator_max' => 10,
                'note' => null,
                'sort_order' => 2,
            ],
            [
                'material' => 'UBC (used beverage cartons) / Tetra Pak cartons',
                'recycler_min' => 8,
                'recycler_max' => 8,
                'aggregator_min' => 4,
                'aggregator_max' => 5,
                'note' => null,
                'sort_order' => 3,
            ],
            [
                'material' => 'PP thermoform',
                'recycler_min' => 35,
                'recycler_max' => 45,
                'aggregator_min' => 34,
                'aggregator_max' => 44,
                'note' => null,
                'sort_order' => 4,
            ],
            [
                'material' => 'Laminates',
                'recycler_min' => 10,
                'recycler_max' => 10,
                'aggregator_min' => 8,
                'aggregator_max' => 8,
                'note' => null,
                'sort_order' => 5,
            ],
            [
                'material' => 'Sugar pouches',
                'recycler_min' => 11,
                'recycler_max' => 16,
                'aggregator_min' => 10,
                'aggregator_max' => 15,
                'note' => null,
                'sort_order' => 6,
            ],
            [
                'material' => 'PET strapping (closed loop)',
                'recycler_min' => null,
                'recycler_max' => null,
                'aggregator_min' => null,
                'aggregator_max' => null,
                'note' => 'PET strapping prices missing from initial schedule',
                'sort_order' => 7,
            ],
            [
                'material' => 'Paper and corrugates',
                'recycler_min' => 20,
                'recycler_max' => 30,
                'aggregator_min' => 5,
                'aggregator_max' => 20,
                'note' => null,
                'sort_order' => 8,
            ],
            [
                'material' => 'Glass',
                'recycler_min' => 3,
                'recycler_max' => 5,
                'aggregator_min' => 2,
                'aggregator_max' => 2,
                'note' => null,
                'sort_order' => 9,
            ],
            [
                'material' => 'Gunias',
                'recycler_min' => 12,
                'recycler_max' => 20,
                'aggregator_min' => 11,
                'aggregator_max' => 19,
                'note' => 'Wording "Gunias" to confirm',
                'sort_order' => 10,
            ],
            [
                'material' => 'Hard plastic (HDPE/PP/LDPE rigid)',
                'recycler_min' => 22,
                'recycler_max' => 40,
                'aggregator_min' => 22,
                'aggregator_max' => 35,
                'note' => null,
                'sort_order' => 11,
            ],
            [
                'material' => 'Monolayer flexibles',
                'recycler_min' => 19,
                'recycler_max' => 34,
                'aggregator_min' => 18,
                'aggregator_max' => 33,
                'note' => null,
                'sort_order' => 12,
            ],
            [
                'material' => 'Milk pouches',
                'recycler_min' => 19,
                'recycler_max' => 34,
                'aggregator_min' => 18,
                'aggregator_max' => 33,
                'note' => 'Milk pouches values identical to Monolayer flexibles (confirm)',
                'sort_order' => 13,
            ],
            [
                'material' => 'Bread / tissue bags',
                'recycler_min' => 16,
                'recycler_max' => 22,
                'aggregator_min' => 15,
                'aggregator_max' => 21,
                'note' => null,
                'sort_order' => 14,
            ],
            [
                'material' => 'Polystyrene',
                'recycler_min' => 11,
                'recycler_max' => 16,
                'aggregator_min' => 10,
                'aggregator_max' => 15,
                'note' => null,
                'sort_order' => 15,
            ],
        ];

        foreach ($prices as $p) {
            Price::updateOrCreate(
                ['material' => $p['material']],
                array_merge($p, [
                    'slug' => Str::slug($p['material']),
                    'is_active' => true,
                ])
            );
        }

        // NOTE: As explicitly instructed, DO NOT create a price_publications row
        // so the public site correctly displays "Last updated: date to be confirmed"
        // until an authorized staff member publishes through the admin.
    }
}

