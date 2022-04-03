@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')

    <div class="conteudo-pagina">

         <div class="titulo-pagina-2">
             <p>Listagem de Produtos</p>
         </div>

         <div class="menu">
             <ul>
                 <li><a href="{{ route('produto.create') }}">Novo</a></li>
                 <li><a href="">Consulta</a></li>
             </ul>
         </div>

         <div class="informacao-pagina">
           <div style="width: 30%; margin-left: auto; margin-right: auto;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                       <th>Nome</th>
                       <th>Descrição</th>
                       <th>Peso</th>
                       <th>Unidade ID</th>
                    <tr>
                </thead>

                <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                           <td>{{ $produto->nome }}</td>
                           <td>{{ $produto->descricao }}</td>
                           <td>{{ $produto->peso }}</td>
                           <td>{{ $produto->unidade_id }}</td>
                           <td><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">Visualizar</a></td>
                           <td><a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">Editar</a></td>
                           <td>
                               <form id="form_{{$produto->id}}" method="post" action="{{ route('produto.destroy', ['produto' => $produto->id]) }}">
                                @method('DELETE')
                                @csrf
                               <a href="#" onclick="document.getElementById('form_{{$produto->id}}').submit()">Excluir</a>
                               </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

               {{ $produtos->appends($request)->links() }}
               <br>
               {{ $produtos->count() }} - Total de registros por página
               <br>
               {{ $produtos->total() }} - Total de registros da consulta
               <br>
               {{ $produtos->firstItem() }} - Numero do primeiro registro da pagina
               <br>
               {{ $produtos->lastItem() }} - Numero do ultimo registro da pagina
               </div>
         </div>

    </div>

@endsection
