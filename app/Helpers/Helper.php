<?php

namespace App\Helpers;

use App\Models\UserConsumePackageItem;

class Helper
{
    public static function availableRefreshes()
    {
        return UserConsumePackageItem::where('user_id', auth()->id())
                    ->sum('qty');
    }
    public static function usedRefreshes()
    {
        return UserConsumePackageItem::where('user_id', auth()->id())
                    ->sum('used');
    }
}
