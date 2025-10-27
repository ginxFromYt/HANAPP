<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
   protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        return route('admin.login'); // ← this ensures admin login route is used
    }
}
public function update(Request $request, FoodSpot $foodspot)
{
    \Log::info('Update method hit', $request->all());  // Check laravel.log for this line
    // ... your existing code
}

}