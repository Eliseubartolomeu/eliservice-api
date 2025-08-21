<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'service' => 'required|string',
            'date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['service'] = 'sometimes|string';
        }

        return $rules;
    }

    public function messages() : array 
    {
        return[
            'service.required' => 'É obrigatório fornecer um serviço para agendar',
            'service.string' => 'Deve fornecer um serviço válido',

            'date.required' => 'Deve fornecer uma data para a realização do serviço!',
            'date.date_format' => 'A data deve estar no formato YYYY-MM-DD (ex: 2025-08-21)',
            'date.after_or_equal' => 'A data não pode ser uma data do passado!',

            'start_time.required' => 'Deve fornecer um horário para o início do serviço',
            'start_time.date_format' => 'O horário deve estar no formato HH:mm (ex: 14:30)',
        ];
    }
}
