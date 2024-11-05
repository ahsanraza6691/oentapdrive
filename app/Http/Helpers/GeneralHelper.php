<?php

namespace App\Http\Helpers;


class GeneralHelper
{
    public static function bindAppliedFilter(&$appliedFilters) {
        $appliedFilters['category'] = 'Luxury';
        switch(request()->path()) {
            case 'luxury-car-rental-dubai':
                $appliedFilters['category'] = 'Luxury';
                break;
            case 'rent-cheap-economy-cars-dubai':
                $appliedFilters['category'] = 'Economy';
                break;
            case 'rent-sports-cars-in-dubai':
                $appliedFilters['category'] = 'Sports Car';
                break;
            case 'rent-special-edition-car-dubai':
                $appliedFilters['category'] = 'Special Edition';
                break;
            case 'rent-muscles-cars-in-dubai':
                $appliedFilters['category'] = 'Muscles Cars';
                break;
            case 'rent-hybrid-electrical-cars-dubai':
                $appliedFilters['category'] = 'Electric Cars';
                break;
            default:
                $appliedFilters['category'] = request()->route('type') != null ? request()->route('type') : request()->route('brand');
                break;
        }
        if ($sortOption = request()->get('sort')) {
            $appliedFilters['sort'] = ucfirst(str_replace('_', ' ', $sortOption)); // Store selected sort option
        }
    }

    public static function sortOption(&$query) {
        $sortOption = request()->get('sort');
        switch ($sortOption) {
            case 'daily_high_to_low':
                $query->orderBy('price_per_day', 'desc');
                break;
            case 'daily_low_to_high':
                $query->orderBy('price_per_day', 'asc');
                break;
            case 'weekly_low_to_high':
                $query->orderBy('weekly_rent', 'asc');
                break;
            case 'monthly_low_to_high':
                $query->orderBy('monthly_extra', 'desc');
                break;
            case 'passengers_low_to_high':
                $query->orderBy('passengers', 'asc');
                break;
            case 'passengers_high_to_low':
                $query->orderBy('passengers', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('updated_at', 'desc');
                break;
        }
    }
}