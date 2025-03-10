<?php

namespace App\Livewire\Organisation;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Select extends Component
{
    public Collection $organisations;

    public function mount()
    {
        $this->organisations = auth()->user()->organisations;
    }

    public function render()
    {
        return view('livewire.organisation.select');
    }

    public function selectOrganisation($organisationId)
    {
        \Cookie::queue(
            \Cookie::make('organisation', $organisationId, 60 * 24 * 30)
        );

        return redirect()->route('dashboard');
    }
}
