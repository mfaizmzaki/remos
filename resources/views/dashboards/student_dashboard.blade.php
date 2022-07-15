@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Student Dashboard</h1>

<style>
    span.required {
            color: red;
        }
</style>
@stop

@section('content')
@if(session('user_is_switched'))
<div class="alert alert-warning">
    You are currently logged in as a different user. <a href="{{ route('user.restore') }}">Click here</a> to restore your login.
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
                       You have no registered events. Please contact the administrator if you feel this is a mistake.
                    </div>
                    @else
                        @php
                        $heads = [
                        ['label' => 'Event', 'width' => 20],
                        ['label' => 'Date and Time', 'width' => 10],
                        ['label' => 'Venue', 'width' => 15],
                        ['label' => 'Research Title', 'width' => 20],
                        ['label' => 'Panels', 'width' => 20], 
                        ['label' => 'Actions', 'no-export' => true, 'width' => 20]
                        ];

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
                        <x-adminlte-datatable id="registeredEvent_table" :heads="$heads" :config="$config" theme="light" striped hoverable>
                            @foreach ($registered_events as $event)
                                <tr>
                                    <td>{{ $event->event_mode }}</td>
                                    <td>{{ $event->event->date->format('d/m/Y') }} {{ $event->event->time }}</td>
                                    <td>{{ $event->event->location->location_name }}</td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->supervisor_1->name }}</td>
                                    <td>
                                        @if ($event->report_upload_path == null)
                                            <a class="btn btn-xs btn-outline-danger" title="Results"
                                                href="#">Please upload REMOS report!</a>
                                        @else
                                            {!! $btnDetails !!}
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

@stop