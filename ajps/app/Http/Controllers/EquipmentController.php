<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        // Kunin lahat ng equipments sa DB
        $equipments = Equipment::all();

        // I-pass papunta sa Blade
        return view('partials.maintenance.equipments', compact('equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'category'   => 'required|string|max:255',
            'cost_price' => 'required|numeric|min:0',
            'quantity'   => 'required|integer|min:0',
        ]);

        Equipment::create($request->all());

        return redirect()->back()->with('success', 'Equipment added successfully!');
    }

    public function update(Request $request, $id)
    {
        $equipment = Equipment::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'category'   => 'required|string|max:255',
            'cost_price' => 'required|numeric|min:0',
            'quantity'   => 'required|integer|min:0',
        ]);

        $equipment->update($request->all());

        return redirect()->back()->with('success', 'Equipment updated successfully!');
    }

    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();

        return redirect()->back()->with('success', 'Equipment deleted successfully!');
    }
}
