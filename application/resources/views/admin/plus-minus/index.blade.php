@extends('layouts.default')

    @section('meta')
        <title>Employees | Workday Time Clock</title>
        <meta name="description" content="Workday employees, view all employees, add, edit, delete, and archive employees.">
    @endsection

    @section('content')

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title uppercase">{{ __('Plus minus price') }}
                {{--<a class="ui positive button mini offsettop5 float-right" href="{{ url('employees/new') }}"><i class="ui icon plus"></i>{{ __('Add') }}</a>--}}
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                <table width="100%" class="table table-striped table-hover" id="dataTables-example" data-order='[[ 0, "desc" ]]'>
                    <thead>
                        <tr>
                            <th>{{ __('Hour') }}</th>
                            <th>{{ __('Plus') }}</th>
                            <th>{{ __('Minus') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($data)
                        @foreach ($data as $price)
                            <tr class="">
                            <td>{{ __('1 - hour') }}</td>
                            <td>{{ $price->plus }}</td>
                            <td>{{ $price->minus }}</td>
                            <td class="align-right">
{{--                             <a href="{{ url('/plus-minus/view/'.$price->id) }}" class="ui circular basic icon button tiny" title="View"><i class="file alternate outline icon"></i></a>--}}
                            <a href="{{route('plus-minus.edit',$price->id)}}" class="ui circular basic icon button tiny" title="Edit"><i class="edit outline icon"></i></a>
                           </td>
                            </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        
    </div>

    @endsection

    {{--@section('scripts')--}}
    {{--<script type="text/javascript">--}}
    {{--$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});--}}
    {{--</script>--}}
    {{--@endsection--}}