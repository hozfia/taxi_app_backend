@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.driverModel.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.driver-models.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('driver_name') ? 'has-error' : '' }}">
                            <label for="driver_name">{{ trans('cruds.driverModel.fields.driver_name') }}*</label>
                            <input type="text" id="driver_name" name="driver_name" class="form-control" value="{{ old('driver_name', isset($driverModel) ? $driverModel->driver_name : '') }}" required>
                            @if($errors->has('driver_name'))
                                <p class="help-block">
                                    {{ $errors->first('driver_name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.driverModel.fields.driver_name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('driver_phone') ? 'has-error' : '' }}">
                            <label for="driver_phone">{{ trans('cruds.driverModel.fields.driver_phone') }}*</label>
                            <input type="text" id="driver_phone" name="driver_phone" class="form-control" value="{{ old('driver_phone', isset($driverModel) ? $driverModel->driver_phone : '') }}" required>
                            @if($errors->has('driver_phone'))
                                <p class="help-block">
                                    {{ $errors->first('driver_phone') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.driverModel.fields.driver_phone_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('driver_location') ? 'has-error' : '' }}">
                            <label for="driver_location">{{ trans('cruds.driverModel.fields.driver_location') }}*</label>
                            <input type="text" id="driver_location" name="driver_location" class="form-control" value="{{ old('driver_location', isset($driverModel) ? $driverModel->driver_location : 'not_clear_yet') }}" required>
                            @if($errors->has('driver_location'))
                                <p class="help-block">
                                    {{ $errors->first('driver_location') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.driverModel.fields.driver_location_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('driver_photo') ? 'has-error' : '' }}">
                            <label for="driver_photo">{{ trans('cruds.driverModel.fields.driver_photo') }}*</label>
                            <div class="needsclick dropzone" id="driver_photo-dropzone">

                            </div>
                            @if($errors->has('driver_photo'))
                                <p class="help-block">
                                    {{ $errors->first('driver_photo') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.driverModel.fields.driver_photo_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('car_type') ? 'has-error' : '' }}">
                            <label for="car_type">{{ trans('cruds.driverModel.fields.car_type') }}*</label>
                            <input type="text" id="car_type" name="car_type" class="form-control" value="{{ old('car_type', isset($driverModel) ? $driverModel->car_type : '') }}" required>
                            @if($errors->has('car_type'))
                                <p class="help-block">
                                    {{ $errors->first('car_type') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.driverModel.fields.car_type_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('car_color') ? 'has-error' : '' }}">
                            <label for="car_color">{{ trans('cruds.driverModel.fields.car_color') }}*</label>
                            <input type="text" id="car_color" name="car_color" class="form-control" value="{{ old('car_color', isset($driverModel) ? $driverModel->car_color : '') }}" required>
                            @if($errors->has('car_color'))
                                <p class="help-block">
                                    {{ $errors->first('car_color') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.driverModel.fields.car_color_helper') }}
                            </p>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.driverPhotoDropzone = {
    url: '{{ route('admin.driver-models.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="driver_photo"]').remove()
      $('form').append('<input type="hidden" name="driver_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="driver_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($driverModel) && $driverModel->driver_photo)
      var file = {!! json_encode($driverModel->driver_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="driver_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@stop