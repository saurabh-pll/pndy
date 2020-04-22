@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')

    .card-inverse {
        color: rgba(255,255,255,.65);
    }       
    .card {
        overflow: hidden;
        border-radius: 0.5rem;
    }
    .card-block {
        -webkit-box-flex: 1;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card-block .rotate {
        z-index: 8;
        float: right;
        height: 100%;
    }

    .card-block .rotate i {
        color: rgba(20, 20, 20, 0.15);
        position: absolute;
        padding: 20px;
        left: auto;
        right: -10px;
        bottom: 0;
        display: block;
        -webkit-transform: rotate(-44deg);
        -moz-transform: rotate(-44deg);
        -o-transform:rotate(-44deg);
        -ms-transform:rotate(-44deg);
        transform: rotate(-44deg);
    }

@endsection

@section('content')

    <div class="container">
        <div class="row mb-3">
            
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="card card-inverse card-success">
                    <div class="card-block bg-success">
                        <div class="rotate">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Open Requests</h6>
                        <h1 class="display-1">{{count($testreqs)}}</h1>
                    </div>
                    <div class="card-footer text-dark">
                        <small>Last updated at: {{date('d-M-Y H:i:s')}}</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="card card-inverse card-danger">
                    <div class="card-block bg-danger">
                        <div class="rotate">
                            <i class="fa fa-medkit fa-5x"></i>
                        </div>
                    <h6 class="text-uppercase">Completed Requests</h6>
                        <h1 class="display-1">{{count($completedtests_monthly)}}</h1>
                    </div>
                    <div class="card-footer text-dark">
                        <small> In the month of {{date('M-Y')}}</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="card card-inverse card-warning">
                    <div class="card-block bg-warning">
                        <div class="rotate">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Pending Payments</h6>
                        <h1 class="display-1">{{count($pending_payment)}}</h1>
                    </div>
                    <div class="card-footer text-dark">
                        <small>Last updated at: {{date('d-M-Y H:i:s')}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4 col-lg-4 ">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Get Request Details using Unique ID</h5>
                    </div>
                    <div class="card-body">
                     <div id="sreachDiv">
                     {!! Form::open(array('route' => 'search.test', 'method' => 'POST', 'role' => 'form', 'id' => 'search_form', 'class' => 'needs-validation')) !!}
                     {!! csrf_field() !!}
                     <div class="form-group has-feedback row {{ $errors->has('unique_id') ? ' has-error ' : '' }}">
                         {{-- {!! Form::label('unique_id', 'Enter Unique ID', array('class' => 'col-md-3 control-label')); !!} --}}
                         <div class="col-md-9">
                                 {!! Form::text('unique_id', NULL, array('id' => 'unique_id', 'class' => 'form-control', 'placeholder' => 'Enter Request ID')) !!}
                             @if ($errors->has('unique_id'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('unique_id') }}</strong>
                                 </span>
                             @endif
                         </div>
                         <div class="col-md-3">
                             {!! Form::button('Submit', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                         </div>
                     </div>
                     {!! Form::close() !!}
                    </div>
                    </div>
                    
                </div>
                
             </div>
        </div>
        
    </div>

@endsection

@section('footer_scripts')
<script>
    // $(function(){
    //     var searchform = $("#search_form");
    //     var resultsContainer = $("#resultDiv");

    //     searchform.submit(function(e){
    //         e.preventDefault();
    //         resultsContainer.html('');
    //         $.ajax({
    //             type:'POST',
    //             url: "{{ route('search.test') }}",
    //             data: searchform.serialize(),
    //             success: function (result) {
    //                 let jsonData = JSON.parse(result);
    //                 resultsContainer.append('<table><tr><td>Patient Name</td><td>' + jsonData.patient.name + 
    //                     '</td></tr>');
    //             },
    //             error: function (response, status, error) {
    //                 if (response.status === 422) {
    //                     resultsContainer.append("Request ID not found!");
    //                 }
    //             },
    //         });
    //     });
    // });
</script>
@endsection