@extends('layouts.app')

@section('template_title')
    Editing {{$test->name}}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                       Editing Diagnostic Test: {{$test->name}}
                        <div class="pull-right">
                            <a href="{{ route('tests.index') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to Tests">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                               Back to Tests
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => ['tests.update', $test->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                    {!! csrf_field() !!}
                    <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                        {!! Form::label('name', 'Diagnostic Test Name', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('name', $test->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Test Name')) !!}
                                <div class="input-group-append">
                                    <label for="name" class="input-group-text">
                                        <i class="fa fa-fw fa-stethoscope" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {!! Form::button('Save changes', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
@endsection