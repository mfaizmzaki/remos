@extends('adminlte::page')

@section('title', 'Create Event')

@section('content_header')
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

    <div class="mb-2">
        <a href="{{ URL::previous() }}">Go Back</a>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Event Registration</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group">
                <label>Student Name</label>
                <input type="text" class="form-control" value="{{ $registration->student->user->name }}" disabled />
            </div>
            <div class="form-group">
                <label>Matric ID</label>
                <input type="text" class="form-control" value="{{ $registration->student->matric_id }}" disabled />
            </div>
            <div class="form-group">
                <label for="event_mode">Event Mode <span class="required">*</span></label>
                <input type="text" class="form-control" value="{{ $registration->event_mode }}" disabled />
            </div>
            <div class="form-group">
                <label>Research Title</label>
                <input type="text" class="form-control" value="{{ $registration->title }}" disabled />
            </div>
            <div class="form-group">
                <label>Abstract</label>
                <textarea class="form-control" rows="5" disabled>{{ $registration->abstract }}</textarea>
            </div>
            <div class="form-group">
                <label>Report</label>
                <input type="text" class="form-control" value="{{ basename($registration->report_upload_path) }}"
                    disabled />
            </div>
            <div class="form-group">
                <label>Supervisor(s) <span class="required">*</span></label>
                <select class="select2bs4" multiple="multiple" name="supervisor[]" style="width: 100%" disabled>
                    @if ($registration->sv_1_id != null)
                        <option value="{{ $registration->sv_1_id }}" selected>
                            {{ $registration->supervisor_1->name }}</option>
                    @endif
                    @if ($registration->sv_2_id != null)
                        <option value="{{ $registration->sv_2_id }}" selected>
                            {{ $registration->supervisor_2->name }}</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="panel_1">Panel 1<span class="required">*</span></label>
                <select class="form-control select2bs4 @error('panel_1') is-invalid @enderror" name="panel_1" disabled>
                        <option value={{ $registration->panel_1_id }} selected>
                            {{ $registration->panel_1->name ?? "" }}
                        </option>
                </select>

                @error('panel_1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="panel_2">Panel 2<span class="required">*</span></label>
                <select class="form-control select2bs4 @error('panel_2') is-invalid @enderror" name="panel_2" disabled>
                    <option value={{ $registration->panel_2_id }} selected>
                        {{ $registration->panel_2->name ?? "" }}
                    </option>
                </select>

                @error('panel_2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-warning float-right" data-toggle="modal"
                data-target="#modal-registration">Edit registration</button>
        </div>
    </div>
    </div>



    {{-- Registration Modal section --}}
    <div class="modal fade" id="modal-registration">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Event Registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('registrations.update', $registration->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" class="form-control" value="{{ $registration->student->user->name }}"
                                disabled />
                        </div>
                        <div class="form-group">
                            <label>Matric ID <span class="required">*</span></label>
                            <input type="text" class="form-control" name="matric_id"
                                value="{{ $registration->student->matric_id }}" />
                        </div>
                        <div class="form-group">
                            <label for="event_mode">Event Mode <span class="required">*</span></label>
                            @php
                                $event_modes = ['Proposal Defence', 'Candidature Defence', 'Thesis Seminar'];
                            @endphp
                            <select class="custom-select rounded-0" name="event_mode" required>
                                <option value="{{ $registration->event_mode }}" selected>
                                    {{ $registration->event_mode }}
                                </option>
                                @foreach ($event_modes as $event_mode)
                                    @if ($registration->event_mode !== $event_mode)
                                        <option value={{ $event_mode }}>{{ $event_mode }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Research Title <span class="required">*</span></label>
                            <input type="text" class="form-control" name="title"
                                value="{{ $registration->title }}" />
                        </div>
                        <div class="form-group">
                            <label>Abstract</label>
                            <textarea class="form-control @error('abstract') is-invalid @enderror" rows="5" id="abstract"
                                name="abstract">{{ $registration->abstract }}</textarea>
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
                            <label>Report Upload</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="report">Choose file</label>
                                <input type="file" class="@error('report') is-invalid @enderror custom-file-input"
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
                            <label>Supervisor(s) <span class="required">*</span></label>
                            <select class="select2bs4 @error('supervisor') is-invalid @enderror" multiple="multiple"
                                name="supervisor[]" style="width: 100%">
                                @if ($registration->sv_1_id != null)
                                    <option value="{{ $registration->sv_1_id }}" selected>
                                        {{ $registration->supervisor_1->name }}</option>
                                @endif
                                @if ($registration->sv_2_id != null)
                                    <option value="{{ $registration->sv_2_id }}" selected>
                                        {{ $registration->supervisor_2->name }}</option>
                                @endif
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
                        @if (Auth::user()->role_id == 4)
                        <div class="form-group">
                            <label for="panel_1">Panel 1<span class="required">*</span></label>
                            <select class="form-control select2bs4 @error('panel_1') is-invalid @enderror" name="panel_1">
                                @foreach ($lecturers as $panel)
                                    <option value={{ $panel->id }} @if ($registration->panel_1_id == $panel->id) {{ 'selected' }} @endif>
                                        {{ $panel->name }}
                                    </option>
                                @endforeach
                            </select>
            
                            @error('panel_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <label for="panel_2">Panel 2<span class="required">*</span></label>
                            <select class="form-control select2bs4 @error('panel_2') is-invalid @enderror" name="panel_2">
                                @foreach ($lecturers as $panel)
                                    <option value={{ $panel->id }} @if ($registration->panel_2_id == $panel->id) {{ 'selected' }} @endif>
                                        {{ $panel->name }}
                                    </option>
                                @endforeach
                            </select>
            
                            @error('panel_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @endif
                        <div class="modal-footer text-right">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
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

        $('#reportFileName').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#reportFileName')[0].files[0].name;
            $(this).prev('label').text(file);
        });


        @if (count($errors) > 0)
            $('#modal-registration').modal('show');
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
