<?php

namespace App\Http\Requests;

use App\DriverModel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDriverModelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('driver_model_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'driver_name'     => [
                'max:30',
                'required',
            ],
            'driver_phone'    => [
                'max:13',
                'required',
            ],
            'driver_location' => [
                'required',
            ],
            'car_type'        => [
                'max:10',
                'required',
            ],
            'car_color'       => [
                'max:10',
                'required',
            ],
        ];
    }
}
