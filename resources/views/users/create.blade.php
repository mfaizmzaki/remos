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
                    <h3 class="card-title">Create User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('create_user') }}" method="POST">
                  @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required>
                          </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Default Password (IC/Passport Number)">
                          </div>
                          <div class="form-group">
                            <label for="role">Department</label>
                            <select class="custom-select rounded-0" name="department" required>
                                <option value="" disabled selected hidden>Choose Department</option>
                                <@foreach ($departments as $department)
                                    <option value={{ $department->id }}>{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                          <div class="form-group">
                            <label for="role">Role</label>
                            <select class="custom-select rounded-0" name="role" required>
                                <option value="" disabled selected hidden>Choose Role</option>
                                <@foreach ($roles as $role)
                                    <option value={{ $role->id }}>{{ $role->role_name }}</option>
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
