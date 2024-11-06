<?php

namespace App\Http\Helpers;

use App\Jobs\SendEmail;
use Carbon\Carbon;

class GeneralHelper
{
    public static function bindAppliedFilter(&$appliedFilters)
    {
        $appliedFilters['category'] = 'Luxury';
        switch (request()->path()) {
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

    public static function sortOption(&$query)
    {
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
    public static function sendEmail(array $user, string $template, string $subject, $password = null, $otp = null)
    {
        $extra = [];
        $extra['userDetails'] = $user;
        $extra['send_to'] = $extra['userDetails']['email'];
        if ($password) {
            $extra['userDetails']['email_password'] = $password;
        }
        if ($otp) {
            $extra['userDetails']['otp_code'] = $otp;
        }

        $emailJob = (
            new SendEmail(
                env('MAIL_FROM_ADDRESS'),
                env('MAIL_FROM_NAME'),
                $subject,
                $template,
                'registration',
                $extra
            ));
        dispatch($emailJob);
    }
    
    public static function sendAdminEmail(array $user, string $template, string $subject, $password = null)
    {
        $extra = [];
        $extra['userDetails'] = $user;
        $extra['send_to'] = $extra['userDetails']['email'];
        if ($password) {
            $extra['userDetails']['email_password'] = $password;
        }

        $emailJob = (
            new SendEmail(
                env('MAIL_FROM_ADDRESS'),
                env('MAIL_FROM_NAME'),
                $subject,
                $template,
                'registration',
                $extra
            ))->delay(Carbon::now()->addSeconds(1));
        dispatch($emailJob);
    }
}
