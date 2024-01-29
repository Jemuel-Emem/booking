<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Cottage;
use App\Models\Reservation;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
class Book extends Component
{
    use Actions;
    use WithFileUploads;
    public $cottageNumbers = [];
    public $fullname,$bookdate;
    public $location;
    public $number;
    public $cottagenumber;
    public $children;
    public $adults;
    public $checkin;
    public $checkout;
    public $totalbill;
    public $photopayment;
    public $photoid;
    public $paymenttype;
    public $price;
    public $calculatedTotal;
    public $selectedCottagePrice;


    public function mount()
    {
        // $this->cottageNumbers = Cottage::pluck('cottagecode')->toArray();
        //  $this->loadCottagePrice($this->cottageNumbers[0]);

        $this->cottageNumbers = Cottage::where('status', 'available')->pluck('cottagecode')->toArray();
        $this->loadCottagePrice($this->cottageNumbers[0]);
    }

    private function loadCottagePrice($cottageId)
{

    $cottage = Cottage::where('cottagecode', $cottageId)->first();

    if ($cottage) {
        $this->selectedCottagePrice = $cottage->price;

    } else {
        dd("Cottage not found!");
    }
}

    public function render()
    {
        return view('livewire.user.book');
    }


    public function booknow(){

        $selectedCottage = Cottage::where('cottagecode', $this->cottagenumber)->first();

        if ($selectedCottage && $selectedCottage->status === 'not available') {

            $this->notification()->error(
                $title = 'Cottage Not Available',
                $description = 'The selected cottage is not available for reservation.'
            );

            // You can handle the error in any way you prefer, such as returning or redirecting
            return;
        }
        $photopaymentpath = $this->photopayment->store('photos', 'public');

        $photoidpath = $this->photoid ? $this->photoid->store('photos', 'public') : null;

        // $photoidpath = $this->photoid->store('photos', 'public');

        $nextId = Str::random(6);
       $reservation = new Reservation([
        'reservationid' => 'srv' . $nextId,
        'bookdate' => $this->bookdate,
        'fullname' => $this->fullname,
        'location' => $this->location,
        'number' => $this->number,
        'cottagenumber' => $this->cottagenumber,
        'paymenttype' => $this->paymenttype,
        'children' => $this->children,
        'adults' => $this->adults,
        'checkin' => $this-> checkin ,
        'checkout' => $this-> checkout,
        'totalbill' => $this->calculatedTotal,
        'photopayment' => $photopaymentpath,
        'photoid' => $photoidpath,
    ]);
        $reservation->save();
        dd("Sasasa");

        $this->dialog()->show([
            'title'       => 'Book Saved',
            'description' => 'Your reservation was successfully saved. Your reservation ID is srv' . $nextId,
            'icon'        => 'success'
        ]);
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->fullname = '';
        $this->location = '';
        $this->number = '';
        $this->children = '';
        $this->adults = '';
        $this->checkin = '';
        $this->checkout = '';
        $this->totalbill = '';
        $this->photopayment = null;
        $this->photoid = null;
    }

    public function updatedChildren()
    {
        $this->recalculateTotal();
    }

    public function updatedAdults()
    {
        $this->recalculateTotal();
    }

    public function recalculateTotal()
    {

        $children = is_numeric($this->children) ? $this->children : 0;
        $adults = is_numeric($this->adults) ? $this->adults : 0;
 $this->calculatedTotal = ($children * 30) + ($adults * 50) + $this->selectedCottagePrice;
    }
}
