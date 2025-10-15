<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display all artists.
     */
    public function index()
    {
        $artists = Artist::all();
        return view('partials.artist', compact('artists'));
    }

    /**
     * Store (Insert) a new artist.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:artists,email',
        ]);

        Artist::create($request->only(['fullname', 'contact_number', 'email']));

        return redirect()->back()->with('success', '✅ Artist added successfully!');
    }

    /**
     * Show the form for editing the specified artist.
     */
    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        return view('partials.edit_artist', compact('artist'));
    }

    /**
     * Update artist details, including images (profile, cover, artworks).
     */
    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:artists,email,' . $artist->id,
            'description' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'artworks.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Update basic info
        $artist->fullname = $request->fullname;
        $artist->contact_number = $request->contact_number;
        $artist->email = $request->email;
        $artist->description = $request->description;

        // ✅ Upload Profile Photo
        if ($request->hasFile('profile_photo')) {
            $filename = time() . '_profile_' . preg_replace('/\s+/', '_', $request->file('profile_photo')->getClientOriginalName());
            $request->file('profile_photo')->move(public_path('images/artists/profile'), $filename);
            $artist->profile_photo = $filename;
        }

        // ✅ Upload Cover Photo
        if ($request->hasFile('cover_photo')) {
            $filename = time() . '_cover_' . preg_replace('/\s+/', '_', $request->file('cover_photo')->getClientOriginalName());
            $request->file('cover_photo')->move(public_path('images/artists/cover'), $filename);
            $artist->cover_photo = $filename;
        }

        // ✅ Upload Multiple Artworks (stored as JSON)
        $existingArtworks = $artist->artworks ?? [];
        if ($request->hasFile('artworks')) {
            foreach ($request->file('artworks') as $file) {
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move(public_path('images/artists/artworks'), $filename);
                $existingArtworks[] = $filename;
            }
            $artist->artworks = $existingArtworks;
        }

        $artist->save();

        return redirect()->back()->with('success', '✅ Artist updated successfully!');
    }

    /**
     * Delete an artist.
     */
    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);

        // Optional: delete uploaded files
        if ($artist->profile_photo && file_exists(public_path('images/artists/profile/' . $artist->profile_photo))) {
            unlink(public_path('images/artists/profile/' . $artist->profile_photo));
        }
        if ($artist->cover_photo && file_exists(public_path('images/artists/cover/' . $artist->cover_photo))) {
            unlink(public_path('images/artists/cover/' . $artist->cover_photo));
        }
        if (!empty($artist->artworks)) {
            foreach ($artist->artworks as $art) {
                $path = public_path('images/artists/artworks/' . $art);
                if (file_exists($path)) unlink($path);
            }
        }

        $artist->delete();

        return redirect()->back()->with('success', '🗑️ Artist deleted successfully!');
    }

    /**
     * Fetch artist artworks as JSON (for frontend JS).
     */
 public function getArtistWithArtworks($id)
{
    $artist = Artist::find($id);

    if (!$artist) {
        return response()->json(['error' => 'Artist not found'], 404);
    }

    // Decode artworks kung naka-JSON sa DB
    $artworks = $artist->artworks ? json_decode($artist->artworks, true) : [];

    return response()->json([
        'fullname' => $artist->fullname,
        'description' => $artist->description,
        'profile_photo' => $artist->profile_photo ? asset('storage/' . $artist->profile_photo) : null,
        'cover_photo' => $artist->cover_photo ? asset('storage/' . $artist->cover_photo) : null,
        'artworks' => collect($artworks)->map(fn($a) => asset('storage/' . $a)),
    ]);
}



}
