@extends('layouts.app')

@section('template_title')
    {!! "Chemists" !!}
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
<style type="text/css" media="screen">
.Chemists-table {
    border: 0;
}
.Chemists-table tr td:first-child {
    padding-left: 15px;
}
.Chemists-table tr td:last-child {
    padding-right: 15px;
}
.Chemists-table.table-responsive,
.Chemists-table.table-responsive table {
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
                        <span id="card_title">List of Chemists</span>
                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-success" href="/chemists/create">
                                <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                               New Chemist
                            </a>
                            {{-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                <span class="sr-only">
                                    Chemist Menu
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/chemists/create">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                   New Chemist
                                </a>
                                <a class="dropdown-item" href="/users/deleted">
                                    <i class="fa fa-fw fa-trash" aria-hidden="true"></i>
                                    Show Deleted Chemist
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive Chemists-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="Chemists_count">
                                Total Chemists: {{$chemists->count()}}
                            </caption>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name (Address)</th>
                                    
                                    <th>Mobile No.</th>
                                    <th>Email Address</th>
                                    <th>Payment Mechanism &amp; Frequency</th>
                                    <th class="no-search no-sort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chemists as $chemist)
                                    <tr>
                                        <td>{{$chemist->id}}</td>
                                    <td>{{$chemist->name}}<br><pre>{{$chemist->address}}</pre></td>
                                    
                                    <td>{{$chemist->mobile}}</td>
                                    <td>{{$chemist->email}}</td>
                                    <td>{{$chemist->payment_mechanism}}<br>{{$chemist->payment_frequency}}</td>
                                        <td>
                                           
                                            {!! Form::open(array('url' => 'Chemists/' . $chemist->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {{-- <a class="btn btn-sm btn-success " href="{{ URL::to('Chemists/' . $chemist->id) }}" data-toggle="tooltip" title="Show">
                                                Show
                                            </a> --}}
                                            <a class="btn btn-sm btn-info " href="{{ URL::to('Chemists/' . $chemist->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                Edit
                                            </a>
                                            {!! Form::button('Delete', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete lab', 'data-message' => 'Are you sure you want to delete this lab ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $chemists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.modal-delete')
@endsection