<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home() {
        $links = [
            'http://platzi.com/laravel' => 'Curso de laravel',
            'http://laravel.com' => 'Pagina de laravel'
        ];
    
        return view('welcome', [
            'teacher' => 'Guido Contreras Woda',
            'links' => $links
        ]);
    }

    public function about() {
        return view('about');
    }
}
