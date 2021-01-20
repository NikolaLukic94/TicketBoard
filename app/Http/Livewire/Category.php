<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Category extends Component
{
    public $name;

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
        ]);

        Category::create($validatedData);

        return redirect()->to('/form');
    }

    public function render()
    {
        return view('livewire.category');
    }
}
