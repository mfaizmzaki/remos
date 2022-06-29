@extends('adminlte::page')

@section('title', 'Create Event')

@section('content_header')
<br>
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

<div class="row">
    <div class="col-md-6">
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
                    <label for="eventMode">Event Mode <span class="required">*</span></label>
                    @php
                    $event_modes = array('Proposal Defence', 'Candidature Defence', 'Thesis Seminar');
                    @endphp
                    <select class="custom-select rounded-0" name="eventMode" required>
                        <option value="{{ $registration->event_mode }}" selected>{{ $registration->event_mode }}</option>
                        @foreach ($event_modes as $event_mode)
                        @if ($registration->event_mode !== $event_mode)
                        <option value={{ $event_mode }}>{{ $event_mode }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Research Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $registration->title }}" disabled />
                </div>
                <div class="form-group">
                    <label>Abstract</label>
                    <textarea class="form-control @error('abstract') is-invalid @enderror" rows="5" id="abstract" name="abstract" value="{{ $registration->abstract }}"></textarea>
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
                    <select class="select2bs4 @error('supervisor') is-invalid @enderror" multiple="multiple" name="supervisor[]" style="width: 100%">
                        @if ($registration->sv_1_id != null)
                        <option value="{{ $registration->sv_1_id }}" selected>{{ $registration->supervisor_1->name }}</option>
                        @endif
                        @if ($registration->sv_2_id != null)
                        <option value="{{ $registration->sv_2_id }}" selected>{{ $registration->supervisor_2->name }}</option>
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
                <!-- /.card-body -->
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

        @if(count($errors) > 0)
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