<?php

namespace App\Http\Controllers\Admin\Api;

use Carbon\Carbon;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\UpdateFeaturedBrandsRequest;
use App\Http\Requests\Validations\UpdateTrendingNowCategoriesRequest;
use App\Http\Resources\ApiStatusResource;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ThemeOptionController extends Controller
{
    use Authorizable;

    /**
     * Display listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured_brands = Manufacturer::whereIn('id', get_from_option_table('featured_brands', []) ?? [])->get()->pluck('name', 'id')->toArray();

        $trending_categories = Category::whereIn('id', get_from_option_table('trending_categories', []) ?? [])->pluck('name', 'id')->toArray();

        $successRes = [
            'featured_brands' => $featured_brands,
            'trending_categories' => $trending_categories
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Show the form for featuredBrands.
     *
     * @return \Illuminate\Http\Response
     */
    public function editFeaturedBrands()
    {
        $brands = Manufacturer::all(['id', 'name']);
        $featured_brands = Manufacturer::whereIn('id', get_from_option_table('featured_brands', []) ?? [])
                            ->get()->pluck('id');
        $successRes = [
            'brands' => $brands,
            'featured_brands' => $featured_brands
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Validations\UpdateFeaturedBrandsRequest  $request
     */
    public function updateFeaturedBrands(UpdateFeaturedBrandsRequest $request)
    {
        $update = \DB::table('options')->updateOrInsert(
            ['option_name' => 'featured_brands'],
            [
                'option_name'  => 'featured_brands',
                'option_value' => serialize($request->featured_brands),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        if ($update) {
            $successRes = [
                'success' => trans('messages.featured_brands_updated')
            ];
        }
        else {
            $successRes = [
                'warning' => trans('messages.failed')
            ];
        }

        return new ApiStatusResource($successRes);
    }

    /**
     * Show the form for Trending Now Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function editTrendingNowCategories()
    {
        $categories = Category::all(['id', 'name']);
        $trending_categories = Category::whereIn('id',get_from_option_table('trending_categories', []) ?? [])
                                ->get()->pluck('id');

        $successRes = [
            'categories' => $categories,
            'trending_categories' => $trending_categories
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     *  Update the specified resource in storage.
     *
     * @param App\Http\Requests\Validations\UpdateTrendingNowCategoriesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateTrendingNowCategories(UpdateTrendingNowCategoriesRequest $request)
    {
        $update = \DB::table('options')->updateOrInsert(
            ['option_name' => 'trending_categories'],
            [
                'option_name' => 'trending_categories',
                'option_value' => serialize($request->trending_categories),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        if ($update) {
            $successRes = [
                'success' => trans('messages.trending_now_category_updated')
            ];
        }
        else {
            $successRes = [
                'warning' => trans('messages.failed')
            ];
        }

        return new ApiStatusResource($successRes);
    }
}