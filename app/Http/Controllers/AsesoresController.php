<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsesoresController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        /** Consulta todos los asesores */
        $datos =  json_decode($client->request('GET', 'https://reqres.in/api/users?page=2')->getBody()->getContents());
        return view('asesores.index', ['datos' => $datos->data]);
    }
    
}
