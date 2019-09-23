<?php

namespace App\Http\Controllers\Admin;

use App\DriverModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDriverModelRequest;
use App\Http\Requests\StoreDriverModelRequest;
use App\Http\Requests\UpdateDriverModelRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverModelController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('driver_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driverModels = DriverModel::all();

        return view('admin.driverModels.index', compact('driverModels'));
    }

    public function create()
    {
        abort_if(Gate::denies('driver_model_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.driverModels.create');
    }

    public function store(StoreDriverModelRequest $request)
    {
        $driverModel = DriverModel::create($request->all());

        if ($request->input('driver_photo', false)) {
            $driverModel->addMedia(storage_path('tmp/uploads/' . $request->input('driver_photo')))->toMediaCollection('driver_photo');
        }

        return redirect()->route('admin.driver-models.index');
    }

    public function edit(DriverModel $driverModel)
    {
        abort_if(Gate::denies('driver_model_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.driverModels.edit', compact('driverModel'));
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

        return redirect()->route('admin.driver-models.index');
    }

    public function show(DriverModel $driverModel)
    {
        abort_if(Gate::denies('driver_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.driverModels.show', compact('driverModel'));
    }

    public function destroy(DriverModel $driverModel)
    {
        abort_if(Gate::denies('driver_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driverModel->delete();

        return back();
    }

    public function massDestroy(MassDestroyDriverModelRequest $request)
    {
        DriverModel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
