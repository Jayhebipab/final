<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PiercingGallery;

class PiercingGalleryController extends Controller
{
    public function index()
    {
        $gallery = PiercingGallery::first();
        return view('partials.piercingsgallery', compact('gallery'));
    }

    public function store(Request $request)
    {
        $gallery = PiercingGallery::first() ?? new PiercingGallery();

        // Header Titles
        $gallery->headertitle = $request->input('headertitle');
        $gallery->listheader = $request->input('listheader');

        // === Handle Piercing Images ===
        $existingPiercing = $gallery->piercingimages ?? [];
        if (is_string($existingPiercing)) {
            $existingPiercing = json_decode($existingPiercing, true) ?: [];
        }

        if ($request->hasFile('piercingimages')) {
            foreach ($request->file('piercingimages') as $file) {
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                // ✅ Correct folder for piercings
                $file->move(public_path('images/Piercings'), $filename);
                $existingPiercing[] = $filename;
            }
        }

        $gallery->piercingimages = json_encode($existingPiercing);

        // === Handle Price List Images ===
        $existingPrice = $gallery->pricelistimages ?? [];
        if (is_string($existingPrice)) {
            $existingPrice = json_decode($existingPrice, true) ?: [];
        }

        if ($request->hasFile('pricelistimages')) {
            foreach ($request->file('pricelistimages') as $file) {
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                // ✅ FIXED: Correct path for price list images
                $file->move(public_path('images/listtattoo'), $filename);
                $existingPrice[] = $filename;
            }
        }

        $gallery->pricelistimages = json_encode($existingPrice);

        $gallery->save();

        return redirect()->back()->with('success', 'Piercing gallery updated successfully!');
    }

    public function showGallery()
    {
        $gallery = PiercingGallery::first();

        if (!$gallery) {
            return response()->json([
                'headertitle' => '',
                'listheader' => '',
                'piercingimages' => [],
                'pricelistimages' => [],
            ]);
        }

        return response()->json([
            'headertitle' => $gallery->headertitle,
            'listheader' => $gallery->listheader,
            'piercingimages' => is_array($gallery->piercingimages)
                ? $gallery->piercingimages
                : json_decode($gallery->piercingimages, true),
            'pricelistimages' => is_array($gallery->pricelistimages)
                ? $gallery->pricelistimages
                : json_decode($gallery->pricelistimages, true),
        ]);
    }
}
