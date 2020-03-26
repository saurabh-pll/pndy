@extends('layouts.app')

@section('template_title')
    {!! "Diagnostic Tests" !!}
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
<style type="text/css" media="screen">
.tests-table {
    border: 0;
}
.tests-table tr td:first-child {
    padding-left: 15px;
}
.tests-table tr td:last-child {
    padding-right: 15px;
}
.tests-table.table-responsive,
.tests-table.table-responsive table {
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
                        <span id="card_title">List of Diagnostic Tests</span>
                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-success" href="/tests/create">
                                <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                               New Test
                            </a>
                            {{-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                <span class="sr-only">
                                    Tests Menu
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/tests/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                   New Test
                                </a>
                                <a class="dropdown-item" href="/users/deleted">
                                    <i class="fa fa-fw fa-trash" aria-hidden="true"></i>
                                    Show Deleted Tests
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive tests-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="test_count">
                                Total Tests: {{$tests->count()}}
                            </caption>
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Name</th>
                                    <th class="no-search no-sort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tests as $test)
                                    <tr>
                                        <td>{{$test->id}}</td>
                                        <td>{{$test->name}}</td>
                                        <td>
                                           
                                            {!! Form::open(array('url' => 'tests/' . $test->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {{-- <a class="btn btn-sm btn-success " href="{{ URL::to('tests/' . $test->id) }}" data-toggle="tooltip" title="Show">
                                                Show
                                            </a> --}}
                                            <a class="btn btn-sm btn-info " href="{{ URL::to('tests/' . $test->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                Edit
                                            </a>
                                            {!! Form::button('Delete', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Test', 'data-message' => 'Are you sure you want to delete this test ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.modal-delete')
@endsection