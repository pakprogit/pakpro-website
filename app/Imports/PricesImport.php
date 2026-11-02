<?php

namespace App\Imports;

use App\Models\Price;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PricesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $material = $row['material'] ?? null;
        if (!$material) {
            return null;
        }

        $slug = $row['slug'] ?? \Illuminate\Support\Str::slug($material);

        return Price::updateOrCreate(
            ['slug' => $slug],
            [
                'material'       => $material,
                'recycler_min'   => is_numeric($row['recycler_min'] ?? null) ? $row['recycler_min'] : null,
                'recycler_max'   => is_numeric($row['recycler_max'] ?? null) ? $row['recycler_max'] : null,
                'aggregator_min' => is_numeric($row['aggregator_min'] ?? null) ? $row['aggregator_min'] : null,
                'aggregator_max' => is_numeric($row['aggregator_max'] ?? null) ? $row['aggregator_max'] : null,
                'note'           => $row['note'] ?? null,
                'sort_order'     => $row['sort_order'] ?? 0,
                'is_active'      => isset($row['is_active']) ? (bool)$row['is_active'] : true,
            ]
        );
    }

    public function rules(): array
    {
        return [
            'material' => 'required',
            'recycler_min' => 'nullable|numeric',
            'recycler_max' => 'nullable|numeric',
            'aggregator_min' => 'nullable|numeric',
            'aggregator_max' => 'nullable|numeric',
        ];
    }
}

