<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pages extends Component
{
    public $title;
    public $slug;
    public $description;

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

    /**
     * render the views
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages');
    }
}
