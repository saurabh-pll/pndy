@extends('layouts.app')

@section('template_title')
    {!! "Diagnostic Labs" !!}
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
<style type="text/css" media="screen">
.labs-table {
    border: 0;
}
.labs-table tr td:first-child {
    padding-left: 15px;
}
.labs-table tr td:last-child {
    padding-right: 15px;
}
.labs-table.table-responsive,
.labs-table.table-responsive table {
    margin-bottom: 0;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">List of Diagnostic Labs</span>
                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-success" href="/labs/create">
                                <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                               New Diagnostic Lab
                            </a>
                            {{-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                <span class="sr-only">
                                    Labs Menu
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/labs/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                   New Diagnostic Lab
                                </a>
                                <a class="dropdown-item" href="/users/deleted">
                                    <i class="fa fa-fw fa-trash" aria-hidden="true"></i>
                                    Show Deleted Labs
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive labs-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="labs_count">
                                Total Labs: {{$labs->count()}}
                            </caption>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name (Address)</th>
                                    <th>Tests</th>
                                    <th>Mobile No.</th>
                                    <th>Email Address</th>
                                    <th>Payment Mechanism &amp; Frequency</th>
                                    <th class="no-search no-sort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($labs as $lab)
                                    <tr>
                                        <td>{{$lab->id}}</td>
                                    <td>{{$lab->name}}<br><pre>{{$lab->address}}</pre></td>
                                    <td>
                                        @foreach ($lab->tests as $test)
                                            {{$test->name}} ,
                                        @endforeach
                                    </td>
                                    <td>{{$lab->mobile}}</td>
                                    <td>{{$lab->email}}</td>
                                    <td>{{$lab->payment_mechanism}}<br>{{$lab->payment_frequency}}</td>
                                        <td>
                                           
                                            {!! Form::open(array('url' => 'labs/' . $lab->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {{-- <a class="btn btn-sm btn-success " href="{{ URL::to('labs/' . $lab->id) }}" data-toggle="tooltip" title="Show">
                                                Show
                                            </a> --}}
                                            <a class="btn btn-sm btn-info " href="{{ URL::to('labs/' . $lab->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                Edit
                                            </a>
                                            {!! Form::button('Delete', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete lab', 'data-message' => 'Are you sure you want to delete this lab ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $labs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.modal-delete')
@endsection