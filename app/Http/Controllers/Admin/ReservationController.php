<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Notifications\ReservationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(){
        $pending_reservations = Reservation::where('status', 'pending')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 1 ELSE 2 END, created_at DESC")
            ->get();

        $pending_selesai = Reservation::where('status', 'confirmed')->latest()->get();

        $admin = Auth::user();

        $reservation = Reservation::get();
        foreach ($reservation as $item) {
            $notif = $admin->notifications()->where('data->id',$item->id)->first();
            if(!$notif){
                $save = new ReservationNotification($item);
                $admin->notify($save);
            }
        }

        return view('admin.peddingreservation', compact('pending_reservations', 'pending_selesai', 'admin'));
    }

    public function detail($id){
        $pedding = Reservation::findOrFail($id);
// $peding_orders = Order::where('status', 'pending')->latest()->get();
return view('admin.peddingreservationdetail', compact('pedding'));

    }
    public function reservationadmin($id){
        $pedding = Reservation::findOrFail($id);

return view('admin.peddingreservationdetail', compact('pedding'));

    }
    public function approveReservation($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->status = 'confirmed';
    $reservation->save();

    // Redirect ke halaman yang tepat atau tampilkan pesan sukses
    return redirect()->back()->with('success', 'Reservasi has been approved.');
}
    public function rejectReservation($id)
    {
        $reservation = Reservation::findOrFail($id);



        // Hapus pesanan
        $reservation->delete();

        // Redirect ke halaman yang tepat atau tampilkan pesan sukses
        return redirect()->route('pendingreservation')->with('confirmed', 'Reservasi has been rejected.');
    }
    public function cancelReservation($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->status = 'pending';
    $reservation->save();

    // Redirect ke halaman yang tepat atau tampilkan pesan sukses
    return redirect()->back()->with('confirmed', 'Reservasi has been cancel.');
}
}