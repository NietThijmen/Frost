<?php

namespace App\Livewire\Organisation;

use Livewire\Component;

class Create extends Component
{

    public $name;


    public function render()
    {
        return view('livewire.organisation.create');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $organisation = auth()->user()->organisations()->create([
            'name' => $this->name,
            'slug' => \Str::slug($this->name),
        ]);

        \Cookie::queue(
            \Cookie::make('organisation', $organisation->id, 60 * 24 * 30)
        );

        return redirect()->route('dashboard');
    }
}
