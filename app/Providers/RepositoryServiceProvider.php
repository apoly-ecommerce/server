<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Role\RoleRepository::class,
            \App\Repositories\Role\EloquentRole::class
        );

        $this->app->singleton(
            \App\Repositories\Module\ModuleRepository::class,
            \App\Repositories\Module\EloquentModule::class,
        );

        $this->app->singleton(
            \App\Repositories\CategoryGroup\CategoryGroupRepository::class,
            \App\Repositories\CategoryGroup\EloquentCategoryGroup::class
        );

        $this->app->singleton(
            \App\Repositories\CategorySubGroup\CategorySubGroupRepository::class,
            \App\Repositories\CategorySubGroup\EloquentCategorySubGroup::class
        );

        $this->app->singleton(
            \App\Repositories\Category\CategoryRepository::class,
            \App\Repositories\Category\EloquentCategory::class
        );

        $this->app->singleton(
            \App\Repositories\Manufacturer\ManufacturerRepository::class,
            \App\Repositories\Manufacturer\EloquentManufacturer::class
        );

        $this->app->singleton(
            \App\Repositories\Country\CountryRepository::class,
            \App\Repositories\Country\EloquentCountry::class
        );

        $this->app->singleton(
            \App\Repositories\Product\ProductRepository::class,
            \App\Repositories\Product\EloquentProduct::class
        );
    }
}