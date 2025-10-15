<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Get deliveries (with optional search)
        $deliveries = Delivery::when($search, function ($query, $search) {
            $query->where('company_name', 'like', "%{$search}%");
        })->get();

        // ✅ Make sure the view path is correct
        return view('partials.reports.delreports', compact('deliveries'));
    }
}
