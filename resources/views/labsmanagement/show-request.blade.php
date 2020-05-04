@extends('layouts.app')

@section('template_title')
    Show Request
@endsection

@section('template_fastload_css')
.data {
    text-decoration-line: underline;
    text-decoration-style: dashed;
    text-decoration-color: blue;
}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {{__('Details') }} for Request ID: {{$test->unique_id }}
                        @switch($test->status)
                            @case(0)
                                <span class="pull-right badge p-1 badge-warning" style="margin-top:4px">
                                   {{__('Pending')}} 
                                </span>
                                @break
                            @case(1)
                                <span class="pull-right badge p-1 badge-danger" style="margin-top:4px">
                                    {{__('Processing')}} 
                                </span>
                                @break
                            @case(2)
                                <span class="pull-right badge p-1 badge-success" style="margin-top:4px">
                                    {{__('Test Done')}} 
                                </span>
                                @break
                            @case(10)
                                <span class="pull-right badge p-1 badge-info" style="margin-top:4px">
                                    {{__('Payment Received')}} 
                                </span>
                                @break
                            @default
                            <span class="pull-right badge p-1 badge-default" style="margin-top:4px">
                                {{__('Unknown')}} 
                            </span>
                        @endswitch
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col col-md-4">Patient Name: <span class="data">{{$patient->name}} </span></div>
                        <div class="col">Age: <span class="data">{{$patient->age}} </span> yrs</div>
                        <div class="col">Gender: <span class="data">{{$patient->sex}} </span></div>
                    
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">Hospital Name: <span class="data">{{$request->hospital->name}} </span> </div>
                        <div class="col">Consulting Doctor: <span class="data">{{$request->doctor}} </span></div>
                        <div class="col">Ailment: <span class="data"> {{$request->ailment}} </span></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">Test Name: <span class="data">{{$test->test_name}} </span> </div>
                        <div class="col">Price: <span class="data">INR {{$test->price}} </span></div>
                        <div class="col"><a href="uploads/{{$request->prescription}}" target="_blank">Scanned Prescription</a></div>
                    </div>
                </div>
                <div class="card-footer">
                    
                   @if ($test->status === 0)
                    <a href="{{ URL::to('testreq/'. $test->unique_id. '/process')}}" class="btn btn-success">Start Processing</a>
                   @elseif ($test->status === 1)
                   <div class="badge p-2 badge-danger">Temp. OTP : {{$test->otp}}</div>
                   {!! Form::open(array('route' => 'testreq.complete', 'method' => 'POST', 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Mark COmplete')) !!}
                    @csrf
                    {!! Form::hidden('unique_id', $test->unique_id )!!}
                    <div class="form-group has-feedback row {{ $errors->has('otp') ? ' has-error ' : '' }}">
                    {!! Form::label('otp', 'OTP received by patient', array('class' => 'col-md-3 control-label')); !!}
                    {!! Form::text('otp', NULL, array('id' => 'otp', 'class' => 'form-control col-md-2', 'required'=> 'true', 'placeholder' => 'Enter OTP ')) !!}
                    </div>
                    {!! Form::button('Mark Complete', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                   @elseif ($test->status === 2)
                        Test done at {{$test->completed_at->diffForHumans()}}
                    @endif
                    <span class="pull-right"><a href="{{route('public.home')}}" class="btn btn-info">Back to Dashboard</a></span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
