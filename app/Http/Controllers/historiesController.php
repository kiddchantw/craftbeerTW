<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use Illuminate\Validation\ValidationException;
use App\Histories;

class historiesController extends Controller
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


    public $messageValidate = [
        "user_id.exist"=>"請輸入正確user_id",
        "item_id.exist"=>"請輸入正確item_id",
        "rate.regex" => "請確認評價符合 1-5",
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
        //
        $rules = [
            "user_id" => "required| int |exists:users,id",
            "item_id" => "required|int |exists:items,id" ,
            "rate" => "required |int |regex:/^[1-5]+$/",
        ];
        $validResult = $this->customValidate($request, $rules);
        if ($validResult != Null) {
            return response()->json(['message' => $validResult], 400);
        }
        $newhistory = new Histories();
        $newhistory->user_id = $request->user_id;
        $newhistory->item_id = $request->item_id;
        $newhistory->rate = $request->rate;
        $newhistory->save();
        return response()->json(['message' => 'newhistory add success'], 201);
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
