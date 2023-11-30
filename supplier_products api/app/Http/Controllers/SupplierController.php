<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;
use Illuminate\Validation\ValidationException;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return response()->json($suppliers);
    }

    public function store(SupplierRequest $request)
    {
        try {
            $request->validate([
                'mobile_numbers' => 'unique:suppliers,mobile_numbers',
            ], [
                'mobile_numbers.unique' => 'The mobile number has already been taken.',
            ]);

            $supplier = Supplier::create($request->validated());
    
            return response()->json($supplier, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }


    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    public function update(SupplierRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->validated());

        return response()->json($supplier);
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
    
        $results = Supplier::where('name', 'like', "%$query%")
            ->orWhere('mobile_numbers', 'like', "%$query%")
            ->paginate(10);
    
        return response()->json($results);
    }

}
