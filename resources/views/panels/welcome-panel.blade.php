{{-- <div class="card">
    <div class="card-header @role('admin', true) bg-secondary text-white @endrole">

        Welcome {{ Auth::user()->name }}

        @role('admin', true)
            <span class="pull-right badge badge-primary" style="margin-top:4px">
                Admin Access
            </span>
        @else
            <span class="pull-right badge badge-warning" style="margin-top:4px">
                User Access
            </span>
        @endrole

    </div>
     <div class="card-body"> --}}
        <div class="row mb-3">
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="card card-inverse card-success">
                    <div class="card-block bg-success">
                        <div class="rotate">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Total Patients</h6>
                        <h1 class="display-1">{{$patientcount ?? ''}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="card card-inverse card-danger">
                    <div class="card-block bg-danger">
                        <div class="rotate">
                            <i class="fa fa-medkit fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Total Diagnostic Lab</h6>
                        <h1 class="display-1">{{$labs ?? ''}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="card card-inverse card-info">
                    <div class="card-block bg-info">
                        <div class="rotate">
                            <i class="fa fa-stethoscope fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Total Tests</h6>
                        <h1 class="display-1">{{$testcount ?? ''}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="card card-inverse card-warning">
                    <div class="card-block bg-warning">
                        <div class="rotate">
                            <i class="fa fa-plus-square fa-5x"></i>
                        </div>
                        <h6 class="text-uppercase">Total Chemist</h6>
                        <h1 class="display-1">{{$chemists ?? ''}}</h1>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> 
</div> --}}
