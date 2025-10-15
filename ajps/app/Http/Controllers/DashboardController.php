<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Products;
use App\Models\Artist;
use App\Models\Inventory;
use App\Models\DeliveryReport;
use App\Models\Suppliers;
use App\Models\TattooGallery;
use App\Models\Equipment; // ✅ idagdag mo ito
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the Super Admin confirmation form (before accessing Users page).
     */
    public function usersAuthForm()
    {
        return view('auth.superadmin-confirm');
    }

    public function checkUsersAuth(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user->password === $request->password) {
            session(['superadmin_verified' => true]);

            return redirect()->route('dashboard', ['page' => 'users'])
                             ->with('success', 'Super Admin access confirmed.');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function index(Request $request)
    {
        // Require login
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        $page = $request->get('page', 'dashboard');

        $data = [
            'name'         => session('user_name'),
            'page'         => $page,
            'reservations' => collect(),
            'bookings'     => collect(),
            'users'        => collect(),
            'products'     => collect(),
            'equipment'    => collect(), // ✅ para hindi undefined kahit default
        ];

        // Reservations page
        if ($page === 'reservation') {
            $data['reservations'] = Reservation::all();
        }

         if ($page === 'inventory') {
            $data['inventory'] = inventory::all();
             $data['suppliers'] = Suppliers::all();
        }

        // Booking requests page
        if ($page === 'booking') {
            $data['bookings'] = DB::table('bookings')
                                  ->where('status', 'Pending')
                                  ->get();
        }

        // Users page (only if verified superadmin)
        if ($page === 'users') {
            if (!session('superadmin_verified')) {
                return redirect()->route('superadmin.auth.form')
                                 ->with('error', 'Please confirm Super Admin access.');
            }
            $data['users'] = User::all();
        }

        // Products page
        if ($page === 'products') {
            $data['products'] = Products::all();
        }

        // ✅ Equipment page
        if ($page === 'equipment') {
            $data['equipment'] = Equipment::all();
        }

if ($page === 'tattoogallery') {
    $data['galleries'] = TattooGallery::all();
}

if ($page === 'delreports') {
    $data['deliveries'] = DeliveryReport::all();
}
        if ($page === 'inventory') {
    $data['inventories'] = Inventory::all();
}

        if ($page === 'suppliers') {
            $data['suppliers'] = Suppliers::all();
        }

        if ($page === 'artist') {
            $data['artists'] = Artist::all();
        }

        return view('dashboard', $data);
    }
}
