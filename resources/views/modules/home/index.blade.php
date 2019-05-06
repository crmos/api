@extends('modules.layout.app')

@section('content')
    <!-- Breadcrumbs-->
    @include('modules.partials.common.breadcrum')

    <!-- Icon Cards-->
    <div class="row">
        <div class="col-md-9 col-lg-9">

                @foreach(range(1,5) as $value)
                <div class="row">
                    <div class="col-md-1 col-lg-1">
                        <i class="fas fa-user-circle fa-fw" style="font-size: 50px;"></i>
                    </div>
                    <div class="col-md-11 col-lg-11">
                        <a href="#">{{$value}} Task title</a>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda debitis dolor ducimus, explicabo fugit, incidunt labore laboriosam maxime placeat quaerat quidem suscipit, veritatis? Aliquid aperiam commodi nihil provident sunt voluptatum.
                        <br>
                        <span class="text-primary">Category</span>
                        <span class="text-success">Comment</span>
                        <span class="text-info">Like</span>
                        <br>
                        <span class="text-muted">{{$value}} minutes ago</span>
                    </div>
                </div>
                <hr>
                @endforeach
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="row">
                <div class="col-xl-12 col-sm-12 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">xxx Employees</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">xxx Customers</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-shopping-cart"></i>
                            </div>
                            <div class="mr-5">xx Current Projects</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-life-ring"></i>
                            </div>
                            <div class="mr-5">xxx Stopped projects</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Area Chart Example-->
    <div class="card mb-3">
        <div class="card-body">
            <iframe id="forecast_embed" type="text/html" frameborder="0" height="245" width="100%"
                    src="//forecast.io/embed/#lat=26.088368&lon=-80.159604&name=Wellington
                    color=#00aaff&font=Arial&units=us"></iframe>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script>
@endpush