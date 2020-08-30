<?php
/*
* Workday - A time clock application for employees
* Email: official.codefactor@gmail.com
* Version: 1.1
* Author: Brian Luna
* Copyright 2020 Codefactor
*/
namespace App\Http\Controllers\admin;
use DB;
use App\Classes\table;
use App\Classes\permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Model\Plusminus;
use Illuminate\Support\Facades\Crypt;

class PlusMinusController extends Controller
{

	public function index() 
	{
        $data = Plusminus::all();
        return view('admin.plus-minus.index',compact('data'));
    }
    public function edit($id)
    {
        if(is_numeric($id)&&!empty(Plusminus::find($id)))
        {
            $data = Plusminus::find($id);
//            dd($data->id);
            return view('admin.plus-minus.edit',compact('data'));
        }
        return redirect()->route('denied');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'plus' =>  'required',
            'minus'  => 'required',
        ]);
        $prices = Plusminus::find($id);
        $prices->edit($request->all());
        return redirect('plus-minus')->with('success', trans("Plus minus price information has been updated!"));
    }
}
