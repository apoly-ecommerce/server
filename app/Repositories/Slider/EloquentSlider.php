<?php

namespace App\Repositories\Slider;

use App\Models\Slider;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;

class EloquentSlider extends EloquentRepository implements BaseRepository, SliderRepository
{

    protected $model;

    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }

    public function all()
    {
        return $this->model->with('featureImage', 'mobileImage')->orderBy('order', 'asc')->get();
    }

    public function allWithPaginate($limit)
    {
        return $this->model->with('featureImage', 'mobileImage')->orderBy('order', 'asc')->paginate($limit);
    }

    public function trashOnlyWithPaginate($limit)
    {
        return $this->model->onlyTrashed()->with('featureImage', 'mobileImage')->orderBy('order', 'asc')->paginate($limit);
    }

    public function destroy($id)
    {
        $slider = parent::findTrash($id);

        $slider->flushImages();

        return $slider->forceDelete();
    }

    public function massDestroy($ids)
    {
        $sliders = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($sliders as $slider) {
            $slider->flushImages();
        }

        return parent::massDestroy($ids);
    }

}