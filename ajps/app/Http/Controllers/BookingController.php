<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // 📌 Pending Booking Requests
    public function index()
    {
        $bookings = DB::table('bookings')
            ->where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('partials.booking-requests', ['bookings' => $bookings]);
    }

    // 📌 List of Reservations (Approved/Finished/Cancelled)
    public function reservations()
    {
        $reservations = DB::table('reservations')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('partials.reservations', ['reservations' => $reservations]);
    }

    // 📌 Store New Booking
    public function store(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'email'           => 'required|email',
            'phone'           => 'required|string|max:20',
            'service'         => 'required|string|max:150',
            'preferred_date'  => 'required|date',
            'preferred_time'  => 'required',
            'instruction'     => 'nullable|string',
        ]);

        DB::table('bookings')->insert([
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'service'        => $request->service,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'instruction'    => $request->instruction,
            'status'         => 'Approved',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('dashboard', ['page' => 'booking'])
            ->with('success', 'New booking request created successfully!');
    }
    
    // 📌 Approve Booking → Update status only
    public function approve($id)
    {
        $booking = DB::table('bookings')->where('id', $id)->first();
    
        if ($booking) {
            DB::table('bookings')->where('id', $id)->update([
                'status' => 'Approved',
                'updated_at' => now(),
            ]);

            return redirect()->route('dashboard', ['page' => 'booking'])
                ->with('success', 'Booking has been approved!');
        }
    
        return redirect()->back()->with('error', 'Booking not found.');
    }

    // 📌 Cancel Booking
    public function cancel($id)
    {
        $booking = DB::table('bookings')->where('id', $id)->first();

        if ($booking) {
            DB::table('bookings')->where('id', $id)->update([
                'status' => 'Cancelled',
                'updated_at' => now(),
            ]);

            return redirect()->route('dashboard', ['page' => 'booking'])
                ->with('success', 'Booking has been cancelled.');
        }

        return redirect()->back()->with('error', 'Booking not found.');
    }

    // 📌 Finish Reservation
    public function finishReservation($id)
    {
        $reservation = DB::table('reservations')->where('id', $id)->first();

        if ($reservation) {
            DB::table('reservations')->where('id', $id)->update([
                'status' => 'Finished',
                'updated_at' => now(),
            ]);

            return redirect()->route('dashboard', ['page' => 'reservations'])
                ->with('success', 'Reservation has been marked as finished.');
        }

        return redirect()->back()->with('error', 'Reservation not found.');
    }

    // 📌 Cancel Reservation
    public function cancelReservation($id)
    {
        $reservation = DB::table('reservations')->where('id', $id)->first();

        if ($reservation) {
            DB::table('reservations')->where('id', $id)->update([
                'status' => 'Cancelled',
                'updated_at' => now(),
            ]);

            return redirect()->route('dashboard', ['page' => 'reservations'])
                ->with('success', 'Reservation has been cancelled.');
        }

        return redirect()->back()->with('error', 'Reservation not found.');
    }
}
