<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Items;
use App\Http\Requests\ItemsRequest;
use Validator;
use DB;

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
        if ($validResult != Null) {
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
        // m0 ok :no join
        // return Items::find($id);
        // $showItems = Items:select()

        //m1 ok: left join
        //show item from 哪個brewerys的名稱
        // $showItems = Items::where('items.id','=', $id)->leftJoin('brewerys_and_stores', 'items.brewerys_and_stores_id', '=', 'brewerys_and_stores.id')->select('items.*','brewerys_and_stores.name AS brewerys_and_stores_name')->get();
        // return $showItems ;
        if (Items::find($id)) {
            //m2 
            $showItems = Items::where('items.id', '=', $id)
                ->leftJoin('brewerys_and_stores', 'items.brewerys_and_stores_id', '=', 'brewerys_and_stores.id')
                ->leftJoin('histories', 'items.id', '=', 'histories.item_id')
                ->select(
                    'items.*',
                    'brewerys_and_stores.name AS brewerys_and_stores_name',
                    \DB::raw('AVG(histories.rate) AS rate')
                )
                ->groupBy('items.id')
                ->get();
            return $showItems;
        } else {
            return response()->json(['message' => "id not found"], 400);
        }
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
        if ($validResult != Null) {
            return response()->json(['message' => $validResult], 400);
        }
        $updateItem = Items::find($id);
        $updateItem->name = $request->name;
        $updateItem->save();
        return response()->json(['message' => 'Item:' . $id . ' update success'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteItems = Items::find($id);
        //m2 soft delete
        if ($deleteItems) {
            $deleteItems->delete();
            return response()->json(['message' => 'Item:' . $id . ' delete success'], 201);
        } else {
            return response()->json(['message' => "destroy fail"], 400);
        }


        //m1 ok: destroy
        if(Items::find($id)){
            Items::destroy($id);
            return response()->json(['message' => 'Item:'. $id .' destroy success'], 201);
        } else{
            return response()->json(['message' => "destroy fail"], 400);
        }
    }
}
