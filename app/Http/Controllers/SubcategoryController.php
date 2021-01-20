<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcategoryStoreRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subcategories = Subcategory::all();

        return view('subcategory.index', compact('subcategories'));
    }

    /**
     * @param \App\Http\Requests\SubcategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryStoreRequest $request)
    {
        $subcategory = Subcategory::create($request->validated());

        $request->session()->flash('subcategory.id', $subcategory->id);

        return redirect()->route('subcategory.index');
    }

    /**
     * @param \App\Http\Requests\SubcategoryUpdateRequest $request
     * @param \App\Models\Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        $subcategory->update($request->validated());

        $request->session()->flash('subcategory.id', $subcategory->id);

        return redirect()->route('subcategory.index');
    }
}
