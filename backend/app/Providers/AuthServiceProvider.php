<?php

namespace App\Providers;

use App\Models\FoodStall;
use App\Models\Report;
use App\Models\Vendor;
use App\Policies\FoodStallPolicy;
use App\Policies\ReportPolicy;
use App\Policies\VendorPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Vendor::class => VendorPolicy::class,
        FoodStall::class => FoodStallPolicy::class,
        Report::class => ReportPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}

