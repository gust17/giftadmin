@extends(backpack_view('blank'))

@section('content')
    <div class="container">

        <div name="widget_775398408" section="before_content" class="row mt-3">


            <div class="card">
                <div class="card-heanding">
                    <h5>Saques</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Quem Solicitou</th>
                            <th>Loja/Parceira</th>
                            <th>Plano</th>
                            <th>Taxa</th>
                            <th>Valor Saque</th>
                            <th>Pix</th>
                            <th>Data Limite</th>
                            <th>Status</th>
                            <th>Ações</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($saques as $saque)
                            <tr>
                                <td>{{$saque->userLoja->name}}</td>
                                <td>{{$saque->parceira->name}}</td>
                                <td>{{$saque->contrato->plano->name}}</td>
                                <td>{{$saque->contrato->plano->taxa}} %</td>
                                <td>R$ {{number_format(round($saque->valorSaque(), 2),2,',','.')}}</td>
                                <td>{{$saque->parceira->pix}} </td>
                                <td>{{$saque->dataLimite()}}</td>
                                <td>{{$saque->statusFormat()}}</td>
                                <td>
                                    @if($saque->status == 0)
                                        <input type="hidden" value="{{ $saque->parceira->pix }}" id="campo-{{ $saque->id }}" readonly>

{{--                                        <button class="btn-copiar" data-index="{{ $saque->id }}">Copiar</button>--}}
                                        <a class="btn btn-primary" href="{{ url('admin/saque/' . $saque->id . '/baixa') }}">Dar Baixa</a>


                                    @endif
                                </td>
                            </tr>

                        @empty
                        @endforelse


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var botoesCopiar = document.querySelectorAll('.btn-copiar');

            botoesCopiar.forEach(function (botao) {
                botao.addEventListener('click', function () {
                    var index = this.getAttribute('data-index');
                    var campo = document.getElementById('campo-' + index);

                    copiarTexto(campo);
                });
            });

            function copiarTexto(elemento) {
                // Cria uma seleção
                var range = document.createRange();
                range.selectNode(elemento);

                // Seleciona o conteúdo do elemento
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);

                // Executa o comando de cópia
                try {
                    document.execCommand('copy');
                    alert('Texto copiado: ' + elemento.value);
                } catch (err) {
                    console.error('Erro ao copiar o texto: ', err);
                }

                // Limpa a seleção
                window.getSelection().removeAllRanges();
            }
        });
    </script>
@endsection
