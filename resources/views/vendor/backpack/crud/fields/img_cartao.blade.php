<div class="form-group">
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    {{-- Input para fazer o upload das imagens --}}
    <input
        type="file"
        name="{{ $field['name'] }}[]"
        multiple
        data-init-function="bpFieldInitImgCartao"
        @include('crud::fields.inc.attributes')>

    {{-- Campos para exibir as imagens carregadas, se houverem --}}
    @if (isset($field['value']) && is_array($field['value']))
        <div class="uploaded-images">
            @foreach ($field['value'] as $imagePath)
                <img src="{{ asset('storage/' . $imagePath) }}" alt="Imagem" class="img-thumbnail">
            @endforeach
        </div>
    @endif

    {{-- Dica --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
