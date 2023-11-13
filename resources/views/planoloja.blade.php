@extends(backpack_view('blank'))

@section('content')
    <div class="container">

        <div name="widget_775398408" section="before_content" class="row mt-3">
        <h1>{{$parceira->name}}</h1>

            @if($planoAtual)
                <div class="card">
                    <div class="card-heading">
                        Plano Atual
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Plano</th>
                                <th>Taxa</th>
                                <th>Dias</th>
                                <th>Data Contrato</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$planoAtual->plano->name}}</td>
                                    <td>{{$planoAtual->plano->taxa}}%</td>
                                    <td>{{$planoAtual->plano->dias}}</td>
                                    <td>{{$planoAtual->created_at->format('d/m/Y')}}</td>
                                </tr>





                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-heading">
                        <h5 class="card-title">   Cadastre uma taxa para o Logista</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{url('admin/cadastraTaxa')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Taxa</label>
                                <input type="hidden" name="parceira_id" value="{{$parceira->id}}">
                                <select name="plano_id" id="" class="form-control">
                                    <option value=""></option>
                                    @forelse($planos as $plano)
                                        <option value="{{$plano->id}}">Plano: {{$plano->name}}  - Taxa {{$plano->taxa}}%</option>

                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>

                    </div>
                </div>

            @else
                <div class="card">
                    <div class="card-heading">
                      <h5 class="card-title">   Cadastre uma taxa para o Logista</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{url('admin/cadastraTaxa')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Taxa</label>
                                <input type="hidden" name="parceira_id" value="{{$parceira->id}}">
                                <select name="plano_id" id="" class="form-control">
                                    <option value=""></option>
                                    @forelse($planos as $plano)
                                        <option value="{{$plano->id}}">Plano: {{$plano->name}}  - Taxa {{$plano->taxa}}%</option>

                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>

                    </div>
                </div>

            @endif


            <div class="card">
                <div class="card-heanding">
                    <h5>Taxas já utilizadas</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Plano</th>
                            <th>Taxa</th>
                            <th>Dias</th>
                            <th>Data Contrato</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($parceira->contratos as $contrato)
                            <tr>
                                <td>{{$contrato->plano->name}}</td>
                                <td>{{$contrato->plano->taxa}}%</td>
                                <td>{{$contrato->plano->dias}}</td>
                                <td>{{$contrato->created_at->format('d/m/Y')}}</td>
                            </tr>

                        @empty
                        @endforelse



                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
