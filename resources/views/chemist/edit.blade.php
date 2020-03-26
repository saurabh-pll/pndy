@extends('layouts.app')

@section('template_title')
    Editing Chemist: {{$chemist->name}}
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
                        Editing Diagnostic Chemist : {{$chemist->name}}
                        <div class="pull-right">
                            <a href="{{ route('labs.index') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to labs">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                               Back to Chemists
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => ['labs.update', $chemist->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                    {!! csrf_field() !!}
                    <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                        {!! Form::label('name', 'Chemist Name', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('name', $chemist->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Lab Name')) !!}
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
                    <div class="form-group has-feedback row {{ $errors->has('address') ? ' has-error ' : '' }}">
                        {!! Form::label('address', 'Chemist Address', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                                {!! Form::textarea('address', $chemist->address, array('id' => 'address', 'class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter Lab Address')) !!}
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('pincode') ? ' has-error ' : '' }}">
                        {!! Form::label('pincode', 'Chemist pincode', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                                {!! Form::text('pincode', $chemist->pincode, array('id' => 'pincode', 'class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter pincode')) !!}
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
                                {!! Form::text('mobile', $chemist->mobile, array('id' => 'mobile', 'class' => 'form-control', 'placeholder' => 'Enter Lab Mobile Number')) !!}
                                
                            </div>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                        {!! Form::label('email', 'Email Address', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('email', $chemist->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email Address')) !!}
                                <div class="input-group-append">
                                    <label for="email" class="input-group-text">
                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('payment_mechanism') ? ' has-error ' : '' }}">
                        {!! Form::label('payment_mechanism', 'Payment Mechanism', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                <select class="custom-select form-control" name="payment_mechanism" id="payment_mechanism">
                                    <option value="">Select Mechanism</option>
                                    <option value="Online" {{ $chemist->payment_mechanism == "Online" ? 'selected="selected"' : '' }}>Online (NEFT / RTGS)</option>
                                    <option value="UPI" {{ $chemist->payment_mechanism == "UPI" ? 'selected="selected"' : '' }}>UPI</option>
                                    <option value="Offline" {{ $chemist->payment_mechanism == "Offline" ? 'selected="selected"' : '' }}>Offline(Cheque)</option>
                                </select>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="payment_mechanism">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('payment_mechanism'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('payment_mechanism') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('payment_frequency') ? ' has-error ' : '' }}">
                        {!! Form::label('payment_frequency', 'Payment Frequency', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                <select class="custom-select form-control" name="payment_frequency" id="payment_frequency">
                                    <option value="" >Select Frequency</option>
                                    <option value="Daily" {{ $chemist->payment_frequency == "Daily" ? 'selected="selected"' : '' }}>Daily</option>
                                    <option value="Weekly" {{ $chemist->payment_frequency == "Weekly" ? 'selected="selected"' : '' }}>Weekly</option>
                                    <option value="Monthly" {{ $chemist->payment_frequency == "Monthly" ? 'selected="selected"' : '' }}>Monthly</option>
                                </select>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="payment_frequency">
                                        <i class="fa fa-area-chart" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('payment_frequency'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('payment_frequency') }}</strong>
                                </span>
                            @endif
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