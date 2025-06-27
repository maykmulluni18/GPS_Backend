<?php

namespace App\Http\Controllers;

use App\Models\ConsumoEstimado;
use Illuminate\Http\Request;
use App\Models\GpsUbicacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ConsumoEstimadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function calcularConsumoDesdeUltimaRecarga($busId)
    {
        try {
            $ultimaRecarga = DB::table('recarga_combustibles')
                ->where('bus_id', $busId)
                ->orderByDesc('fecha_recarga')
                ->first();

            if (!$ultimaRecarga) {
                return null; // No hay recarga registrada
            }

            $totalLitros = DB::table('consumo_estimados')
                ->where('bus_id', $busId)
                ->where('fecha', '>=', $ultimaRecarga->fecha_recarga)
                ->sum('litros_consumidos');

            $capacidad = $ultimaRecarga->litros_cargados;

            $porcentajeConsumido = $capacidad > 0 ? ($totalLitros / $capacidad) * 100 : 0;
            return response()->json([
                'litros_consumidos' => round($totalLitros, 2),
                'porcentaje_consumido' => round($porcentajeConsumido, 2),
                'litros_restantes' => max(0, round($capacidad - $totalLitros, 2)),
            ], 201);
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsumoEstimado $consumoEstimado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConsumoEstimado $consumoEstimado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsumoEstimado $consumoEstimado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsumoEstimado $consumoEstimado)
    {
        //
    }
}
