@extends('layouts.app')

@section('template_title')
    {{__('Hospitals') }}
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
<style type="text/css" media="screen">
.Hospitals-table {
    border: 0;
}
.Hospitals-table tr td:first-child {
    padding-left: 15px;
}
.Hospitals-table tr td:last-child {
    padding-right: 15px;
}
.Hospitals-table.table-responsive,
.Hospitals-table.table-responsive table {
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
                        <span id="card_title">List of Hospitals</span>
                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-success" href="/hospitals/create">
                                <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                               New Hospital
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive Chemists-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="Chemists_count">
                                Total Hospitals: {{$hospitals->count()}}
                            </caption>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name (Address)</th>
                                    <th class="no-search no-sort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hospitals as $hospital)
                                    <tr>
                                        <td>{{$hospital->id}}</td>
                                    <td>{{$hospital->name}}<br><pre>{{$hospital->address}}</pre>
                                        {{$hospital->pincode}}
                                    </td>
                                    
                                    
                                        <td>
                                           
                                            {!! Form::open(array('url' => 'hospitals/' . $hospital->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {{-- <a class="btn btn-sm btn-success " href="{{ URL::to('Chemists/' . $hospital->id) }}" data-toggle="tooltip" title="Show">
                                                Show
                                            </a> --}}
                                            <a class="btn btn-sm btn-info " href="{{ URL::to('hospitals/' . $hospital->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                Edit
                                            </a>
                                            {!! Form::button('Delete', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete lab', 'data-message' => 'Are you sure you want to delete this lab ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $hospitals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.modal-delete')
@endsection