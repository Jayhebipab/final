<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PiercingGallery;

class PiercingGalleryController extends Controller
{
    public function index()
    {
        // Get first record or create an empty one for display
        $gallery = PiercingGallery::first() ?? new PiercingGallery();
        return view('piercinggallery', compact('gallery'));
    }

    public function store(Request $request)
    {
        // Find or create record
        $gallery = PiercingGallery::first() ?? new PiercingGallery();

        // Update header fields
        $gallery->headertitle = $request->input('headertitle');
        $gallery->listheader = $request->input('listheader');

        // 🧩 Handle Piercing Images
        $existingPiercing = $gallery->piercingimages ?? [];
        if (is_string($existingPiercing)) {
            $existingPiercing = json_decode($existingPiercing, true) ?: [];
        }

        if ($request->hasFile('piercingimages')) {
            foreach ($request->file('piercingimages') as $file) {
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move(public_path('images/Piercings'), $filename);
                $existingPiercing[] = $filename;
            }
        }
        $gallery->piercingimages = json_encode($existingPiercing);

        // 💰 Handle Price List Images
        $existingPrice = $gallery->pricelistimages ?? [];
        if (is_string($existingPrice)) {
            $existingPrice = json_decode($existingPrice, true) ?: [];
        }

        if ($request->hasFile('pricelistimages')) {
            foreach ($request->file('pricelistimages') as $file) {
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move(public_path('images/pricelist'), $filename);
                $existingPrice[] = $filename;
            }
        }
        $gallery->pricelistimages = json_encode($existingPrice);

        // Save the record
        $gallery->save();

        return redirect()->back()->with('success', 'Piercing Gallery updated successfully!');
    }

    // Optional API for frontend
    public function showGallery()
    {
        $gallery = PiercingGallery::first();

        if (!$gallery) {
            return response()->json([
                'headertitle' => '',
                'listheader' => '',
                'piercingimages' => [],
                'pricelistimages' => []
            ]);
        }

        return response()->json([
            'headertitle' => $gallery->headertitle,
            'listheader' => $gallery->listheader,
            'piercingimages' => json_decode($gallery->piercingimages, true) ?? [],
            'pricelistimages' => json_decode($gallery->pricelistimages, true) ?? [],
        ]);
    }
}
