@extends('layouts.app')

@section('template_title')
    Create New Diagnostic Lab
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
                        Create New Diagnostic Diagnostic Lab
                        <div class="pull-right">
                            <a href="{{ route('labs.index') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to labs">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                               Back to Diagnostic Labs
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'labs.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                    {!! csrf_field() !!}
                    <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                        {!! Form::label('name', 'Diagnostic Lab Name', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Lab Name')) !!}
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
                        {!! Form::label('address', 'Diagnostic Lab Address', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                                {!! Form::textarea('address', NULL, array('id' => 'address', 'class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter Lab Address')) !!}
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('pincode') ? ' has-error ' : '' }}">
                        {!! Form::label('pincode', 'Pincode', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
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
                    <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                        {!! Form::label('email', 'Email Address', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email Address')) !!}
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
                                    <option value="Online">Online (NEFT / RTGS)</option>
                                    <option value="UPI">UPI</option>
                                    <option value="Offline">Offline(Cheque)</option>
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
                                    <option value="">Select Frequency</option>
                                    <option value="Daily">Daily</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
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
                    <div class="form-group col-md-12">
                        <table class="table table-responsive table-striped table-sm data-table" id="testTable">
                            <thead>
                                <th>Select</th><th>Test Name</th><th>Price</th>
                            </thead>
                            <tbody id="testBody"></tbody>
                            <tfoot>
                                <tr><td colspan="3">
                                    <button type="button" class="btn btn-info" data-toggle = 'modal' data-target = '#addTest'>Add New</button>
                                    <button type="button" class="btn btn-danger" id="btnDel">Delete</button>
                                </td></tr>
                            </tfoot>
                        </table>
                    </div>
                    {!! Form::button('Submit', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.modal-addtest')
@endsection

@section('footer_scripts')
<script>
    $("#btnAdd").on("click", function(e){
        var testID = $("#test").val();
        var testName = $("#test option:selected").text();
        var price = $("#price").val();
        var tempDom = '<tr><td><input type="checkbox" name="record" class="testSelect"></td>';
            tempDom += '<td><input type="hidden" name="tests[]" value="'+ testID +'">' + testName + '</td>';
            tempDom += '<td><input type="hidden" name="price[]" value="'+ price +'">' + price + '</td></tr>';
        $("#testBody").append(tempDom);
    });

    $("#btnDel").on('click', function (e){
     $("#testTable tbody").find('input[name="record"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
    });

</script>

@endsection