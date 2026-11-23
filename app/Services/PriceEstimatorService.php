<?php

namespace App\Services;

use App\Models\Product;
class PriceEstimatorService
{
    public function estimate(
        Product $product,
        array $optionValueIds,
        array $addOnIds
    ): array {
        $optionValues = $product->personalizationOptions()
            ->with(['values' => function ($query) use ($optionValueIds) {
                $query->where('is_available', true)
                    ->whereIn('id', $optionValueIds);
            }])
            ->get()
            ->flatMap(fn ($option) => $option->values);

        $selectedAddOns = $product->addOns()
            ->where('is_available', true)
            ->whereIn('add_ons.id', $addOnIds)
            ->get();

        $basePrice = (float) $product->price;
        $personalizationTotal = (float) $optionValues->sum('additional_price');
        $addOnTotal = (float) $selectedAddOns->sum('price');
        $estimatedTotal = $basePrice + $personalizationTotal + $addOnTotal;

        return [
            'base_price' => $basePrice,
            'personalization_total' => $personalizationTotal,
            'add_on_total' => $addOnTotal,
            'estimated_total' => $estimatedTotal,
            'option_values' => $optionValues->map(fn ($value) => [
                'id' => $value->id,
                'name' => $value->value_name,
                'additional_price' => (float) $value->additional_price,
            ])->values(),
            'add_ons' => $selectedAddOns->map(fn ($addOn) => [
                'id' => $addOn->id,
                'name' => $addOn->name,
                'price' => (float) $addOn->price,
            ])->values(),
        ];
    }
}
