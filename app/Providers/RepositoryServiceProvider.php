<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // SETTINGS

        $this->app->singleton(
            \App\Repositories\Role\RoleRepository::class,
            \App\Repositories\Role\EloquentRole::class
        );

        $this->app->singleton(
            \App\Repositories\Module\ModuleRepository::class,
            \App\Repositories\Module\EloquentModule::class,
        );

        //  CATALOG

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
            \App\Repositories\Product\ProductRepository::class,
            \App\Repositories\Product\EloquentProduct::class
        );

        // ADMIN

        $this->app->singleton(
            \App\Repositories\User\UserRepository::class,
            \App\Repositories\User\EloquentUser::class
        );

        $this->app->singleton(
            \App\Repositories\Customer\CustomerRepository::class,
            \App\Repositories\Customer\EloquentCustomer::class
        );

        // COMMON

        $this->app->singleton(
            \App\Repositories\Address\AddressRepository::class,
            \App\Repositories\Address\EloquentAddress::class
        );

        $this->app->singleton(
            \App\Repositories\Country\CountryRepository::class,
            \App\Repositories\Country\EloquentCountry::class
        );

        // VENDORS

        $this->app->singleton(
            \App\Repositories\Shop\ShopRepository::class,
            \App\Repositories\Shop\EloquentShop::class
        );

        $this->app->singleton(
            \App\Repositories\Merchant\MerchantRepository::class,
            \App\Repositories\Merchant\EloquentMerchant::class
        );

        // APPEARANCES

        $this->app->singleton(
            \App\Repositories\Banner\BannerRepository::class,
            \App\Repositories\Banner\EloquentBanner::class
        );

        $this->app->singleton(
            \App\Repositories\BannerGroup\BannerGroupRepository::class,
            \App\Repositories\BannerGroup\EloquentBannerGroup::class
        );

        $this->app->singleton(
          \App\Repositories\Slider\SliderRepository::class,
          \App\Repositories\Slider\EloquentSlider::class
      );



        // UTILITIES

        $this->app->singleton(
            \App\Repositories\FaqTopic\FaqTopicRepository::class,
            \App\Repositories\FaqTopic\EloquentFaqTopic::class
        );

        $this->app->singleton(
            \App\Repositories\Faq\FaqRepository::class,
            \App\Repositories\Faq\EloquentFaq::class
        );

    }
}