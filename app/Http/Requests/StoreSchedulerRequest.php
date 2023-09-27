<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchedulerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'channel' => 'required|string|in:mail,database',
            'message' => 'required|string|max:256',
            'time' => 'required|date_format:Y-m-d\TH:i:s',
            'email' => 'nullable|required_if:channel,mail|email',
        ];
    }
}
