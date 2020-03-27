@extends('layouts.app')

@section('template_title')
    Create New Patient
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
                        Create New Patient
                        <div class="pull-right">
                            <a href="{{ route('patients.index') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to patients">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                               Back to Patients
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'patients.store', 'files' => 'true', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                    {!! csrf_field() !!}
                    <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                        {!! Form::label('name', 'Patient Name', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Patient Name')) !!}
                                <div class="input-group-append">
                                    <label for="name" class="input-group-text">
                                        <i class="fa fa-fw fa-medkit" aria-hidden="true"></i>
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
                    <div class="form-group has-feedback row {{ $errors->has('age') ? ' has-error ' : '' }}">
                        {!! Form::label('age', 'Age', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-3">
                            <div class="input-group">
                                
                                {!! Form::text('age', NULL, array('id' => 'age', 'class' => 'form-control', 'placeholder' => 'Enter age in years')) !!}
                                <div class="input-group-append">
                                    <label for="age" class="input-group-text">
                                       years
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('age'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                            @endif
                        </div>
                    {{-- </div>
                    <div class="form-group has-feedback row {{ $errors->has('sex') ? ' has-error ' : '' }}"> --}}
                        {!! Form::label('sex', 'Gender', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-3">
                            <div class="input-group">
                                <select class="custom-select form-control" name="sex" id="sex">
                                    <option value="">Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="role">
                                        <i class="fa fw fa-venus" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('sex'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sex') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('categories') ? ' has-error ' : '' }}">
                        {!! Form::label('categories', 'Category', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            @foreach ($categories as $category)
                                {!! Form::checkbox('categories[]', $category->id)!!}
                        <label>{{$category->name}}</label>
                            @endforeach
                            @if ($errors->has('aadhar_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aadhar_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('address') ? ' has-error ' : '' }}">
                        {!! Form::label('address', 'Patient Address', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                                {!! Form::textarea('address', NULL, array('id' => 'address', 'class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter Patient Address')) !!}
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('city') ? ' has-error ' : '' }}">
                        {!! Form::label('city', 'City / State / PIN', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-3">
                                {!! Form::text('city', NULL, array('id' => 'city', 'class' => 'form-control', 'placeholder' => 'Enter City')) !!}
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{-- {!! Form::label('state', 'State', array('class' => 'col-md-1 control-label')); !!} --}}
                        <div class="col-md-3">
                                {!! Form::text('state', NULL, array('id' => 'state', 'class' => 'form-control', 'placeholder' => 'Enter State')) !!}
                            @if ($errors->has('state'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            {!! Form::text('pincode', NULL, array('id' => 'pincode', 'class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter pincode')) !!}
                        @if ($errors->has('pincode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pincode') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('mobile') ? ' has-error ' : '' }}">
                        {!! Form::label('mobile', 'Mobile Number', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label for="mobile" class="input-group-text">
                                        +91
                                    </label>
                                </div>
                                {!! Form::text('mobile', NULL, array('id' => 'mobile', 'class' => 'form-control', 'placeholder' => 'Enter Lab Mobile Number')) !!}
                                
                            </div>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('aadhar_no') ? ' has-error ' : '' }}">
                        {!! Form::label('aadhar_no', 'Aadhar No.', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('aadhar_no', NULL, array('id' => 'aadhar_no', 'class' => 'form-control', 'placeholder' => 'Aadhar Number')) !!}
                                <div class="input-group-append">
                                    <label for="aadhar_no" class="input-group-text">
                                        <i class="fa fa-fw fa-id-card" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('aadhar_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('aadhar_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="orm-group row has-feedback {{ $errors->has('file') ? ' has-error ' : '' }}">
                    {!! Form::label('file', 'Upload Aadhar Card', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        {!! Form::file('file', NULL, array('id'=>'file', 'class' => 'form-control', 'placeholder' => 'Select File')) !!}
                    </div>
                    </div>
                    
                   
                    {!! Form::button('Submit', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')
@endsection