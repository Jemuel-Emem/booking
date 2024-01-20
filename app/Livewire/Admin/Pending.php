<?php

namespace App\Livewire\Admin;


use App\Models\Reservation as reservation;
use App\Models\ReservationList as reservationlist;
use App\Models\CancelledList as cancelledlist;
use Livewire\Component;
use Livewire\WithPagination;
class Pending extends Component
{
    use  WithPagination;

    public $search;
    public function render()
    {
        $search = '%' . $this->search . '%';

    return view('livewire.admin.pending', [
        'reserv' => Reservation::where('reservationid', 'like', $search)->paginate(10),
    ]);

    }
    public function asss()
    {

        $this->resetPage();


    }
    public function confirm($Id){
        $reservation = Reservation::find($Id);

        if ($reservation) {

            reservationlist::create([
                'reservationid' => $reservation->reservationid,
                'fullname' => $reservation->fullname,
                'location' => $reservation->location,
                'number' => $reservation->number,
                'cottagenumber' => $reservation->cottagenumber,
                'paymenttype' => $reservation->paymenttype,
                'children' => $reservation->children,
                'adults' => $reservation->adults,
                'checkin' => $reservation->checkin,
                'checkout' => $reservation->checkout,
                'totalbill' => $reservation->totalbill,
                'photopayment' => $reservation->photopayment,
                'photoid' => $reservation->photoid,

            ]);


            $reservation->delete();

            $this->resetPage();
        }

    }

    public function cancell($Id){
        $reservation = Reservation::find($Id);

        if ($reservation) {

            cancelledlist::create([
                'reservationid' => $reservation->reservationid,
                'fullname' => $reservation->fullname,
                'location' => $reservation->location,
                'number' => $reservation->number,
                'cottagenumber' => $reservation->cottagenumber,
                'paymenttype' => $reservation->paymenttype,
                'children' => $reservation->children,
                'adults' => $reservation->adults,
                'checkin' => $reservation->checkin,
                'checkout' => $reservation->checkout,
                'totalbill' => $reservation->totalbill,
                'photopayment' => $reservation->photopayment,
                'photoid' => $reservation->photoid,

            ]);


            $reservation->delete();

            $this->resetPage();
        }

    }
}
