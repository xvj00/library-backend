<?php

namespace App\Http\Controllers;

use App\Enums\ReservationsStatus;
use App\Models\Book;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $reservation = Reservation::where('book_id', $request->book_id)
            ->where('status', ReservationsStatus::BOOKED)
            ->orWhere('status', ReservationsStatus::CONFIRMED)
            ->orWhere('status', ReservationsStatus::GIVEN)
            ->where('booking_date', '>=', Carbon::now())
            ->exists();

        if ($reservation) {
            return response()->json(['message' => 'Book is already reserved'], 409);
        }
        else{
            Reservation::create([
                'user_id'=>auth()->id(),
                'book_id'=>$request->book_id,
                'status'=>ReservationsStatus::BOOKED,
                'booking_date'=>Carbon::now()->addDays(14)
            ]);
            return response()->json(['message' => 'Reservation created successfully', 'book_id'=>$request->book_id]);
        }

    }
    public function cancel(Book $book)
    {
        $reservation = Reservation::where('book_id', $book->id)
            ->where('status', ReservationsStatus::BOOKED)
            ->where('booking_date', '>=', Carbon::now())
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::CANCELED, 'booking_date' => null]);

        }

        return response()->json(['message' => 'Reservation canceled successfully']);
    }

    public function UserReservations()
    {
        $reservation = Reservation::where('user_id', auth()->id())->get();
        return response()->json(['your reservations' => $reservation], 200);
    }
}
