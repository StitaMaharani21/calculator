<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function calculator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstnumber' => 'required|numeric',
            'secondnumber' => 'required|numeric',
            'operator' => 'required|in:+,-,/,*'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $firstnumber = $request->input('firstnumber');
        $secondnumber = $request->input('secondnumber');
        $operator = $request->input('operator');
        $result = 0;

        if ($operator == '+') {
            $result = $firstnumber + $secondnumber;
        } elseif ($operator == '-') {
            $result = $firstnumber - $secondnumber;
        } elseif ($operator == '/') {
            if ($secondnumber != 0) {
                $result = $firstnumber / $secondnumber;
            } else {
                return redirect('/')->with('info', 'Tidak Bisa dibagi 0');
            }
        } elseif ($operator == '*') {
            $result = $firstnumber * $secondnumber;
        } else {
            $result = 0;
        }

        return redirect('/')->with('info', $result);
    }
}
