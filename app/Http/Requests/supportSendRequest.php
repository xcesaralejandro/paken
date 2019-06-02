<?php

namespace paken\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class supportSendRequest extends FormRequest
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
            'asunto'            => 'required',
            'prioridad'         => 'required',
            'motivo'            => 'required',
            'contenido_mensaje' =>'min:30|max:2000|required'
        ];
    }
}
