<?php

namespace App\Helpers;

use App\Models\UserConsumePackageItem;
use Illuminate\Support\Facades\DB;

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

    public static function getCategoryTitleBySlug()
    {
        $slug = request()->segment(count(request()->segments()));
        $category = DB::table('categories')->where('slug', $slug)->first();
        return $category ? $category->title : null;
    }

    public static function getCategoryDescriptionBySlug()
    {
        $slug = request()->segment(count(request()->segments()));
        $category = DB::table('categories')->where('slug', $slug)->first();
        return $category ? $category->description : null;
    }
}
