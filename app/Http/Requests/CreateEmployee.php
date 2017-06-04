<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class CreateEmployee extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        Validator::extend('chilensis',
            function ($attribute, $value, $parameters, $validator) {
                if (strpos($value, "-")==false) {
                    $RUT[0] = substr($value, 0, -1);
                    $RUT[1] = substr($value, -1);
                } else {
                    $RUT = explode("-", trim($value));
                }
                $elRut = str_replace(".", "", trim($RUT[0]));
                $factor = 2;
                $suma = 0;
                for ($i = strlen($elRut)-1; $i >= 0; $i--):
                    $factor = $factor > 7 ? 2 : $factor;
                $suma += $elRut{$i}*$factor++;
                endfor;
                $resto = $suma % 11;
                $dv = 11 - $resto;
                if ($dv == 11) {
                    $dv=0;
                } elseif ($dv == 10) {
                    $dv="k";
                } else {
                    $dv=$dv;
                }
                if ($dv == trim(strtolower($RUT[1]))) {
                    return true;
                } else {
                    return false;
                }
            }
        );
        
        return
        [
            'name'  => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/|min:3',
            'rut'   => 'required|between:9,10|unique:employees|chilensis',
            'type'  => 'required'
        ];
    }

    public function messages(){
        
        return
        [
            'name.required' => 'El nombre del empleado es obligatorio',
            'name.regex'    => 'El nombre es invalido',
            'name.min'      => 'El nombre debe tener como mínimo 3 caracteres',

            'rut.required'  => 'El rut del empleado es obligatorio',
            'rut.between'   => 'El rut del empleado es invalido',
            'rut.unique'    => 'Este rut ya se encuentra registrado',
            'rut.chilensis' => 'El rut es invalido',

            'type.required' => 'El tipo de empleado es obligatorio'
        ];
    }
}
