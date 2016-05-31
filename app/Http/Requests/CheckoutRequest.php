<?php

namespace CodeDelivery\Http\Requests;

use CodeDelivery\Http\Requests\Request;

class CheckoutRequest extends Request
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
        $rules = [
            'cupom_code' => 'exists:cupoms,code,used,0',
        ];
        $this->buildRulesItems(0, $rules);
        $items = $this->get('items', []);

        foreach ($items as $key => $val){
            $this->buildRulesItems($key, $rules);
        }

        return $rules;
        // todo : erro request

    }

    public function  buildRulesItems($key, array &$rules)
    {
        $rules ["items.$key.product_id"] = 'required';
        $rules ["items.$key.qtd"] = 'required';

    }
}
