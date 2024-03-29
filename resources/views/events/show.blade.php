@extends('adminlte::page')

@section('title', 'Event')

@section('content_header')
    @if (session('registration_message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('registration_message') }}
        </div>
        {{ Session::forget('registration_message') }}
    @endif
    @if (session('file_error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('file_error') }}
        </div>
        {{ Session::forget('file_error') }}
    @endif
    @if (session('update_message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('update_message') }}
        </div>
        {{ Session::forget('update_message') }}
    @endif
    <style>
        #the-count {
            float: right;
            padding: 0.1rem 0 0 0;
            font-size: 0.875rem;
        }

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

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Event Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Students Registered</span>
                            <span
                                class="info-box-number text-center text-muted mb-0">{{ count($event->registration) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Reports Submitted</span>
                            <span
                                class="info-box-number text-center text-muted mb-0">{{ count($event->registration->where('report_upload_path', '!=', null)) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" id="department"
                            value="{{ $event->department->department_name }}" disabled />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Chair</label>
                        <input type="text" class="form-control" id="chair" value="{{ $event->user->name }}"
                            disabled />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date and Time</label>
                        <input type="text" class="form-control" id="dateTime"
                            value="{{ $event->date->format('d/m/Y') }} {{ $event->time }}" disabled />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" id="location"
                            value="{{ $event->location->location_name }}" disabled />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <strong>Registered Students</strong>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">

                            @php
                                $heads = [['label' => 'Matric ID', 'width' => 15], ['label' => 'Student Name', 'width' => 25], ['label' => 'Research Title', 'width' => 20], ['label' => 'Current Semester', 'width' => 10], ['label' => 'Event Mode', 'width' => 15], ['label' => 'Actions', 'no-export' => true, 'width' => 20]];
                                
                                $btnUpdate = '<button class="btn btn-xs btn-default text-primary mx-1" title="Update" data-toggle="modal" data-target="#update-interest">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>';
                                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1" title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>';
                                $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1" title="Details">
                                        <i class="fa fsa-lg fa-fw fa-eye"></i>
                                    </button>';
                                
                                $config = [
                                    'order' => [[3, 'asc']],
                                    'lengthMenu' => [5, 10, 15, 20],
                                ];
                            @endphp

                            <x-adminlte-datatable id="registration_table" :heads="$heads" :config="$config" theme="light" striped hoverable>
                                @foreach ($event->registration as $reg)
                                    <tr>
                                        <td>{{ $reg->student->matric_id }} </td>
                                        <td>{{ $reg->student->user->name }}</td>
                                        <td>{{ $reg->title }} </td>
                                        <td>{{ $reg->student->current_semester }}</td>
                                        <td>{{ $reg->event_mode }}</td>
                                        <td>
                                            <nobr>
                                                <a class="btn btn-xs btn-default text-primary mx-1" title="Details"
                                                    href="{{ route('registrations.show', $reg->id) }}"><i
                                                        class="fa fa-lg fa-fw fa-eye"></i></a>
                                                @if ($reg->report_upload_path != null)
                                                <form action="{{ route('report.download') }}" method="post"
                                                    style="display: inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-default text-primary mx-1"
                                                        title="Download Report" name="report"
                                                        value="{{ $reg->report_upload_path }}">
                                                        <i class="fa fa-lg fa-fw fa-download"
                                                            style="color: green"></i></button>
                                                </form>
                                                @endif
                                                <a class="btn btn-xs btn-default text-primary mx-1" title="Results"
                                                href="#"><i
                                                    class="fa fa-lg fa-fw fa-list-alt" style="color: rgb(255, 38, 0)"></i></a>
                                            </nobr>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="button" class="btn btn-danger" title="Delete Event" data-toggle="modal"
                data-target="#modal-delete">Delete</button>
            <button type="button" class="btn btn-warning mx-2" title="Edit Event" data-toggle="modal"
                data-target="#modal-event">Edit event</button>
            <button type="button" class="btn  btn-primary" title="Add Student" data-toggle="modal"
                data-target="#modal-student">Add students to event</button>
        </div>
    </div>

    {{-- Delete Modal section --}}
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Event Deletion</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this REMOS event?</p>
            </div>
            <div class="modal-footer text-right">
            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline">
                @csrf
                @method('DELETE')
              <button type="submit" class="btn btn-outline-light">Confirm Delete</button>
            </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Student Modal section --}}
    <div class="modal fade" id="modal-student">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add student to <strong>REMOS ({{ $event->date->format('F Y') }})</strong> by
                        Department of
                        <strong>{{ $event->department->department_name }}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('registrations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="student">Student Name <span class="required">*</span></label>
                            <select class="form-control select2bs4 @error('student') is-invalid @enderror" name="student">
                                <option value="" disabled selected hidden></option>
                                @foreach ($students as $student)
                                    <option value={{ $student->user_id }}
                                        @if (old('student') == $student->user_id) {{ 'selected' }} @endif>
                                        {{ $student->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small>Only students in the respective department are listed</small>
                            @error('student')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="event_id" value="{{ $event->id }}" />
                        </div>
                        <div class="form-group">
                            <label for="eventMode">Event Mode <span class="required">*</span></label>
                            <select class="custom-select rounded-0 @error('eventMode') is-invalid @enderror"
                                name="eventMode">
                                <option value="" disabled selected hidden>Choose Event Mode</option>
                                <option value="Proposal Defence">Proposal Defence</option>
                                <option value="Candidature Defence">Candidature Defence</option>
                                <option value="Thesis Seminar">Thesis Seminar</option>
                            </select>

                            @error('eventMode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Research Title <span class="required">*</span></label>
                            <input type="text" class="form-control rounded-0 @error('title') is-invalid @enderror"
                                name="title" />

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Abstract</label>
                            <textarea class="form-control @error('abstract') is-invalid @enderror" rows="5" id="abstract"
                                name="abstract"></textarea>
                            <small>Not more than 500 words</small>
                            <div id="the-count">
                                <span id="current">0</span>
                                <span id="maximum">/ 500</span>
                            </div>
                            @error('abstract')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Supervisor(s) <span class="required">*</span></label>
                            <select class="select2bs4 @error('supervisor') is-invalid @enderror" multiple="multiple"
                                name="supervisor[]">
                                @foreach ($lecturers as $lecturer)
                                    <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                                @endforeach
                            </select>
                            <small>Maximum of two supervisors</small>
                            @error('supervisor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Report Upload</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="report">Choose file</label>
                                <input type="file" class="@error('report') is-invalid @enderror custom-file-input "
                                    name="report" id="reportFileName" onchange="setfilename(this.value);">
                                <small>File format allowed: PDF or DOCX only (&lt5MB)</small>
                                @error('report')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="panel-1">Panel 1<span class="required">*</span></label>
                            <select class="form-control select2bs4 @error('panel-1') is-invalid @enderror" name="panel-1">
                                <option value="" disabled selected hidden></option>
                                @foreach ($lecturers as $panel)
                                    <option value={{ $panel->id }}
                                        @if (old('panel-1') == $panel->id) {{ 'selected' }} @endif>
                                        {{ $panel->name }}
                                    </option>
                                @endforeach
                            </select>
                
                            @error('panel-1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="panel-2">Panel 2<span class="required">*</span></label>
                            <select class="form-control select2bs4 @error('panel-2') is-invalid @enderror" name="panel-2">
                                <option value="" disabled selected hidden></option>
                                @foreach ($lecturers as $panel)
                                    <option value={{ $panel->id }}
                                        @if (old('panel-2') == $panel->id) {{ 'selected' }} @endif>
                                        {{ $panel->name }}
                                    </option>
                                @endforeach
                            </select>
                
                            @error('panel-2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="modal-footer text-right">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    {{-- Event Modal section --}}
    <div class="modal fade" id="modal-event">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit <strong>REMOS ({{ $event->date->format('F Y') }})</strong> by
                        Department of
                        <strong>{{ $event->department->department_name }}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('events.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="location">Location</label>
                            <select class="custom-select rounded-0" name="location" required>
                                <option value="{{ $event->location->id }}" selected>
                                    {{ $event->location->location_name }}</option>
                                @foreach ($locations as $location)
                                    <option value={{ $location->id }}>{{ $location->location_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date">
                                <input type="date" class="form-control datetimepicker-input" name="date"
                                    value="{{ $event->date->format('Y-m-d') }}" required />
                            </div>
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label>Time</label>
                                <div class="input-group date">
                                    <input type="time" class="form-control datetimepicker-input" name="time"
                                        value="{{ Carbon\Carbon::parse($event->time)->format('H:i') }}" required />
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                        </div>
                        <div class="form-group">
                            <label>Chair</label>
                            <select class="form-control select2bs4" name="chair" style="width: 100%" required>
                                <option value="{{ $event->chair_id }}" selected>{{ $event->user->name }}</option>
                                @foreach ($lecturers as $lecturer)
                                    @if ($lecturer->id !== $event->chair_id)
                                        <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop

@section('css')
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
        });

        $('#reportFileName').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#reportFileName')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        @if (count($errors) > 0)
            $('#modal-student').modal('show');
        @endif


        counter = function() {
            var value = $('#abstract').val();
            var regex = /\s+/gi;
            var wordCount = value.trim().replace(regex, ' ').split(' ').length;

            current = $('#current'),
                maximum = $('#maximum'),
                theCount = $('#the-count');

            current.text(wordCount);

            if (wordCount >= 400) {
                maximum.css('color', '#8f0001');
                current.css('color', '#8f0001');
                theCount.css('font-weight', 'bold');
            } else {
                maximum.css('color', '#666');
                theCount.css('font-weight', 'normal');
            }
        };

        $(document).ready(function() {
            $('#abstract').change(counter);
            $('#abstract').keypress(counter);
        });
    </script>
@stop
