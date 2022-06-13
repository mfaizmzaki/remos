@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')

<form action="{{ $register_url }}" method="post">
    @csrf

    {{-- Name field --}}
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    {{-- Email field --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Matric ID field --}}
    <div class="input-group mb-3">
        <input type="text" name="matric" class="form-control @error('matric') is-invalid @enderror" value="{{ old('matric') }}" placeholder="{{ __('adminlte::adminlte.matric') }}" autofocus>

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('matric')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Program Mode field --}}
    <div class="input-group mb-3">
        <select name ="program" class="form-control @error('program') is-invalid @enderror custom-select rounded-0" id="programModeSelector">
            <option value="" hidden selected>{{ __('adminlte::adminlte.program') }}</option>
            <option value="Master">Master</option>
            <option value="PhD">PhD</option>
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-graduation-cap {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('program')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Research Mode field --}}
    <div class="input-group mb-3">
        <select name ="mode" class="form-control @error('mode') is-invalid @enderror custom-select rounded-0" id="researchModeSelector">
            <option value="" hidden selected>{{ __('adminlte::adminlte.mode') }}</option>
            <option value="Research">Research</option>
            <option value="Mix Mode">Mix Mode</option>
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-flask {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('mode')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Current Semester field --}}
    <div class="input-group mb-3">
        <input type="text" name="current_sem" class="form-control @error('current_sem') is-invalid @enderror" value="{{ old('current_sem') }}" placeholder="{{ __('adminlte::adminlte.current_sem') }}" autofocus>

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('current_sem')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Department field --}}
    <div class="input-group mb-3">
        <select name="dept" class="form-control @error('dept') is-invalid @enderror custom-select rounded-0" id="departmentSelector">
            <option value="" hidden selected>{{ __('adminlte::adminlte.dept') }}</option>
            <option value=1>Computer System and Technology</option>
            <option value=2>Artificial Intelligence</option>
            <option value=3>Software Engineering</option>
            <option value=4>Information Systems</option>
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-university {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('dept')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    {{-- Password field --}}
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('adminlte::adminlte.password') }}">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Confirm password field --}}
    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('adminlte::adminlte.retype_password') }}">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Register button --}}
    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
        <span class="fas fa-user-plus"></span>
        {{ __('adminlte::adminlte.register') }}
    </button>

</form>
@stop

@section('auth_footer')
<p class="my-0">
    <a href="{{ $login_url }}">
        {{ __('adminlte::adminlte.i_already_have_a_membership') }}
    </a>
</p>
@stop