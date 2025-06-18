<?php

namespace App\Enums;
enum ReservationsStatus: string
{
    const CONFIRMED = 'confirmed';
    const BOOKED = 'booked';
    const CANCELED = 'canceled';
    const GIVEN = 'given';
    const RETURNED = 'returned';
}


?>
