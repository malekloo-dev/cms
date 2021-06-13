<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuService
{
    protected $menu;



    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->postRepository->save($data);
        return $result;

    }
    public function getAll(Request $request)
    {
        return $this->postRepository->getAll();
    }


}
