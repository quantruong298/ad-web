<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->pid){
            return [
                'name' => 'required|max:30',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'description' => 'max:255',
                'catalog_id' => 'required',
            ];
        }
        else {
            return [
                'name' => 'required|unique:products|max:30',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'description' => 'max:255',
                'image'=>'required',
                'catalog_id' => 'required',
            ];
        }
    }
}
