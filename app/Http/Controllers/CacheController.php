<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function clearAllCache()
    {
        // Clear application cache
        Artisan::call('cache:clear');
        
        // Clear route cache
        Artisan::call('route:clear');

        // Clear config cache
        Artisan::call('config:clear');

        // Clear view cache
        Artisan::call('view:clear');

        return response()->json(['message' => 'All cache cleared successfully']);
    }
}
