<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Items;
use App\Http\Requests\ItemsRequest;
use Validator;

class itemsController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $messageValidate = [
        "name.required" => "請輸入name",
        "brewerys_and_stores_id.required" => "請輸入name brewerys_and_stores_id",
        "alc.required" => "請輸入alc",
        "price.required" => "請輸入price",
        "release.required" => "請輸入release",
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


    public function store(Request $request)
    {
        $rules = [
            "name" => "required| min:1 | string",
            "brewerys_and_stores_id" => "required|int|exists:brewerys_and_stores,id",
            "alc" => "required|numeric",
            "price" => "required|int",
            "release" => "required|boolean",
        ];
        $validResult = $this->customValidate($request, $rules);
        if ($validResult != Null){
            return response()->json(['message' => $validResult], 400);
        }

        $newItem = Items::create($request->all());
        return response()->json(['message' => 'newItem add success'], 201);

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
        return Items::find($id);

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
        $rules = [
            "name" => "required| min:1 | string",
        ];
        $validResult = $this->customValidate($request, $rules);
        if ($validResult != Null){
            return response()->json(['message' => $validResult], 400);
        }
        $updateItem = Items::find($id);
        $updateItem->name = $request->name;
        $updateItem->save();
        return response()->json(['message' => 'Item:'. $id .' update success'], 201);
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
