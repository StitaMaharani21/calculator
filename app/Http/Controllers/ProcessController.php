<?php

namespace App\Http\Controllers;

use App\Imports\CsvImport;
use Illuminate\Http\Request;
use App\Material;
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
                'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/u|unique:materials',
                'um' => 'required|regex:/^[a-zA-Z0-9\s]+$/u'
            ],
            [
                'partnum.regex' => 'Part Number must be alpha numeric',
                'partnum.unique' => 'Part Number already exists',
                'name.regex' => 'Name must not contain special characters',
                'name.unique' => 'Name already exists',
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

        $materialData = Material::findOrFail($id);
        $materialData->partnum = strtoupper(trim($request->partnum));
        $materialData->name = strtoupper(trim($request->name));
        $materialData->um = strtoupper(trim($request->um));
        $materialData->save();
        Session::flash('alert-success', 'Data Updated Successfully');
        return redirect('/crud');
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
                return view('display')->with('error', 'No matching records found.');
            }
        } else {
            $data = Material::all();
        }
        return view('display', ['materials' => $data]);
    }

    public function importExcel(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'importFile' => 'required|mimes:xlsx,xls',
            ],
            [
                'importFile.mimes' => 'File must xlsx or xls' 
            ]


        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        Excel::import(new CsvImport, request()->file('importFile'));
        return back();

        // $request->validate([
        //     'importFile' => 'required|mimes:xlsx,xls',
        // ]);

        // $path = $request->file('importFile')->getRealPath();


        // $data = Excel::load($path, function ($reader) {
        // })->get();


        // if (!empty($data) && $data->count()) {
        //     foreach ($data->toArray() as $key => $value) {
        //         if (!empty($value)) {
        //             foreach ($value as $v) {
        //                 $insert[] = ['partnum' => $v['partnum'], 'name' => $v['name'], 'um' => $v['um']];
        //             }
        //         }
        //     }
        //     if (!empty($insert)) {
        //         Material::insert($insert);
        //         return back()->with('success', 'Insert Record successfully.');
        //     }
        // }

        // return redirect()->back()->with('success', 'Data imported successfully!');
        // Excel::create('materials',function($excel) use ($data){


        // });
        // $request->validate([
        //     'importFile' => 'required|mimes:xlsx,xls,csv',
        // ]);

        // $file = $request->file('importFile');
        // $fileContents = file($file->getPathname());
        // // dd($fileContents);
        // foreach ($fileContents as $row) {
        //     $data = str_getcsv($row);
        //     // dd($data);
        //     Material::create([
        //     'partnum' => $data[0],
        //     'name' => $data[1],
        //     'um' => $data[2]
        //    ]);
        // }

        // return redirect()->back()->with('success', 'Data imported successfully!');
    }
}
