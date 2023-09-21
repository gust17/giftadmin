@extends(backpack_view('blank'))

@section('content')
    <div class="container">

        <div name="widget_775398408" section="before_content" class="row mt-3">

            <div class="col-sm-6 col-lg-3">
                <div class="card mb-3  border-start-0 ">

                    <div class="ribbon ribbon-top bg-success ">
                        <i class="la la-user fs-3"></i>
                    </div>

                    <div class="card-status-start bg-success"></div>

                    <div class="card-body">
                        <div class="subheader ">Clientes</div>

                        <div class="h1 mb-3 ">{{$userClientes->count()}}</div>

                        <div class="d-flex mb-2">
                            <div class="card-text "></div>
                        </div>



                    </div>

                </div>
            </div>


            <div class="col-sm-6 col-lg-3">
                <div class="card mb-3  border-start-0 ">

                    <div class="ribbon ribbon-top bg-danger ">
                        <i class="la la-bell fs-3"></i>
                    </div>

                    <div class="card-status-start bg-danger"></div>

                    <div class="card-body">
                        <div class="subheader ">Lojas Parceiras</div>

                        <div class="h1 mb-3 ">{{$parceiras->count()}}</div>

                        <div class="d-flex mb-2">
                            <div class="card-text "></div>
                        </div>



                    </div>

                </div>
            </div>


            <div class="col-sm-6 col-lg-3">
                <div class="card mb-3  border-start-0 ">

                    <div class="ribbon ribbon-top bg-info ">
                        <i class="la la-star fs-3"></i>
                    </div>

                    <div class="card-status-start bg-info"></div>

                    <div class="card-body">
                        <div class="subheader ">Cartões em Pagos</div>

                        <div class="h1 mb-3 ">{{$presentes->where('status','!=',0)->count()}}</div>

                        <div class="d-flex mb-2">
                            <div class="card-text "></div>
                        </div>



                    </div>

                </div>
            </div>


            <div class="col-sm-6 col-lg-3">
                <div class="card mb-3  border-start-0 ">

                    <div class="ribbon ribbon-top bg-warning ">
                        <i class="la la-lock fs-3"></i>
                    </div>

                    <div class="card-status-start bg-warning"></div>

                    <div class="card-body">
                        <div class="subheader ">Cartões em Aberto</div>

                        <div class="h1 mb-3 ">{{$presentes->where('status','==',0)->count()}}</div>

                        <div class="d-flex mb-2">
                            <div class="card-text "></div>
                        </div>



                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
