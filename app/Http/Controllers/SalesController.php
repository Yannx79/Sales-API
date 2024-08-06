<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function bestSellingCategory()
    {
        return 'best';
    }

    public function storeMoreSales()
    {
        $data = Sales::select('store_id')->groupBy('store_id')->get();
        return "";
    }

    public function salesYear(Request $request)
    {
        $totalSalesAmount = Sales::whereHas('time', function (Builder $query) use ($request) {
            $query->salesYear($request->year);
        })->sum('sales_amount');
        $sales = Sales::whereHas('time', function (Builder $query) use ($request) {
            $query->salesYear($request->year.'-01-01');
        })->get()
        ->transform(function ($sale) {
            return [
                'id' => $sale->id,
                'items_sold' => $sale->items_sold,
                'sales_amount' => $sale->sales_amount,
                'district_store' => $sale->store->district,
                'date_time' => $sale->time->date,
                'product' => $sale->product,
            ];
        });
        $data = [
            'total_sales_amount' => ($sales->count() != 0) ? $totalSalesAmount : 'Not sales int this year',
            'sales_year' => ($sales->count() != 0) ? $sales : 'Not sales int this year',
            'status' => ($sales->count() != 0) ? 200 : 404,
        ];
        return response()->json($data, (!$sales->count()) ? 200 : 404);
    }

    public function salesMonthYear(Request $request)
    {
        $totalSalesAmount = Sales::whereHas('time', function (Builder $query) use ($request) {
            $query->salesMonthYear($request->year.'-'.$request->month.'-01');
        })->sum('sales_amount');
        $sales = Sales::whereHas('time', function (Builder $query) use ($request) {
            $query->salesMonthYear($request->year.'-'.$request->month.'-01');
        })->get()
        ->transform(function ($sale) {
            return [
                'id' => $sale->id,
                'items_sold' => $sale->items_sold,
                'sales_amount' => $sale->sales_amount,
                'district_store' => $sale->store->district,
                'date_time' => $sale->time->date,
                'product' => $sale->product,
            ];
        });
        $data = [
            'total_sales_amount' => ($sales->count() != 0) ? $totalSalesAmount : 'Not sales int this year',
            'sales_year' => ($sales->count() != 0) ? $sales : 'Not sales int this year',
            'status' => ($sales->count() != 0) ? 200 : 404,
        ];
        return response()->json($data, (!$sales->count()) ? 200 : 404);
    }

    public function lastMonth()
    {
        $sales = Sales::whereHas('time', function (Builder $query) {
            $query->lastMonth();
        })
            ->get()
            ->transform(function ($sale) {
                return [
                    'id' => $sale->id,
                    'items_sold' => $sale->items_sold,
                    'sales_amount' => $sale->sales_amount,
                    'state' => $sale->state,
                    'store' => $sale->store,
                    'time' => $sale->time,
                    'product' => $sale->product,
                ];
            });
        if (!$sales) {
            $data = [
                'sales' => 'Not sales int this month',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }
        $data = [
            'sales' => $sales,
            'status' => 200,
        ];
        return response()->json($data,);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::orderBy('created_at', 'desc')
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
