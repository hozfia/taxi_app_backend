@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.driverModel.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driverModel.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $driverModel->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driverModel.fields.driver_name') }}
                                    </th>
                                    <td>
                                        {{ $driverModel->driver_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driverModel.fields.driver_phone') }}
                                    </th>
                                    <td>
                                        {{ $driverModel->driver_phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driverModel.fields.driver_location') }}
                                    </th>
                                    <td>
                                        {{ $driverModel->driver_location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driverModel.fields.driver_photo') }}
                                    </th>
                                    <td>
                                        @if($driverModel->driver_photo)
                                            <a href="{{ $driverModel->driver_photo->getUrl() }}" target="_blank">
                                                <img src="{{ $driverModel->driver_photo->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driverModel.fields.car_type') }}
                                    </th>
                                    <td>
                                        {{ $driverModel->car_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.driverModel.fields.car_color') }}
                                    </th>
                                    <td>
                                        {{ $driverModel->car_color }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection