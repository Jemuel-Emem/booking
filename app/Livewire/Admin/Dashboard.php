<?php

namespace App\Livewire\Admin;
use App\Models\ReservationList;
use App\Models\CancelledList;
use App\Models\Reservation;
use Livewire\Component;

class Dashboard extends Component
{

    public function render()
    {
        $totalcancelledList = CancelledList::count();
        $totalbookingList = Reservation::count();
        $totalReservationList = ReservationList::count();
        return view('livewire.admin.dashboard', [
            'totalReservationList' => $totalReservationList,
            'totalcancelledList' => $totalcancelledList,
            'totalbookingList' => $totalbookingList,

        ]);
    }
}
