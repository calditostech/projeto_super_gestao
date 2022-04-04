
@if(isset($produto->id))
    <form method="post" action="{{ route('produto.update', ['produto' => $produto->id])}}">
        @csrf
        @method('PUT')
        @else
    <form method="post" action="{{ route('produto.store') }}">
    @csrf
    @endif
<input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
<input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" placeholder="Descricao" class="borda-preta">
    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
<input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" placeholder="Peso" class="borda-preta">
    {{ $errors->has('peso') ? $errors->first('peso') : '' }}
<select name="unidade_id">
        <option>-- Selecione a inidade de medida --</option>
            @foreach($unidades as $unidade)
        <option value=" {{ $unidade->id }} " {{ old('unidade_id') == $unidade->id ? 'selected' : ''}}>{{ $unidade->descricao}}</option>
            @endforeach
</select> 
<button type="submit" class="borda-preta">Cadastrar</button>
</form>