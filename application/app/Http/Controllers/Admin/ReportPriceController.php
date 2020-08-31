<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\table;
use App\Classes\permission;
use App\Model\ReportPrice;
use Illuminate\Support\Facades\Crypt;
class ReportPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = ReportPrice::orderBy('created_at', 'desc')->take(60)->get();
        $ss = table::settings()->select('clock_comment', 'time_format')->first();
        $employees = table::people()->get();
        $tf = table::settings()->value("time_format");
        $cc = table::settings()->value("clock_comment");
//        dd($ss);
        return view('admin.report-price.index', compact('reports', 'ss', 'employees', 'tf', 'cc'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
//            'people_id' =>  'required',
//            'user_id'  => 'required',
            'date' => 'required',
            'statr_date' => 'required',
            'name' => 'required',
//            'last_name' => 'required',
//            'price' => 'required',
        ]);
//        dd($request['name']);

        ReportPrice::add($request->all());
        return redirect('report-price')->with('success', trans("Report people attendance has been added!"));

//        return redirect()->route('report-price');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        dd($id);
        $report = ReportPrice::find($id);
        $tf = table::settings()->value("time_format");
        return view('admin.report-price.edit',compact('report', 'tf'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'statr_date' => 'required',
            'name' => 'required',
            'end_date'=> 'required',
            'reason'=> 'required'
        ]);
        $report = ReportPrice::find($id);
        $report->edit($request->all());
        return redirect('report-price')->with('success', trans("Reports people attendance has been updated!"));

//        return redirect()->route('report-price');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = ReportPrice::find($id);
        if($report->delete())
        {
            return back();
        }
    }
}
