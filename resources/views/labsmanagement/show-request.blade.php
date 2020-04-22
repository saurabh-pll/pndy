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
                        
                        <span class="pull-right badge badge-primary" style="margin-top:4px">
                            {{$test->status?? 'Active'}}
                        </span>
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
            </div>
        </div>
    </div>
</div>

@endsection
