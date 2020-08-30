@extends('layouts.default')

@section('meta')
    <title>Plus minus price edit</title>
    <meta name="description" content="Workday add new employee, delete employee, edit employee">
@endsection

@section('styles')
    <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('Plus minus edit') }}</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header">{{ __('There were some errors with your submission') }}</div>
                        <ul class="list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            {!! Form::open(['route' => ['plus-minus.update',$data->id],'method'=>'put','class'=>'ui form custom']) !!}
                @csrf
                <div class="col-md-12 float-left">
                    <div class="box box-success">
{{--                        <div class="box-header with-border">{{ __('Personal Information') }}</div>--}}
                        <div class="box-body">
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('Plus price') }}</label>
                                    <input type="text" class="uppercase" name="plus" value="@isset($data->plus){{ $data->plus }}@endisset">
                                </div>
                                <div class="field">
                                    <label>{{ __('Minus price') }}</label>
                                    <input type="text" class="uppercase" name="minus" value="@isset($data->minus){{ $data->minus }}@endisset">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 float-left">
                    <div class="action align-right">
                        <input type="hidden" name="id" value="@isset($e_id){{ $e_id }}@endisset">
                        <button type="submit" name="submit" class="ui green button small"><i class="ui checkmark icon"></i> {{ __('Update') }}</button>
                        <a href="{{ url('plus-minus') }}" class="ui grey button small"><i class="ui times icon"></i> {{ __('Cancel') }}</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>
    <script type="text/javascript">
        $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd', autoClose: true });

        $('.ui.dropdown.department').dropdown({ onChange: function(value, text, $selectedItem) {
                $('.jobposition .menu .item').addClass('hide disabled');
                $('.jobposition .text').text('');
                $('input[name="jobposition"]').val('');
                $('.jobposition .menu .item').each(function() {
                    var dept = $(this).attr('data-dept');
                    if(dept == value) {$(this).removeClass('hide disabled');};
                });
            }});

        function validateFile() {
            var f = document.getElementById("imagefile").value;
            var d = f.lastIndexOf(".") + 1;
            var ext = f.substr(d, f.length).toLowerCase();
            if (ext == "jpg" || ext == "jpeg" || ext == "png") { } else {
                document.getElementById("imagefile").value="";
                $.notify({
                        icon: 'ui icon times',
                        message: "Please upload only jpg/jpeg and png image formats."},
                    {type: 'danger',timer: 400});
            }
        }
    </script>
@endsection