<?php

namespace Modules\Subcription\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{

    public function rules()
    {
        return [
                'client_id' => 'required',
                'package_id' => 'required',
                'module_id' => 'required',
                'invoice_date' =>'required',
                'bill_start_date' =>'required',
                'package_payment_method_id' => 'required',
                'payment_status' => 'required',
                'title' => 'required',
                'price' => 'required',
                'duration' => 'required'
        ];
    }


    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
           'client_id.required' => 'Client field is required',
           'package_id.required' => 'Package field is required',
           'module_id.required' => 'Module field is required',
           'invoice_date.required' => 'Invoice Date field is required',
           'bill_start_date.required' => 'Bill Start Date field is required',
           'package_payment_method_id.required' => 'Payment method field is required',
           'payment_status.required' => 'Payment Status is required',
           'title.required' => 'Title field is required',
           'price.required' => 'Price field is required',
           'duration.required' => 'Duration field is required',
        ];
    }
}
