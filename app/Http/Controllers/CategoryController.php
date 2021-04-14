<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Traits\DeleteModelTrait;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use DeleteModelTrait;
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $categories = $this->category->latest()->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        $optionCategory=$this->getCategory($parentId = '');
        return view('admin.category.create',compact('optionCategory'));
    }
    public function store(Request $request)
    {
        $this->category->create(
            [
                'name' => $request->name,
                'parent_id'=> $request->parent_id,
                'slug'=>Str::slug($request->name)
            ]
        );
        return redirect()->route('categories.index');
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $optionCategory = $recusive->categoryRecusive($parentId);
        return $optionCategory;
    }
    public function edit($id)
    {
        $category = $this->category->find($id);
        $optionCategory = $this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','optionCategory'));
    }
    public function update($id,Request $request)
    {
         $this->category->find($id)->update(
             [
                 'name' => $request->name,
                 'parent_id'=> $request->parent_id,
                 'slug'=>Str::slug($request->name)
             ]);
        return redirect()->route('categories.index');
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->category);
    }
}
