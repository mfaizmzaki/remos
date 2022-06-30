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

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('/register') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Full Name <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Enter full name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address <span class="required">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" name="email" placeholder="Enter email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="Enter default password (IC/Passport Number)">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation <span class="required">*</span></label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" placeholder="Enter default password (IC/Passport Number)">
                </div>
                <div class="form-group">
                    <label for="name">Staff/Student ID <span class="required">*</span></label>
                    <input type="text" class="form-control @error('matric') is-invalid @enderror" name="matric"
                        value="{{ old('matric') }}" placeholder="Enter matric number (E.g. 17001234)">

                    @error('matric')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Department <span class="required">*</span></label>
                    <select class="custom-select rounded-0 @error('department') is-invalid @enderror" name="department">
                        <option value="" disabled selected hidden>Choose Department</option>
                        <@foreach ($departments as $department)
                            <option value={{ $department->id }}
                                @if (old('department') == $department->id) {{ 'selected' }} @endif>
                                {{ $department->department_name }}</option>
                            @endforeach
                    </select>

                    @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role <span class="required">*</span></label>
                    <select class="custom-select rounded-0 @error('role') is-invalid @enderror" name="role"
                        id="role">
                        <option value="" disabled selected hidden>Choose role</option>
                        <@foreach ($roles as $role)
                            <option value={{ $role->id }}
                                @if (old('role') == $role->id) {{ 'selected' }} @endif>{{ $role->role_name }}
                            </option>
                            @endforeach
                    </select>

                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group" id="program" style="display: none">
                    <label for="program">Program <span class="required">*</span></label>
                    <select class="custom-select rounded-0 @error('program') is-invalid @enderror" name="program">
                        <option value="" disabled selected hidden>Choose program</option>
                        <option value="PhD" @if (old('program') == 'PhD') {{ 'selected' }} @endif>PhD</option>
                        <option value="Master by Research" @if (old('program') == 'Master by Research') {{ 'selected' }} @endif>
                            Master by Research</option>
                        <option value="Master by Coursework" @if (old('program') == 'Master by Coursework') {{ 'selected' }} @endif>
                            Master by Coursework</option>
                    </select>

                    @error('program')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group" id="semester" style="display: none">
                    <label for="semester">Current Semester <span class="required">*</span></label>
                    <input type="text" class="form-control @error('semester') is-invalid @enderror" name="semester"
                        value="{{ old('semester') }}" placeholder="Enter current semester: Numbers only">

                    @error('semester')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
        </form>
    </div>

@stop

@section('css')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#role').change(function() {
                if ($(this).val() == "1") {
                    $('#program').show();
                    $('#semester').show();
                } else {
                    $('#program').hide();
                    $('#semester').hide();
                }
            });

            var role = $('#role').val();
            if (role == "1") {
                $('#program').show();
                $('#semester').show();
            } else {
                $('#program').hide();
                $('#semester').hide();
            }
        });
    </script>
@stop
