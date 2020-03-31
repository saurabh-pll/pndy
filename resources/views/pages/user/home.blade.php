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
        <div class="row">
            <div class="col-12 col-lg-12 ">

                @include('panels.welcome-panel')

            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
