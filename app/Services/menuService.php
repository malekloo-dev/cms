<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;


class MenuService
{
    protected $menu;



    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function store(Request $request)
    {

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

return $this->postRepository->getAll();


}
