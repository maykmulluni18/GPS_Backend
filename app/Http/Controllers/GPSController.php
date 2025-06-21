<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordinate;
use Illuminate\Support\Facades\Log;

class GPSController extends Controller
{
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
        // Validar que los datos lleguen correctamente
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Registrar en el log de Laravel
        Log::info('GPS recibido:', [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'ip' => $request->ip(),
            'fecha' => now()->toDateTimeString()
        ]);

        return response()->json(['success' => true]);
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'lat' => 'required|numeric',
    //         'lng' => 'required|numeric',
    //     ]);

    //     $coordinate = Coordinate::create([
    //         'lat' => $request->lat,
    //         'lng' => $request->lng,
    //     ]);

    //     return response()->json(['message' => 'Coordenadas guardadas'], 200);
    // }
}
