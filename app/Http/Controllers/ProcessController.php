<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Imports\CsvImport;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use App\Material;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;




class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::get();
        return view('display', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'partnum' => 'required|regex:/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^\w\d\s]).+$/u|unique:materials',
                'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/u',
                'um' => 'required|regex:/^[a-zA-Z0-9\s]+$/u'
            ],
            [
                'partnum.regex' => 'Part Number must be alpha numeric',
                'partnum.unique' => 'Part Number already exists',
                'name.regex' => 'Name must not contain special characters',
                // 'name.unique' => 'Name already exists',
                'um.regex' => 'UM must not contain special characters',
            ]


        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = new Material();
        $data->partnum = strtoupper(trim($request->partnum));
        $data->name = strtoupper(trim($request->name));
        $data->um = strtoupper(trim($request->um));
        $data->save();
        Session::flash('alert-success', 'Data Save Successfully');
        return redirect('/crud');
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
        $materialData = Material::findOrFail($id);
        return view('edit', compact('materialData'));
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
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'partnum' => 'required|regex:/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^\w\d\s]).+$/u',
                    'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/u',
                    'um' => 'required|regex:/^[a-zA-Z0-9\s]+$/u'
                ],
                [
                    'partnum.regex' => 'Part Number must be alpha numeric',
                    'name.regex' => 'Name must not contain special characters',
                    'um.regex' => 'UM must not contain special characters',
                ]

            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $materialData = Material::where('partnum', $request->partnum)->where('id', '!=', $id)->first();
            if ($materialData != null) {
                return redirect()->back()->with('error', 'Part Number' . $request->partnum . 'already exists');
            }
            $materialData = Material::findOrFail($id);
            $materialData->partnum = strtoupper(trim($request->partnum));
            $materialData->name = strtoupper(trim($request->name));
            $materialData->um = strtoupper(trim($request->um));
            $materialData->save();
            Session::flash('alert-success', 'Data Updated Successfully');
            return redirect('/crud');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ada sesuatu yang salah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect('/crud');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $data = Material::where('partnum', 'LIKE', '%' . $request->search . '%')->get();
            if ($data->isEmpty()) {
                //  return view('display')->with('error', 'No matching records found.');
                 return redirect()->back()->with('error', 'No matching records found.');
            }
        } else {
            $data = Material::all();
        }
        return view('display', ['materials' => $data]);
    }


    // IMPORT DARI EXCEL KE DATABASE
    public function importExcel(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'importFile' => 'required|mimes:xlsx',
            ],
            [
                'importFile.mimes' => 'File format must be xlsx'
            ]


        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        
        Excel::import(new ExcelImport, request()->file('importFile'));
        Session::flash('alert-success', 'Successfully Insert Data');
        return back();


    }

    // EXPORT EXCEL
    public function exportExcel(){
        return Excel::download(new ExcelExport, 'Material.xlsx');
    }

    // EXPORT PDF
    public function exportPdf(){
        $data = Material::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('display-pdf');
        return $pdf->download('report.pdf');
        // return $pdf->stream();
    }
}
