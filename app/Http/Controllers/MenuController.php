<?php

namespace App\Http\Controllers;
use App\Components\MenuRecusive;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use App\Models\Menu;
use Illuminate\Support\Str;


class MenuController extends Controller
{
    use DeleteModelTrait;
    private $menuRecusive;
    private $menu;
    public function __construct(MenuRecusive $menuRecusive , Menu $menu)
    {
        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }
    public function index()
    {
        $menus =$this->menu->latest()->paginate(10);
        return view('admin.menu.index',compact('menus'));
    }
    public function create()
    {
        $optionMenu = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menu.create', compact('optionMenu'));
    }
    public function store(Request $request)
    {
        $this->menu->create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }
    public function edit($id ,Request $request)
    {
        $menu = $this->menu->find($id);
        $optionMenu = $this->menuRecusive->menuRecusiveEdit($menu->parent_id);
        return view('admin.menu.edit', compact('menu','optionMenu'));
    }
    public function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'slug'=>Str::slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->menu);
    }
}
