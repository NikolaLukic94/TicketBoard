<?php

namespace App\Http\Livewire;

use App\Repositories\SubcategoryRepositoryIterface;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Subcategory extends Component
{
    use WithPagination;

    public $showForm = false;
    public $search = '';

    public $subcategoryId;
    public $name;
    public $categoryId;
    public $updateMode = false;
    public $categories;

    protected $rules = [
        'name' => 'required',
        'categoryId' => 'required',
    ];

    public function render()
    {
//        $this->subcategories = \App\Models\Subcategory::with('category.project')->get();
        $this->categories = \App\Models\Category::all();

        return view('livewire.subcategory', [
            'subcategories' => \App\Models\Subcategory::
                when(strlen($this->search) > 3, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%');
                })
            ->paginate(10)
        ]);
    }

    public function submitForm()
    {
        $this->validate();

        App::make(SubcategoryRepositoryIterface::class)->store($this->name, $this->categoryId);

        $this->resetForm();

        $this->showForm = false;
    }

    public function update()
    {
        App::make(SubcategoryRepositoryIterface::class)->update(
            $this->subcategoryId, $this->name, $this->categoryId
        );

        $this->updateMode = false;
        $this->subcategoryId = null;
        $this->showForm = false;

        session()->flash('message', 'Subcategory Updated Successfully.');

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->projectId = '';
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->showForm = false;

        $subcategory = \App\Models\Subcategory::find($id);

        $this->subcategoryId = $id;
        $this->name = $subcategory->name;
        $this->categoryId = $subcategory->category_id;
    }

    public function delete($id)
    {
        if($id){
            App::make(SubcategoryRepositoryIterface::class)->delete($id);

            session()->flash('message', 'Subcategory Deleted Successfully.');
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetForm();
    }
}
