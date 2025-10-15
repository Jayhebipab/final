<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TattooGallery;

class TattooGalleryController extends Controller
{
    public function index()
    {
        $galleries = TattooGallery::all();
        return view('tattoogallery.add', compact('galleries'));
    }

    public function store(Request $request)
    {
        // Get first record or create new
        $gallery = TattooGallery::first() ?? new TattooGallery();

        // Update titles
        $gallery->headertitle = $request->input('title_header');
        $gallery->listheader = $request->input('pricelist_header');

        // === HANDLE TATTOO IMAGES ===
        $existingTattoo = $gallery->tattooimages ?? [];
        if (is_string($existingTattoo)) {
            $existingTattoo = json_decode($existingTattoo, true) ?: [];
        }

        if ($request->hasFile('tattoo_images')) {
            foreach ($request->file('tattoo_images') as $file) {
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move(public_path('images/Tattoo'), $filename);
                $existingTattoo[] = $filename;
            }
        }

        // ✅ Encode before saving
        $gallery->tattooimages = json_encode($existingTattoo);

        // === HANDLE PRICE LIST IMAGES ===
        $existingPrice = $gallery->pricelistimages ?? [];
        if (is_string($existingPrice)) {
            $existingPrice = json_decode($existingPrice, true) ?: [];
        }

        if ($request->hasFile('price_images')) {
            foreach ($request->file('price_images') as $file) {
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move(public_path('images/pricelist'), $filename);
                $existingPrice[] = $filename;
            }
        }

        // ✅ Encode before saving
        $gallery->pricelistimages = json_encode($existingPrice);

        $gallery->save();

        return redirect()->back()->with('success', 'Gallery updated successfully!');
    }

    // ✅ ADD THIS FOR YOUR VUE FRONTEND
    public function showGallery()
    {
        $gallery = TattooGallery::first();

        if (!$gallery) {
            return response()->json([
                'headertitle' => '',
                'listheader' => '',
                'tattooimages' => [],
                'pricelistimages' => []
            ]);
        }

        return response()->json([
            'headertitle' => $gallery->headertitle,
            'listheader' => $gallery->listheader,
            'tattooimages' => is_array($gallery->tattooimages)
                ? $gallery->tattooimages
                : json_decode($gallery->tattooimages, true),
            'pricelistimages' => is_array($gallery->pricelistimages)
                ? $gallery->pricelistimages
                : json_decode($gallery->pricelistimages, true),
        ]);
    }
}
