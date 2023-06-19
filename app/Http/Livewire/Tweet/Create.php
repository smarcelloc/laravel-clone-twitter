<?php

namespace App\Http\Livewire\Tweet;

use App\Models\Tweet;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class Create extends Component
{
    public ?string $body = null;

    public function render()
    {
        return view('livewire.tweet.create');
    }

    public function submit(): void
    {
        $this->authorize();
        $this->validation();
        $this->builder();
        $this->emit('tweet::created');
        $this->resetSubmit();
    }

    private function authorize(): void
    {
        Gate::allowIf(auth()->check());
    }

    private function validation(): void
    {
        $this->validate(['body' => ['required', 'string', 'max:500']]);
    }

    private function builder(): void
    {
        Tweet::query()->create([
            'body' => $this->body,
            'created_by' => auth()->id()
        ]);
    }

    private function resetSubmit(): void
    {
        $this->body = null;
    }
}
