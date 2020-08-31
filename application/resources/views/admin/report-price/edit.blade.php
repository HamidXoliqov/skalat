@extends('layouts.default')
    
    @section('meta')
        <title>Edit Employee Attendance | Workday Time Clock</title>
        <meta name="description" content="Workday edit employee attendance.">
    @endsection 

    @section('styles')
        <link href="{{ asset('/assets/vendor/mdtimepicker/mdtimepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/vendor/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('Edit Attendance') }}</h2>
            </div>    
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">
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
                    {!! Form::open(['route' => ['report-price.update',$report->id],'method'=>'put','class'=>'ui form']) !!}
                    @csrf
                        <div class="two fields">
                            <div class="field">
                                <label>{{ __('Employee') }}</label>
                                <input type="text" name="name" class="readonly" readonly="" value="@isset($report->name){{ $report->name }}@endisset">
                            </div>
                            <div class="field">
                                <label for="">{{ __('Date') }}</label>
                                <input class="readonly" type="text" placeholder="Date" name="date" value="@isset($report->date){{ $report->date }}@endisset" readonly="" />
                            </div>
                        </div>

                        <div class="field">
                            <label for="">{{ __('Time In') }}</label>
                            @isset($report->statr_date)
                                @php 
                                    if($tf == 1) {
                                        $t_in = date("h:i:s A",strtotime($report->statr_date));
                                    } else {    
                                        $t_in = date("H:i:s",strtotime($report->statr_date));
                                    }
                                    $t_in_date = date("m/d/Y",strtotime($report->statr_date));
                                @endphp
                            @endisset
                            <input type="hidden" name="statr_date" value="@isset($t_in_date){{ $t_in_date }}@endisset">
                            <input class="jtimepicker" type="text" placeholder="00:00:00 AM" name="statr_date" value="@isset($t_in){{ $t_in }}@endisset"/>
                        </div>

                        <div class="field">
                            <label for="">{{ __('Time Out') }}</label>
                                @php 
                                    if($tf == 1) {
                                        $t_out = date("h:i:s A",strtotime($report->end_date));
                                    } else {    
                                        $t_out = date("H:i:s",strtotime($report->end_date));
                                    }
                                    $t_out_date = date("m/d/Y",strtotime($report->end_date));
                                @endphp
                            <input type="hidden" name="end_date" value="@if($report->end_date != null){{ $t_out_date }}@endif">
                            <input class="jtimepicker" type="text" placeholder="00:00:00 PM" name="end_date" value="@if($report->end_date != null){{ $t_out }}@endif"/>
                        </div>

                    <div class="fields">
                        <div class="sixteen wide field">
                            <label>{{ __('Reason') }}</label>
                            <textarea class="" rows="5" name="reason">@isset($report->reason){{ $report->reason }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui error message">
                            <i class="close icon"></i>
                            <div class="header"></div>
                            <ul class="list">
                                <li class=""></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="box-footer">
                    <button class="ui positive small button" type="submit" name="submit"><i class="ui checkmark icon"></i> {{ __('Update') }}</button>
                    <a class="ui grey small button" href="{{ url('report-price') }}"><i class="ui times icon"></i> {{ __('Cancel') }}</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>

    @endsection

    @section('scripts')
    <script src="{{ asset('/assets/vendor/mdtimepicker/mdtimepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>
    
    <script type="text/javascript">
    @isset($tf)
        @if($tf == 1)
            $('.jtimepicker').mdtimepicker({format:'h:mm tt', theme: 'blue', hourPadding: true});
        @else
            $('.jtimepicker').mdtimepicker({format:'hh:mm', theme: 'blue', hourPadding: true});
        @endif
    @endisset
    $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });
    </script>
    @endsection