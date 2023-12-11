<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
        return [
            'branchOfficeId' => 'required|integer',
            'probabilityId' => 'required|integer',
            'typeId' => 'required|integer',
            'channelId' => 'required|integer',
            'mediaId' => 'required|integer',
            'sourceId' => 'integer|nullable',
            'fullName' => 'required|string',
            'email' => 'string|nullable',
            'phone' => 'string|nullable',
            'address' => 'required|string',
            'latitude' => 'string|nullable',
            'longitude' => 'string|nullable',
            'companyName' => 'string|nullable',
            'generalNotes' => 'required|string',
        ];
    }
}
