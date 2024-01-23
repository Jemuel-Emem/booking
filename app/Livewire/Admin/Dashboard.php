<?php

namespace App\Livewire\Admin;
use App\Models\ReservationList;
use App\Models\CancelledList;
use App\Models\Totalincome;
use App\Models\Reservation;
use Livewire\Component;

class Dashboard extends Component
{
public $sub;
    public function render()
    {
        $totalcancelledList = CancelledList::count();
        $totalbookingList = Reservation::count();
        $totalReservationList = ReservationList::count();
        $this->loadData();
        return view('livewire.admin.dashboard', [
            'totalReservationList' => $totalReservationList,
            'totalcancelledList' => $totalcancelledList,
            'totalbookingList' => $totalbookingList,

        ]);
    }


    public function loadData()
    {
        $dailyIncomeData = Totalincome::selectRaw('DATE(created_at) as date, sum(income) as income')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $dailyIncomeData->pluck('date')->toArray();
        $totalIncome = $dailyIncomeData->pluck('income')->toArray();

        $this->sub = array_map(function ($date, $income) {
            return ['Day' => $date, 'Value' => $income];
        }, $dates, $totalIncome);

    }

    protected $listeners = ['loadData'];
}

