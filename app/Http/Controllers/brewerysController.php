<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use App\BrewerysStores;

class brewerysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        try {
            $rules = [
                "email" => "required| email |unique:brewerys_and_stores",
                "password" => "required|string | min:1   | regex:/^[A-Za-z0-9]+$/",
                "name" => "required |string | min:1 |unique:brewerys_and_stores",
            ];
            $message = [
                "name.required" => "請輸入name",
                "password.required" => "請輸入password",
                "password.regex" => "請輸入password 2",
                "email.required" => "請輸入email",
            ];
            $validResult = $request->validate($rules, $message);
        } catch (ValidationException $exception) {
            $errorMessage = $exception->validator->errors()->first();
            return response()->json([
                'message' => $errorMessage
            ], 400);
        }
        $newBrewery = new BrewerysStores();
        $newBrewery->name = $request->name;
        $newBrewery->password = $request->password;
        $newBrewery->email = $request->email;
        $newBrewery->save();
        return response()->json(['message' => 'newBrewery add success'], 201);
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
