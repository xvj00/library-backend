<?php

namespace App\Http\Controllers\Librarian;

use App\Enums\ReservationsStatus;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BookingManagementController extends Controller
{
    public function index()
    {
        $reservation = Reservation::all();
        return response()->json(['reservations' => $reservation], 200);

    }
    public function confirm(Book $book)
    {
        $reservation =Reservation::where('book_id', $book->id)->where('status', ReservationsStatus::BOOKED)
            ->where('booking_date', '>=', Carbon::now())
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::CONFIRMED,'booking_date'=>null]);
        }

        return response()->json(['message' => 'Reservation confirmed successfully','book_status'=>$reservation->status]);
    }

    public function cancel(Book $book)
    {
        $reservation = Reservation::where('book_id', $book->id)
            ->where('status', ReservationsStatus::BOOKED)->orWhere('status', ReservationsStatus::CONFIRMED)
            ->where('booking_date', '>=', Carbon::now())
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::CANCELED, 'booking_date' => null]);

        }
        return response()->json(['message' => 'Reservation canceled successfully']);
    }
    public function given(Book $book)
    {
        $reservation = Reservation::where('book_id', $book->id)
            ->where('status', ReservationsStatus::CONFIRMED)
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::GIVEN, 'booking_date' => null]);

        }

        return response()->json(['message' => 'Reservation given successfully']);
    }

    public function returned(Book $book)
    {
        $reservation = Reservation::where('book_id', $book->id)
            ->where('status', ReservationsStatus::GIVEN)
            ->first();

        if ($reservation) {
            $reservation->update(['status' => ReservationsStatus::RETURNED, 'booking_date' => null]);

        }
        return response()->json(['message' => 'Reservation returned successfully']);

    }


}
