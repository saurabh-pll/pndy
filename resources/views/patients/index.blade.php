@extends('layouts.app')

@section('template_title')
    {!! "Patients" !!}
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
<style type="text/css" media="screen">
.patients-table {
    border: 0;
}
.patients-table tr td:first-child {
    padding-left: 15px;
}
.patients-table tr td:last-child {
    padding-right: 15px;
}
.patients-table.table-responsive,
.patients-table.table-responsive table {
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
                        <span id="card_title">List of Patients</span>
                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-success" href="/patients/create">
                                <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                New Patient
                            </a>
                            {{-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                <span class="sr-only">
                                    Patients Menu
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/patients/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                   New Patient
                                </a>
                                <a class="dropdown-item" href="/users/deleted">
                                    <i class="fa fa-fw fa-trash" aria-hidden="true"></i>
                                    Show Deleted Patient
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive patients-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="patients_count">
                                Total patients: {{$patients->count()}}
                            </caption>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name (Address)</th>
                                    <th>State</th>
                                    <th>Mobile No.</th>
                                    <th>Category</th>
                                    <th>Aadhar No.</th>
                                    <th class="no-search no-sort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{$patient->id}}</td>
                                    <td>{{$patient->name}}<br><pre>{{$patient->address}}</pre>
                                        {{$patient->city}}, <br>
                                        pin: {{$patient->pincode}}
                                    </td>
                                    <td>{{$patient->state}}</td>
                                    <td>{{$patient->mobile}}</td>
                                    <td>
                                        @foreach ($patient->categories as $category)
                                            {{$category->name}}<br>
                                        @endforeach
                                    </td>
                                    <td>{{$patient->aadhar_no}}</td>
                                    
                                        <td>
                                           
                                            {!! Form::open(array('url' => 'patients/' . $patient->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {{-- <a class="btn btn-sm btn-success " href="{{ URL::to('patients/' . $patient->id) }}" data-toggle="tooltip" title="Show">
                                                Show
                                            </a> --}}
                                            <a class="btn btn-sm btn-info " href="{{ URL::to('patients/' . $patient->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                Edit
                                            </a>
                                            {!! Form::button('Delete', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete lab', 'data-message' => 'Are you sure you want to delete this lab ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $patients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.modal-delete')
@endsection