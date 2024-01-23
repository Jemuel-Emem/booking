<?php

namespace App\Livewire\Admin;
use App\Models\ReservationList as res;
use App\Models\ReservationHistory as resHistory;
use Livewire\Component;
use App\Models\Cottage;
use Livewire\WithPagination;
class Reservationlist extends Component
{
    use  WithPagination;
    public $search;
    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.admin.reservationlist', [
            'reserv' => res::where('reservationid', 'like', $search)->paginate(10),
        ]);

    }
    public function asss()
    {

        $this->resetPage();


    }

    public function confirm($Id){
        $reservation = res::find($Id);

        if ($reservation) {

            resHistory::create([
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

            $this->updateCottageStatus($reservation->cottagenumber);
            $reservation->delete();

            $this->resetPage();
        }

    }

    private function updateCottageStatus($cottageCode)
    {
       // dd('Provided Cottage Code:', $cottageCode);

    $cottage = Cottage::where('cottagecode', $cottageCode)->first();

    // Add debug statement to check if the cottage is found
    // dd('Cottage found:', $cottage);

    if ($cottage) {
        $cottage->update([
            'status' => 'available',
        ]);

    } else {
        dd('Cottage not found.');
    }
}


}
