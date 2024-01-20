<?php

namespace App\Livewire\Admin;
use App\Models\ReservationList as res;
use Livewire\Component;
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
}
