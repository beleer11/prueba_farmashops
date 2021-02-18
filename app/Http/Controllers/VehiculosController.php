<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\Vehiculo;
use Exception;

class VehiculosController extends Controller
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
        //Variables globales
        $datosAsesor = [];
        $datosFinales = [];

        //Consulta los vehiculos activos
        $vehiculos = Vehiculo::where('activo', 1)->get();
        
        //Consulto los datos de los asesores
        foreach ($vehiculos as $v) {
            $asesor = $this->consumirApiPublica($v['asesor_id']);
            array_push($datosAsesor, $asesor);
        }

        //Crea un array final para unir los datos del vehiculo con los del asesor
        foreach ($vehiculos as $key => $v) {
            $datoTemporal = [
                'id'                => $v['id'],
                'marca'             => $v['marca'],
                'descripcion'       => $v['descripcion'],
                'modelo'            => $v['modelo'],
                'color'             => $v['color'],
                'activo'            => ($v['activo'] == 1) ? "Activo" : "Inactivo",
                'asesor_id'        => $datosAsesor[$key]->id,
                'nombre_asesor'    => $datosAsesor[$key]->first_name . ' '. $datosAsesor[$key]->last_name,
                'foto'              => $datosAsesor[$key]->avatar

            ];

            array_push($datosFinales, $datoTemporal);
        }

        return view('vehiculos.index', ['datos' => $datosFinales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        //Funcion para traer los datos de todos los asesores
        $datos = $this->consumirApiPublica();

        return view('vehiculos.create', ['select' => $datos]);
    }

    /**
     * Funcion para guardar vehiculo
     * @param request
     * @return message
     */
    public function postGuardarVehiculo(Request $request){
        try {
            DB::beginTransaction();

                $vehiculo = new Vehiculo;

                $vehiculo->descripcion  = $request->descripcion;
                $vehiculo->marca        = $request->marca;
                $vehiculo->modelo       = $request->modelo;
                $vehiculo->color        = $request->color;
                $vehiculo->activo       = 1;
                $vehiculo->asesor_id   = $request->asesor;

                $vehiculo->save();

            DB::commit();

            return redirect('vehiculos')->with('mensaje', 'Vehiculo vendido con exito');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            DB::rollBack();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $datos['datos']  = Vehiculo::findOrFail($id)->first();
        $datos['select'] = $this->consumirApiPublica();
        
        return view('vehiculos.edit', $datos);
    }

    
    /**
     * Funcion para actualizar el vehiculo
     *
     * @param  Request , $id
     * @return Response
     */
    public function postActualizarVehiculo(Request $request, $id)
    {
        try {
            DB::beginTransaction();
                $vehiculo = Vehiculo::find($id);

                $vehiculo->descripcion  = $request->descripcion;
                $vehiculo->marca        = $request->marca;
                $vehiculo->modelo       = $request->modelo;
                $vehiculo->color        = $request->color;
                $vehiculo->activo       = 1;
                $vehiculo->asesor_id   = $request->asesor;

                $vehiculo->update();

            DB::commit();

            return redirect('vehiculos')->with('mensaje', 'Venta editada con exito');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            DB::rollBack();
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function eliminarVehiculo($id)
    {
        Vehiculo::destroy($id);

        return redirect('vehiculos')->with('mensaje', 'Venta eliminada con exito');
    }

     /**
     * Funcion para consumir la api publica
     * @param $id
     * @return $datos
     */
    public function consumirApiPublica($id = null){
        //Utilizamos Guzzle para consumir una api publica
        $client = new \GuzzleHttp\Client();

        if(!is_null($id)){//Para consultar un asesor en especifico
            $id = intval($id);
            $asesor = json_decode($client->request('GET', "https://reqres.in/api/users/$id")->getBody()->getContents());
            return $asesor->data;
        }

        /** Consulta todos los asesores */
        $datos =  json_decode($client->request('GET', 'https://reqres.in/api/users?page=2')->getBody()->getContents());
        return $datos->data;
    }
}
