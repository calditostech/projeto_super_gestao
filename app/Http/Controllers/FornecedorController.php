<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedores.index');
    }

    public function listar(Request $request) {
        
        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->paginate(2);

        
        return view('app.fornecedores.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request) {

        $msg = '';
        
        if($request->input('_token') != '') {
             //cadastro
             $regras = [
                 'nome' => 'required|min:3|max:40',
                 'site' => 'required',
                 'uf' => 'required|min:2|max:2',
                 'email' => 'email',
             ];

             $feedback = [
                 'required' => 'O campo :attribute deve ser preenchido',
                 'nomemin' => 'O campo nome deve ter no minimo 3 caracteres',
                 'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
                 'uf.min' => 'O campo uf deve ter no minimo 2 caracteres',
                 'uf.max' => 'O campo uf dve ter no maximo 2 caracteres',
                 'email.email' => 'O campo e-mail deve ser preenchido corretamente'
             ];

             $request->validate($regras, $feedback);

             $fornecedor = new Fornecedor();
             $fornecedor->create($request->all());

             $msg = 'Cadastro realizado com sucesso !';
        }
        //edição
        if($request->input('_token') != '' && $request->input('id') != '') {
           $fornecedor = Fornecedor::find($request->input('id'));
           $update = $fornecedor->update($request->all());

           if($update) {
               $msg = 'Atualização realizada com sucesso';
           } else {
               $msg = 'Atualização não realizada';
           }

           return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedores.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = ''){
          $fornecedor = Fornecedor::find($id);

          return view('app.fornecedores.adicionar', ['fornecedor'=> $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id, $msg = ''){
        $fornecedor = Fornecedor::find($id)->delete();

        return redirect()->route('app.fornecedor', ['fornecedor'=> $fornecedor, 'msg' => $msg]);

        $msg = 'Registro excluido com sucesso';
    }
}
