<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::active()
            ->orderBy('district', 'asc')
            ->orderBy('description', 'asc')
            ->paginate(10);
        return $stores;
        $data = [
            'stores' => $stores,
            'status' => 200,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $store = Store::create($request->all());
        if (!$store) {
            $data = [
                'message' => 'Store not found!',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }
        $data = [
            'store' => $store,
            'status' => 201,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $store = Store::find($store->id);
        if (!$store) {
            $data = [
                'message' => 'Store not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'store' => $store,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $store = Store::find($store->id);
        if (!$store) {
            $data = [
                'message' => 'Store not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $store->update($request->all());
        $data = [
            'store' => $store,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store = Store::find($store->id);
        if (!$store) {
            $data = [
                'message' => 'Store not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $store->delete();
        return response()->json(null, 204);
    }
}
