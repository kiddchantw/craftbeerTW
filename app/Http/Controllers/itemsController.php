<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Items;
use App\Http\Requests\ItemsRequest;


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
    // public function store(Request $request)
    public function store(ItemsRequest $request)
    {
        // try {
        //     $rules = [
        //         "name" => "required| min:1 | string",
        //         "brewerys_and_stores_id" => "required|int|exists:brewerys_and_stores,id",
        //         "alc" => "required|numeric",
        //         "price"=> "required|int",
        //         "release"=> "required|boolean",
        //     ];
        //     $message = [
        //         "name.required" => "請輸入name",
        //         "brewerys_and_stores_id.required" => "請輸入name brewerys_and_stores_id",
        //         "alc.required" => "請輸入alc",
        //         "price.required" => "請輸入price",
        //         "release.required" => "請輸入release",
        //     ];
        //     $request->validate($rules, $message);
        // } catch (ValidationException $exception) {
        //     $errorMessage = $exception->validator->errors()->first();
        //     return response()->json([
        //         'message' => $errorMessage
        //     ], 400);
        //     // $this->showValidationException($exception);
        // }

        // $newItem = new Items();
        

        // $newItem->name = $request->name;
        // $newItem->brewerys_and_stores_id = $request->brewerys_and_stores_id;
        // $newItem->alc = $request->alc;
        // $newItem->price = $request->price;
        // $newItem->release = $request->release;
        // $newItem->save();
        // return response()->json(['message' => 'newItem add success'], 201);

        // $this->validate( $request,$request->rules(), $request->messages());

        try {
            Items::create($request->all());

            $success = true;
            $message = "Stored successful";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $data = null;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response, 200);


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
    // public function update(Request $request, $id)
    public function update(ItemsRequest $request, $id)
    {
        //
        // var_dump($request->all());

        $updateItem = Items::find($id);
        $updateItem->name = $request->name;
        dd( $updateItem->name );

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
