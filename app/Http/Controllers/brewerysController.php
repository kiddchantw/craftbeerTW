<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use App\BrewerysStores;
use App\Items;
use Symfony\Component\Finder\Finder;

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


    public $messageValidate = [
        "name.required" => "請輸入name",
        "name.unique" => "name exist",
        "password.required" => "請輸入password",
        "password.regex" => "請確認password符合 A-Za-z0-9 ",
        "email.required" => "請輸入email",
        "email.unique" => "email exist"
    ];

    public function customValidate(Request $request, array $rulesInput)
    {
        try {
            $this->validate($request, $rulesInput, $this->messageValidate);
        } catch (ValidationException $exception) {
            $errorMessage = $exception->validator->errors()->first();
            return  $errorMessage;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "email" => "required| email |unique:brewerys_and_stores",
            "password" => "required|string | min:1   | regex:/^[A-Za-z0-9]+$/",
            "name" => "required |string | min:1 |unique:brewerys_and_stores",
        ];
        $validResult = $this->customValidate($request, $rules);
        if ($validResult != Null) {
            return response()->json(['message' => $validResult], 400);
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
        return BrewerysStores::Find($id);
    }


    public function showAllItems($id)
    {
        //
        $showItems = Items::where('brewerys_and_stores.id', '=', $id)->leftJoin('brewerys_and_stores', 'items.brewerys_and_stores_id', '=', 'brewerys_and_stores.id')->select('brewerys_and_stores.name AS brewerys_and_stores_name', 'items.name', 'items.alc', 'items.price', 'items.note', 'items.release',)->get();
        return $showItems;
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
        $rules = [
            "name" => "required| min:1 | string",
        ];
        $validResult = $this->customValidate($request, $rules);
        if ($validResult != Null){
            return response()->json(['message' => $validResult], 400);
        }
        $updateBrewerysStores = BrewerysStores::find($id);
        $updateBrewerysStores->name = $request->name;
        $updateBrewerysStores->save();
        return response()->json(['message' => 'BrewerysStores:'. $id .' update success'], 201);
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
        if(BrewerysStores::find($id)){
            BrewerysStores::destroy($id);
            return response()->json(['message' => 'BrewerysStores:'. $id .' destroy success'], 201);
        } else{
            return response()->json(['message' => "destroy fail"], 400);
        }
    }
}
