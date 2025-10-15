<?php

namespace App\Http\Controllers;

use App\Models\DeliveryReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * 📋 Display Inventory Page
     */
public function index(Request $request)
{
    $inventories = DB::table('inventories')->get();

    if ($request->ajax() || $request->expectsJson()) {
        $formatted = $inventories->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->product_name,
                'description' => $item->description ?? 'No description available.',
                'price' => $item->selling_price,
                'quantity' => $item->quantity,
                'image' => $item->photo
                    ? asset($item->photo)
                    : asset('images/about/shopitem/default.png'),
            ];
        });

        return response()->json($formatted);
    }

    // kung hindi AJAX, return sa view ng inventory
    $suppliers = DB::table('suppliers')->get();
    return view('inventory', compact('suppliers', 'inventories'));
}


    /**
     * 🔍 AJAX endpoint para kunin product details by ID
     */
    public function getProductById($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    /**
     * 💾 Store data to both delivery_reports and inventories
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'     => 'required|string|max:100',
            'product_name'   => 'required|string|max:255',
            'category'       => 'required|string|max:255',
            'quantity'       => 'required|integer|min:1',
            'cost_price'     => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'company_name'   => 'required|integer', // supplier_id
            'date_delivered' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // 🔹 Get supplier company name using supplier_id
            $supplierName = DB::table('suppliers')
                ->where('id', $request->company_name)
                ->value('company_name');

            if (!$supplierName) {
                throw new \Exception('Invalid supplier ID.');
            }

            // 🔹 1️⃣ Insert into delivery_reports
            DeliveryReport::create([
                'company_name' => $supplierName,
                'item_name'    => $request->product_name,
                'quantity'     => $request->quantity,
                'cost_price'   => $request->cost_price,
                'date_receive' => $request->date_delivered,
            ]);

            // 🔹 2️⃣ Insert or update in inventories
            $existing = DB::table('inventories')
                ->where('id', $request->product_id)
                ->first();

            if ($existing) {
                // Update quantity kung existing na
                DB::table('inventories')
                    ->where('id', $request->product_id)
                    ->update([
                        'quantity'      => $existing->quantity + $request->quantity,
                        'cost_price'    => $request->cost_price,
                        'selling_price' => $request->selling_price,
                        'updated_at'    => now(),
                    ]);
            } else {
                // Otherwise, create new inventory record
                DB::table('inventories')->insert([
                    'id'            => $request->product_id,
                    'product_name'  => $request->product_name,
                    'category'      => $request->category,
                    'quantity'      => $request->quantity,
                    'cost_price'    => $request->cost_price,
                    'selling_price' => $request->selling_price,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }

            DB::commit();

            return back()->with('success', '✅ Delivery report and inventory saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', '❌ Error: ' . $e->getMessage());
        }
    }



public function updatePhoto(Request $request)
{
    $request->validate([
        'id'            => 'required|integer|exists:inventories,id',
        'title'         => 'required|string|max:255',
        'description'   => 'nullable|string',
        'selling_price' => 'required|numeric|min:0',
        'quantity'      => 'required|integer|min:0',
        'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $inventory = DB::table('inventories')->where('id', $request->id)->first();

    if (!$inventory) {
        return back()->with('error', 'Product not found.');
    }

    $photoPath = $inventory->photo; // keep existing path

    // ✅ Handle new photo upload
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('images/about/shopitem');

        // Gumawa ng folder kung wala pa
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Move file to public/images/about/shopitem
        $file->move($destinationPath, $fileName);

        // Save path relative to public
        $photoPath = '/images/about/shopitem/' . $fileName;
    }

    // ✅ Update record
    DB::table('inventories')
        ->where('id', $request->id)
        ->update([
            'product_name'  => $request->title,
            'description'   => $request->description,
            'selling_price' => $request->selling_price,
            'quantity'      => $request->quantity,
            'photo'         => $photoPath,
            'updated_at'    => now(),
        ]);

    return back()->with('success', '✅ Product updated successfully!');
}
public function getInventories()
{
    $inventories = \DB::table('inventories')->select(
        'id',
        'product_name as title',
        'description',
        'selling_price as price',
        'photo as image'
    )->get();

    return response()->json($inventories);
}
}