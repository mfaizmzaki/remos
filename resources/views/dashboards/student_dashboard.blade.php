@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Student Dashboard</h1>
    <br>
    @if (session('update_message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('update_message') }}
        </div>
        {{ Session::forget('update_message') }}
    @endif

    <style>
        span.required {
            color: red;
        }
    </style>
@stop

@section('content')
    @if (session('user_is_switched'))
        <div class="alert alert-warning">
            You are currently logged in as a different user. <a href="{{ route('user.restore') }}">Click here</a> to
            restore your login.
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Registered REMOS</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($registered_events->isEmpty())
                            <div class="card-text">
                                You have no registered events. Please contact the administrator if you feel this is a
                                mistake.
                            </div>
                        @else
                            @php
                                $heads = [['label' => 'Event', 'width' => 20], ['label' => 'Date and Time', 'width' => 10], ['label' => 'Venue', 'width' => 15], ['label' => 'Research Title', 'width' => 20], ['label' => 'Panels', 'width' => 20], ['label' => 'Actions', 'no-export' => true, 'width' => 20]];
                                
                                $config = [
                                    'order' => [[2, 'asc']],
                                    'lengthMenu' => [5, 10, 15, 20],
                                ];
                                
                                $btnUpdate = '<button class="btn btn-xs btn-default text-primary mx-1" title="Update" data-toggle="modal" data-target="#update-interest">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>';
                                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1" title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>';
                                $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1" title="Details">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </button>';
                            @endphp

                            {{-- Minimal example / fill data using the component slot --}}
                            <x-adminlte-datatable id="registeredEvent_table" :heads="$heads" :config="$config"
                                theme="light" striped hoverable>
                                @foreach ($registered_events as $event)
                                    <tr>
                                        <td>{{ $event->event_mode }}</td>
                                        <td>{{ $event->event->date->format('d/m/Y') }} {{ $event->event->time }}</td>
                                        <td>{{ $event->event->location->location_name }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->supervisor_1->name }}</td>
                                        <td>
                                            @if ($event->report_upload_path == null)
                                                <a class="btn btn-xs btn-outline-danger" title="Results" data-toggle="modal"
                                                    data-target="#modal-report-{{ $event->id }}"
                                                    data-registered="{{ $event->id }}">Please
                                                    upload REMOS report by {{ $event->event->date->subdays(3)->format('d/m/Y') }}</a>

                                                <div class="modal fade" id="modal-report-{{ $event->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Upload REMOS Report</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('update_report', $event->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <div class="custom-file">
                                                                            <label class="custom-file-label" for="report">Choose file</label>
                                                                            <input type="file"
                                                                                class="@error('report') is-invalid @enderror custom-file-input"
                                                                                name="report" id="reportFileName"
                                                                                onchange="setfilename(this.value);">
                                                                            <small>File format allowed: PDF or DOCX only
                                                                                (&lt5MB)
                                                                            </small>
                                                                        
                                                                            @error('report')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                               
                                                            </div>
                                                            <div class="modal-footer text-right">
                                                                <button type="submit" class="btn btn-primary">Upload Report</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            @else
                                                <a class="btn btn-xs btn-default text-primary mx-1" title="Details"
                                                    href="{{ route('registrations.show', $event->id) }}"><i
                                                        class="fa fa-lg fa-fw fa-eye"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
@stop

@section('js')
    <script>
        $('#reportFileName').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#reportFileName')[0].files[0].name;
            $(this).prev('label').text(file);
        });


        @if (count($errors) > 0)
            $('#modal-registration').modal('show');
        @endif
    </script>
@stop
