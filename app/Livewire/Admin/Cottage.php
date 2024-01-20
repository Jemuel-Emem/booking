<?php

namespace App\Livewire\Admin;
use App\Models\Cottage as Modelcottage;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;
class Cottage extends Component
{
    use Actions;
    use WithFileUploads;
    public $open_modal = false;
    public $search;
    public $cottagephoto, $description, $price, $cottage;
    public function render()
    {

        $search = '%' . $this->search . '%';
        return view('livewire.admin.cottage', [
            'reserv' => Modelcottage::where('id', 'like', $search)->paginate(10),
        ]);

    }

    public function add(){

     $this->open_modal = true;
    }

    public function submit(){
        $cottagephotopath = $this->cottagephoto->store('photos', 'public');
        $cottage = new Modelcottage([
        'description' => $this->description,
        'price' => $this->price,
        'cottagephoto' => $cottagephotopath,

    ]);

    $cottage->save();
        $this->notification()->success(
            $title = 'Cottage Saved',
            $description = 'The cottage was successfully saved'
        );

        $this->open_modal = false;
        $this->resetForm();
    }

    public function back(){

    }

private function resetForm(){
    $this->description = "";
    $this->price = "";
}
}