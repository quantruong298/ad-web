<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
        if (isset(request()->id)) {

            if (request()->file !== 'undefined') {
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'startday' => ['required', 'date'],
                    'endday' => ['required', 'date', 'after_or_equal:startday'],
                    'budget' => ['required', 'numeric', 'gte:bid'],
                    'bid' => ['required', 'numeric'],
                    'description' => ['required'],
                    'title' => ['required', 'max:255'],
                    'file' => ['required', 'image'],
                    'finalurl' => ['required', 'url'],
                ];
            } else {
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'startday' => ['required', 'date'],
                    'endday' => ['required', 'date', 'after_or_equal:startday'],
                    'budget' => ['required', 'numeric', 'gte:bid'],
                    'bid' => ['required', 'numeric'],
                    'description' => ['required'],
                    'title' => ['required', 'max:255'],
                    'finalurl' => ['required', 'url'],
                ];
            }

        } else {
            return [
                'name' => ['required', 'string', 'max:255'],
                'startday' => ['required', 'date'],
                'endday' => ['required', 'date', 'after_or_equal:startday'],
                'budget' => ['required', 'numeric', 'gte:bid'],
                'bid' => ['required', 'numeric'],
                'description' => ['required'],
                'title' => ['required', 'max:255'],
                'file' => ['required','image'],
                'finalurl' => ['required', 'url'],
            ];
        }
    }
}
