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
                    Request for Diagnostic Tests for Patient : {{$patient->name}}
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'patient.testreq', 'files' => 'true', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                    {!! csrf_field() !!}
                    {!! Form::hidden('patient_id', $patient->id)!!}
                    <div class="form-group has-feedback row {{ $errors->has('hospital_id') ? ' has-error ' : '' }}">
                        {!! Form::label('hospital_id', 'Hospital', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                           <select class="custom-select form-control" name="hospital_id" id="hospital">
                            <option value="">{{ __('Select Hospital') }}</option>
                            @if($hospitals)
                                @foreach($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                @endforeach
                            @endif
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="test_id">
                                    <i class="fa fw fa-hospital-o" aria-hidden="true"></i>
                                </label>
                            </div>
                            </div>
                            @if ($errors->has('hospial_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hospital_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('doctor') ? ' has-error ' : '' }}">
                        {!! Form::label('doctor', 'Consulting Doctor', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('doctor', NULL, array('id' => 'doctor', 'class' => 'form-control', 'placeholder' => 'Enter Doctor Name')) !!}
                                <div class="input-group-append">
                                    <label for="doctor" class="input-group-text">
                                        <i class="fa fa-fw fa-user-md" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('doctor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('doctor') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('ailment') ? ' has-error ' : '' }}">
                        {!! Form::label('ailment', 'Ailment ', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('ailment', NULL, array('id' => 'ailment', 'class' => 'form-control', 'placeholder' => 'Enter ailment Name')) !!}
                                <div class="input-group-append">
                                    <label for="ailment" class="input-group-text">
                                        <i class="fa fa-fw fa-medkit" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('ailment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ailment') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('case_history') ? ' has-error ' : '' }}">
                        {!! Form::label('case_history', 'Brief Case History ', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::textarea('case_history', NULL, array('id' => 'case_history', 'rows' => 3, 'class' => 'form-control', 'placeholder' => 'Enter case history')) !!}
                                <div class="input-group-append">
                                    <label for="case_history" class="input-group-text">
                                        <i class="fa fa-fw fa-sticky-note-o" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('case_history'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('case_history') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row has-feedback {{ $errors->has('prescription') ? ' has-error ' : '' }}">
                        {!! Form::label('prescription', 'Upload Prescription', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            {!! Form::file('prescription', NULL, array('id'=>'prescription', 'class' => 'form-control', 'placeholder' => 'Select prescription')) !!}
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('test_id') ? ' has-error ' : '' }}">
                        {!! Form::label('test_id', 'Diagnostic Tests', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                           <select class="custom-select form-control" name="test_id" id="test">
                            <option value="">{{ __('Select Test') }}</option>
                            @if($tests)
                                @foreach($tests as $test)
                                    <option value="{{ $test->id }}">{{ $test->name }}</option>
                                @endforeach
                            @endif
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="test_id">
                                    <i class="fa fw fa-search" aria-hidden="true"></i>
                                </label>
                            </div>
                            </div>
                            @if ($errors->has('test_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('test_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('diagnostic_centre_id') ? ' has-error ' : '' }}">
                        {!! Form::label('diagnostic_centre_id', 'Diagnostic Centre', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                           <select class="custom-select form-control" name="diagnostic_centre_id" id="diagnostic_centre">
                            <option value="">{{ __('Select Diagnostic Centre') }}</option>
                            
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="diagnostic_centre_id">
                                    <i class="fa fw fa-search" aria-hidden="true"></i>
                                </label>
                            </div>
                            </div>
                            @if ($errors->has('diagnostic_centre_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('diagnostic_centre_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('allotted_date') ? ' has-error ' : '' }}">
                        {!! Form::label('allotted_date', 'Allotted Date', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::date('allotted_date', NULL, array('id' => 'allotted_date', 'class' => 'form-control', 'placeholder' => 'Enter allotted_date')) !!}
                                <div class="input-group-append">
                                    <label for="allotted_date" class="input-group-text">
                                        <i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('allotted_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('allotted_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('allotted_time') ? ' has-error ' : '' }}">
                        {!! Form::label('allotted_time', 'Allotted Time', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::time('allotted_time', NULL, array('id' => 'allotted_time', 'class' => 'form-control', 'placeholder' => 'Enter allotted_time')) !!}
                                <div class="input-group-append">
                                    <label for="allotted_time" class="input-group-text">
                                        <i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('allotted_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('allotted_time') }}</strong>
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
<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var diagnosticCentre = $("#diagnostic_centre");

    $("#test").on("change", function(){
        var test_id = $(this).val();
        var fd = new FormData();
        fd.append('test_id', test_id);
        $.ajax({
            type:'POST',
            url: "{{ route('search-labs') }}",
            data: fd,
            processData: false,
            contentType: false,
            success: function (result) {
                let jsonData = JSON.parse(result);
                if (jsonData.length != 0) {
                    $.each(jsonData, function(index, val){
                        let opt = '<option value="'+val.id+'">'+val.name+'</option>';
                        diagnosticCentre.append(opt);
                    });
                }
            },
            error: function (response, status, error){
                alert(error);
                alert(response);
            },
        });

    });
})
</script>
@endsection