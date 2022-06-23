@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @if (session('store_message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('store_message') }}
        </div>
        {{ Session::forget('store_message') }}
    @endif
    
    <h1>Postgraduate Office Dashboard</h1>
@stop

@section('content')
    @if (session('user_is_switched'))
        <div class="alert alert-warning">
            You are currently logged in as a different user. <a href="{{ route('user.restore') }}">Click here</a> to
            restore your login.
        </div>
    @endif

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>Quick Utility Function Buttons</strong>
                </div>
                <div class="card-body d-flex flex-column">
                    <a class="btn btn-block btn-outline-primary btn-sm" href="{{ route('events.create') }}">Add new REMOS
                        event</a>
                    <a class="btn btn-block btn-outline-primary btn-sm" href="{{ route('create_user') }}">Create new REMOS user</a>
                    <button type="button" class="btn btn-block btn-outline-primary btn-sm">Add new lecturer or panel to
                        REMOS event</button>
                    <button type="button" class="btn btn-block btn-outline-primary btn-sm">Add new student to REMOS
                        event</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="row">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text mt-1">Total registered students in the system</span>
                        <span class="info-box-number mb-3">1,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="row">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total registered staffs in the system</span>
                        <span class="info-box-number mb-2">1,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <!-- /.widget-user-image -->
                    <center>
                        <h4>Computer Systems and Networking</h4>
                    </center>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Upcoming REMOS <span class="float-right badge bg-primary">31 April 2022</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Registered Candidates <span class="float-right badge bg-info">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Unassigned REMOS <span class="float-right badge bg-danger">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Pending Results <span class="float-right badge bg-danger">842</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>

        <div class="col-md-3 col-sm-12">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <!-- /.widget-user-image -->
                    <center>
                        <h4>Artificial Intelligence</h4><br>
                    </center>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Upcoming REMOS <span class="float-right badge bg-primary">31 April 2022</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Registered Candidates <span class="float-right badge bg-info">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Unassigned REMOS <span class="float-right badge bg-danger">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Pending Results <span class="float-right badge bg-danger">842</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>

        <div class="col-md-3 col-sm-12">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <!-- /.widget-user-image -->
                    <center>
                        <h4>Software Engineering</h4><br>
                    </center>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Upcoming REMOS <span class="float-right badge bg-primary">31 April 2022</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Registered Candidates <span class="float-right badge bg-info">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Unassigned REMOS <span class="float-right badge bg-danger">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Pending Results <span class="float-right badge bg-danger">842</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>

        <div class="col-md-3 col-sm-12">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <!-- /.widget-user-image -->
                    <center>
                        <h4>Information Systems</h4><br>
                    </center>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Upcoming REMOS <span class="float-right badge bg-primary">31 April 2022</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Registered Candidates <span class="float-right badge bg-info">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Unassigned REMOS <span class="float-right badge bg-danger">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Pending Results <span class="float-right badge bg-danger">842</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-info">
                <div class="card-header">
                    <h3 class="card-title">Upcoming REMOS Events</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">

                    @php
                        $heads = ['Department', ['label' => 'Venue', 'width' => 20], ['label' => 'Date and Time', 'width' => 20], 'Chair', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];
                        
                        $btnUpdate = '<button class="btn btn-xs btn-default text-primary mx-1" title="Update" data-toggle="modal" data-target="#update-interest">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>';
                        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1" title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>';
                        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1" title="Details">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>';
                        
                        $config = [
                            'order' => [[3, 'asc']],
                        ];
                    @endphp

                    {{-- Minimal example / fill data using the component slot --}}
                    <x-adminlte-datatable id="event_table" :heads="$heads" :config="$config">
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->department->department_name }}</td>
                                <td>{{ $event->location->location_name }}</td>
                                <td>{{ $event->date->format('d/m/Y') }} {{ $event->time }}</td>
                                <td>{{ $event->user->name }}</td>
                                <td>
                                    <nobr>
                                        <a class="btn btn-xs btn-default text-primary mx-1" title="Details" href="{{ route('events.show', $event->id) }}"><i class="fa fa-lg fa-fw fa-eye"></i></a>
                                    </nobr>
                                </td>
                            </tr>
    @endforeach
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>
        </div>

@stop

@section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
