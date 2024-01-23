<?php

namespace App\Livewire\Admin;
use App\Models\ReservationList;
use App\Models\CancelledList;
use App\Models\Totalincome;
use App\Models\Reservation;
use Livewire\Component;

class Dashboard extends Component
{

    public function render()
    {
        $totalcancelledList = CancelledList::count();
        $totalbookingList = Reservation::count();
        $totalReservationList = ReservationList::count();


        $dailyIncomeData = Totalincome::selectRaw('DATE(created_at) as date, sum(income) as income')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $dailyIncomeData->pluck('date')->toArray();
        $totalIncome = $dailyIncomeData->pluck('income')->toArray();

        return view('livewire.admin.dashboard', [
            'totalReservationList' => $totalReservationList,
            'totalcancelledList' => $totalcancelledList,
            'totalbookingList' => $totalbookingList,
            'chartData' => [
                'labels' => json_encode($dates),
                'datasets' => [
                    [
                        'label' => 'Daily Income',
                        'data' => json_encode($totalIncome),
                        'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                    ],
                ],
            ],
        ]);
    }
}
