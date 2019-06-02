<?php

namespace paken\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderProductsRequest extends FormRequest
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
            //Validacion product
            'name.*'             => 'max:120|required',
            'brand.*'            => 'nullable|max:25',
            'model.*'            => 'nullable|max:25',
            'size.*'             => 'max:10|nullable',
            'colour.*'           => 'nullable|max:25',
            'material.*'         => 'nullable|max:25',
            'url_product.*'      => 'nullable|max:255',
            'unit_price.*'       => 'numeric|max:9999999|required',
            'quantity.*'         => 'numeric|max:999|required',
            'shipping_cost.*'    => 'numeric|max:9999999|required',
            'sku.*'              => 'nullable|max:25',
            'estado.*'           => 'required',
            //Validacion order
            'buy_date'           => 'date|required',
            'arrival_date'       => 'date|required',
            'state'              => 'max:15|required',
            'tracking_number'    => 'nullable|max:25',
            'store'              => 'max:25|required',
            'seller'             => 'nullable|max:25',
            'notes'              => 'nullable|max:255',
            'payment_methods_id' => 'required'
        ];
    }
}
