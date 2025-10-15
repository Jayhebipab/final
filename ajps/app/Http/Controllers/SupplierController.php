<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;

class SupplierController extends Controller
{
public function index(Request $request)
{
    $query = \App\Models\Suppliers::query();

    if ($request->filled('search')) {
        $query->where('contact', 'LIKE', '%' . $request->search . '%');
    }

    $suppliers = $query->orderBy('id', 'desc')->get();

    return view('partials.maintenance.suppliers', compact('suppliers'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'address'      => 'required|string|max:255',
            'contact'      => 'required|string|max:20',
        ]);

        Suppliers::create($request->only(['name','company_name','address','contact']));

        return redirect()->back()->with('success', 'Supplier added successfully!');
    }

    public function update(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'address'      => 'required|string|max:255',
            'contact'      => 'required|string|max:20',
        ]);

        $supplier->update($request->only(['name','company_name','address','contact']));

        return redirect()->back()->with('success', 'Supplier updated successfully!');
    }

    public function destroy($id)
    {
        $supplier = Suppliers::findOrFail($id);
        $supplier->delete();

        return redirect()->back()->with('success', 'Supplier deleted successfully!');
    }
}
