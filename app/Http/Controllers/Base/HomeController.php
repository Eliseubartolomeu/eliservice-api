<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Método para visualizar a página inicial da parte web do sistema
     */
    public function index()
    {
        return view('welcome');
    }
}
