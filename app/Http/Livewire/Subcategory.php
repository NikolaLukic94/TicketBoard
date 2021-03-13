<?php

namespace App\Http\Livewire;

use App\Repositories\SubcategoryRepositoryIterface;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Subcategory extends Component
{
    use WithPagination;

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
            'subcategories' => \App\Models\Subcategory::paginate(10)
        ]);
    }

    public function submitForm()
    {
        $this->validate();

        App::make(SubcategoryRepositoryIterface::class)->store($this->name, $this->categoryId);
    }

    public function update()
    {
        App::make(SubcategoryRepositoryIterface::class)->update(
            $this->subcategoryId, $this->name, $this->categoryId
        );

        $this->updateMode = false;
        $this->subcategoryId = null;

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
