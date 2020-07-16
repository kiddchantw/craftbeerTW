<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required| min:1 | string",
            "brewerys_and_stores_id" => "required|int|exists:brewerys_and_stores,id",
            "alc" => "required|numeric",
            "price" => "required|int",
            "release" => "required|boolean",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "請輸入name",
            "brewerys_and_stores_id.exists" => "請輸入 brewerys_and_stores_id",
            "alc.required" => "請輸入alc",
            "price.required" => "請輸入price",
            "release.required" => "請輸入release",
        ];
    }
}
