<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homepage()
    {
        $variavel = "Homepage do sistema de planejamento e manejo de hortaliças";
        return view('welcome', [
          'title' => $variavel
        ]);
    }

    public function cadastrar()
    {
        echo "Tela de Cadastro";
    }

    /**
    *Metodo dos Usuarios Login View
    *============================================
    */
    public function fazerlogin()
    {
        return view('user.login');

    }

}
