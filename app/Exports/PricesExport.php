<?php

namespace App\Exports;

use App\Models\Price;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PricesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Price::orderBy('sort_order')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Material',
            'Slug',
            'Recycler Min',
            'Recycler Max',
            'Aggregator Min',
            'Aggregator Max',
            'Note',
            'Sort Order',
            'Is Active',
        ];
    }

    public function map($price): array
    {
        return [
            $price->id,
            $price->material,
            $price->slug,
            $price->recycler_min,
            $price->recycler_max,
            $price->aggregator_min,
            $price->aggregator_max,
            $price->note,
            $price->sort_order,
            $price->is_active ? 1 : 0,
        ];
    }
}

