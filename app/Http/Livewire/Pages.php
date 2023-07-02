<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pages extends Component
{
    public $title;
    public $slug;
    public $description;

    protected $listeners = ['refreshComponent' => '$refresh'];

    /**
     * shows from the model of create function
     *
     * @return void
     */
    public function dispatchEvent() : void {
        $this->dispatchBrowserEvent('event-notify', [
            'eventName' => 'Sample Event',
            'eventMessage' => 'You have a sample event notification'
        ]);
    }


    public function markAsRead($id){
        // dd($id);
        if ($id) {
            auth()->user()->unreadnotifications->where('id', $id)->markAsRead();
            $this->emit('refreshComponent');
        }
    }

    /**
     * render the views
     *
     * @return void
     */
    public function render()
    {
        $unreadnotifications = auth()->user()->unreadnotifications;
        return view('livewire.pages', compact('unreadnotifications'));
    }
}
