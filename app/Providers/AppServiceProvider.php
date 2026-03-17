<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define gates based on permissions
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('permissions')) {
                foreach (\App\Models\Permission::all() as $permission) {
                    \Illuminate\Support\Facades\Gate::define($permission->slug, function ($user) use ($permission) {
                        return $user->hasPermission($permission->slug);
                    });
                }
            }
        } catch (\Exception $e) {
            // Permission table might not exist during migrations
        }
    }
}
