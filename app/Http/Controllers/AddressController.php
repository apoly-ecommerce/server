<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validations\CreateAddressRequest;
use App\Http\Requests\Validations\UpdateAddressRequest;
use App\Http\Resources\ApiStatusResource;
use App\Http\Resources\AddressesResource;
use App\Repositories\Address\AddressRepository;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $model;
    protected $address;

    /**
     * Construct
     *
     * @param AddressRepository $address
     */
    public function __construct(AddressRepository $address)
    {
        $this->model = trans('app.model.address');
        $this->address = $address;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addresses($addressable_type, $addressable_id)
    {
        $data = $this->address->addresses($addressable_type, $addressable_id);

        $successRes = [
            'data' => new AddressesResource($data)
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAddressRequest $request)
    {
        $address = $this->address->store($request);

        $successRes = [
            'success' => trans('messages.created', ['model' => $this->model]),
            'address' => $address
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = $this->address->find($id);

        $successRes = [
            'address' => $address
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        $this->address->update($request, $id);

        $successRes = [
          'success' => trans('messages.updated', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->address->trash($id);

        $successRes = [
          'success' => trans('messages.deleted', ['model' => $this->model])
        ];

        return new ApiStatusResource($successRes);
    }
}
