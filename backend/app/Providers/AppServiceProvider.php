<?php

namespace App\Providers;

use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\FoodStallRepositoryInterface;
use App\Repositories\Contracts\InspectionRepositoryInterface;
use App\Repositories\Contracts\LicenseRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Eloquent\DocumentRepository;
use App\Repositories\Eloquent\FoodStallRepository;
use App\Repositories\Eloquent\InspectionRepository;
use App\Repositories\Eloquent\LicenseRepository;
use App\Repositories\Eloquent\ReportRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\VendorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(FoodStallRepositoryInterface::class, FoodStallRepository::class);
        $this->app->bind(LicenseRepositoryInterface::class, LicenseRepository::class);
        $this->app->bind(InspectionRepositoryInterface::class, InspectionRepository::class);
        $this->app->bind(DocumentRepositoryInterface::class, DocumentRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
    }

    public function boot(): void
    {
    }
}
