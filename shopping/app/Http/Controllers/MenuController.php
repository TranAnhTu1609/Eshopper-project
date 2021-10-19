<?php

namespace App\Http\Controllers;

use App\Components\menuRecusive;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class MenuController extends Controller
{
    private $menuRecusive;
    private $menu;
    public function __construct(menuRecusive $menuRecusive,Menu $menu)
    {
        $this->menuRecusive=$menuRecusive;
        $this->menu=$menu;
    }

    public function index() {
        $menus=$this->menu->latest()->paginate(7);
        return view('admin.menus.index',compact('menus'));
    }
    public  function create() {
        $optionSelect=$this->menuRecusive->getmenuRecusiveAdd();
        return view('admin.menus.add',compact('optionSelect'));
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
    public function edit($id) {
        $optionSelect=$this->menu->find($id);
        $htmlSelect=$this->menuRecusive->getmenuRecusiveEdit($optionSelect->parent_id);
        return view('admin.menus.edit',compact('optionSelect','htmlSelect'));
    }
    public  function update($id,Request $request) {
        $this->menu->find($id)->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }
    public function delete($id) {
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }
}
