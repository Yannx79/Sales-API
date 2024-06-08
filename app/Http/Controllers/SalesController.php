<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::active()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $sales;
        $data = [
            'sales' => $sales,
            'status' => 200,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesRequest $request)
    {
        $sales = Sales::create($request->all());
        if (!$sales) {
            $data = [
                'message' => 'Sales not found!',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }
        $data = [
            'sales' => $sales,
            'status' => 201,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sale)
    {
        $sale = Sales::find($sale->id);
        if (!$sale) {
            $data = [
                'message' => 'Sales not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'sales' => $sale,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesRequest $request, Sales $sale)
    {
        $sale = Sales::find($sale->id);
        if (!$sale) {
            $data = [
                'message' => 'Sales not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $sale->update($request->all());
        $data = [
            'sales' => $sale,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sale)
    {
        $sale = Sales::find($sale->id);
        if (!$sale) {
            $data = [
                'message' => 'Sales not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $sale->delete();
        return response()->json(null, 204);
    }
}
