@extends('adminlte::page')

@section('title', 'Create Event')

@section('content_header')
    <br>
@stop

@section('content')
    @if (session('user_is_switched'))
        <div class="alert alert-warning">
            You are currently logged in as a different user. <a href="{{ route('user.restore') }}">Click here</a> to
            restore your login.
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Event</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('create_event') }}" method="POST">
                  @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleSelectRounded0">Department</label>
                            <select class="custom-select rounded-0" name="department" required>
                                <option value="" disabled selected hidden>Choose Department</option>
                                @foreach ($departments as $department)
                                    <option value={{ $department->id }}>{{ $department->department_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="eventMode">Event Mode</label>
                            <select class="custom-select rounded-0" name="eventMode" required>
                                <option value="" disabled selected hidden>Choose Event Mode</option>
                                <option value="Proposal Defence">Proposal Defence</option>
                                <option value="Candidature Defence">Candidature Defence</option>
                                <option value="Thesis Seminar">Thesis Seminar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select class="custom-select rounded-0" name="location" required>
                                <option value="" disabled selected hidden>Choose Location</option>
                                @foreach ($locations as $location)
                                    <option value={{ $location->id }}>{{ $location->location_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date">
                                <input type="date" class="form-control datetimepicker-input" name="date" required/>
                            </div>
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Time</label>
                                <div class="input-group date">
                                    <input type="time" class="form-control datetimepicker-input" name="time" required/>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                        </div>
                        <div class="form-group">
                            <label>Chair</label>
                            <select class="form-control select2bs4" name="chair" style="width: 100%" required>
                              <option value="" disabled selected hidden>Event Chair</option>
                              @foreach ($lecturers as $lecturer)
                              <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
    </style>

@stop

@section('js')
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@stop
