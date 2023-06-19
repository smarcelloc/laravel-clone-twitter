<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class Timeline extends Component
{
    protected $listeners = ['tweet::created' => '$refresh'];

    public function render()
    {
        return view('livewire.timeline', [
            'tweets' => Tweet::query()->latest()->get()
        ]);
    }
}
