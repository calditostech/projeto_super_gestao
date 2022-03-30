<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedores.index');
    }

    public function listar() {
        return view('app.fornecedores.listar');
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
        return view('app.fornecedores.adicionar', ['msg' => $msg]);
    }
}
