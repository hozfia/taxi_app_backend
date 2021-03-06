<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\DriverModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDriverModelRequest;
use App\Http\Requests\UpdateDriverModelRequest;
use App\Http\Resources\Admin\DriverModelResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverModelApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('driver_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DriverModelResource(DriverModel::all());
    }

    public function store(StoreDriverModelRequest $request)
    {
        $driverModel = DriverModel::create($request->all());

        if ($request->input('driver_photo', false)) {
            $driverModel->addMedia(storage_path('tmp/uploads/' . $request->input('driver_photo')))->toMediaCollection('driver_photo');
        }

        return (new DriverModelResource($driverModel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DriverModel $driverModel)
    {
        abort_if(Gate::denies('driver_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DriverModelResource($driverModel);
    }

    public function update(UpdateDriverModelRequest $request, DriverModel $driverModel)
    {
        $driverModel->update($request->all());

        if ($request->input('driver_photo', false)) {
            if (!$driverModel->driver_photo || $request->input('driver_photo') !== $driverModel->driver_photo->file_name) {
                $driverModel->addMedia(storage_path('tmp/uploads/' . $request->input('driver_photo')))->toMediaCollection('driver_photo');
            }
        } elseif ($driverModel->driver_photo) {
            $driverModel->driver_photo->delete();
        }

        return (new DriverModelResource($driverModel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DriverModel $driverModel)
    {
        abort_if(Gate::denies('driver_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driverModel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
