<?php

namespace App\Http\Controllers;

use App\Models\GpsUbicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class GpsUbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Puedes guardar en la base de datos aquí también

        return response()->json([
            'status' => 'ok',
            'message' => 'hola desde Laravel.'
        ]);
    }
    public function store(Request $request)
    {
        try {
            // Validar que los datos requeridos estén presentes
            $validator = Validator::make($request->all(), [
                'placa' => 'required',
                'latitud' => 'required',
                'longitud' => 'required',
                'fecha' => 'nullable',
                'hora' => 'nullable',
                'velocidad_kmh' => 'nullable'
            ]);
            // Si falla la validación
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Errores de validación',
                    'errors' => $validator->errors()
                ], 422);
            }
            // Obtener bus por placa
            $idBus = DB::table('buses')->where('placa', $request->placa)->first();
            //dd($idBus->id);
            if (!$idBus) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bus no encontrado con la placa proporcionada.'
                ], 404);
            }
            // Generar valores predeterminados si no se envían
            $fecha = $request->fecha ?? now()->toDateString();
            $hora = $request->hora ?? now()->toTimeString();

            // Insertar en la base de datos usando Query Builder
            DB::table('gps_ubicacions')->insert([
                'id' => Str::uuid(),
                'bus_id' => $idBus->id,
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'velocidad_kmh' => $request->velocidad_kmh ?? null,
                'fecha' => $fecha,
                'hora' => $hora,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Registrar en log
            Log::info('GPS registrado', [
                'bus_id' => $idBus->id,
                'placa' => $request->placa,
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'velocidad_kmh' => $request->velocidad_kmh,
                'fecha' => $fecha,
                'hora' => $hora,
                'bus_id' => $request->bus_id,
                'ip' => $request->ip(),
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores, por ejemplo, registrar el error o retornar un mensaje
            return response()->json(['error' => 'Error al calcular el consumo: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GpsUbicacion $gpsUbicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GpsUbicacion $gpsUbicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GpsUbicacion $gpsUbicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GpsUbicacion $gpsUbicacion)
    {
        //
    }
}
