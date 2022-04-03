@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')

    <div class="conteudo-pagina">

         <div class="titulo-pagina-2">
             <p>Produto - Editar</p>
         </div>

         <div class="menu">
             <ul>
                 <li><a href="">Voltar</a></li>
                 <li><a href="">Consulta</a></li>
             </ul>
         </div>

         <div class="informacao-pagina">
             {{ $msg ?? ''}}
              <div style="width: 30%; margin-left: auto; margin-right: auto;">
                  <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}">
                      @csrf
                      @method('PUT')
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
                      <button type="submit" class="borda-preta">Editar</button>
                  </form>
               </div>
         </div>

    </div>

@endsection
