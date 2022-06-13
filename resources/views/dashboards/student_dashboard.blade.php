@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Student Dashboard</h1>
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
                    <h3 class="card-title">REMOS Application Table </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-text text-right">
                        <a href="#" class="btn btn-primary btn-md" data-toggle="modal" data-target="#new-application">Create new REMOS application</a>
                    </div>
                </div>
                <div class="card-body">

                    @php
                    $heads = [
                    'Title',
                    'Abstract',
                    ['label' => 'Status', 'width' => 40],
                    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
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
                    <x-adminlte-datatable id="table1" :heads="$heads">
                        @foreach ($interests as $interest)
                        <tr>
                            <td>{{ $interest->title }}</td>
                            <td>{{ $interest->abstract }}</td>
                            <td>{{ $interest->isApproved }}</td>
                            @if ($interest->isApproved == 'Approved')
                            <td>
                                <nobr>{!! $btnDetails !!}</nobr>
                            </td>
                            @else
                            <td>
                                <!-- <nobr>{!! $btnUpdate.$btnDelete.$btnDetails !!}</nobr> -->
                                <nobr>
                                    <a href="" id="update-interest" data-toggle="modal" data-target='#update-interest-modal' data-interest="{{ $interest->id }}"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                                </nobr>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal new-application -->
<div class="modal fade" id="new-application">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New REMOS Application </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
                                        <div class="step" data-target="#logins-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Research Details</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Confirmation</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                        </div>
                                        <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                            <div class="form-group">
                                                <label for="exampleInputFile">File input</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal update-application -->
<div class="modal fade" id="update-interest-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update REMOS Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-remos" name="update-remos" class="form-horizontal" method="POST">
                    <input type="hidden" name="interest-id" id="interest-id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Defence Type</label>
                        <div class="col-sm-12">
                            <select name="defence_type" class="form-control" id="defence-selector">
                                <option value="Proposal Defence" {{ $interest->defence_type == "Proposal Defence" ? 'selected' : ''}}>Proposal Defence</option>
                                <option value="Candidature Defence" {{ $interest->defence_type == "Candidature Defence" ? 'selected' : ''}}>Candidature Defence</option>
                                <option value="Thesis Seminar" {{ $interest->defence_type == "Thesis Seminar" ? 'selected' : ''}}>Thesis Seminar</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $interest->title }}" required>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="submit" value="updateInterest">Save changes
                        </button>
                    </div>
                </form>

                <p>Display remos application from db here</p>
            </div>
            <div class="modal-footer justify-content-between">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
</script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    });

    ('body').on('click', '#submit', function(event) {
        event.preventDefault()
        var interest_id = $("#interest-id").val();
        var defence_type = $("#defence-selector").val();
        var title = $("#title").val();

        $.ajax({
            url: '/interest/' + interest_id,
            type: "POST",
            data: {
                interest_id: interest_id,
                defence_type: defence_type,
                title: title,
            },
            dataType: 'json',
            success: function(data) {

                $('#update-remos').trigger("reset");
                $('#update-interest-modal').modal('hide');
                window.location.reload(true);
            }
        });

        $('body').on('click', '#update-interest', function(event) {

            event.preventDefault();
            var interest_id = $(this).data('interest');
            var interest_route = '{{ route("show_interest", ":interest_id") }}';
            interest_route = interest_route.replace(':interest_id', interest_id);
            dd(interest_route);
            $.get(interest_route, function(data) {
                // $('#userCrudModal').html("Edit category");
                $('#submit').val("Edit category");
                $('#update-interest-modal').modal('show');
                $('#interest-id').val(data.data.interest_id);
                $('#defence-selector').val(data.data.defence-selector);
                $('#title').val(data.data.title);
            })
        });

    });
</script>
@stop