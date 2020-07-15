<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Illuminate\Validation\ValidationException;


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
    public function store(Request $request)
    {
        //
        var_dump($request->all());

        try {
            $rules = [
                "name" => "required| min:1 | string",
                "brewerys_and_stores_id" => "required|int|exists:brewerys_and_stores,id",
                "alc" => "required|numeric",
                "price"=> "required|int",
                "release"=> "required|boolean",
            ];
            $message = [
                "name.required" => "請輸入name",
                "brewerys_and_stores_id.required" => "請輸入name brewerys_and_stores_id",
                "alc.required" => "請輸入alc",
                "price.required" => "請輸入price",
                "release.required" => "請輸入release",
            ];
            $request->validate($rules, $message);
        } catch (ValidationException $exception) {
            $errorMessage = $exception->validator->errors()->first();
            return response()->json([
                'message' => $errorMessage
            ], 400);
        }

        $newItem = new Items();
        $newItem->name = $request->name;
        $newItem->brewerys_and_stores_id = $request->brewerys_and_stores_id;
        $newItem->alc = $request->alc;
        $newItem->price = $request->price;
        $newItem->release = $request->release;
        $newItem->save();
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
