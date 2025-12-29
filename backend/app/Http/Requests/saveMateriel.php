<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveMateriel extends FormRequest
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
    public function rules(): array
    {
        return [
            'marque' => 'required',
            'modele' => 'required',
            'numero_serie' => 'required',
            'etat' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'observation' => 'required',
            'type_mat_id' => 'required',
            'region_id' => 'required',
            'shop_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'marque' => 'La marque est obligatoire',
            'modele' => 'Le modèle est obligatoire',
            'numero_serie' => 'Le numéro série est obligatoire',
            'etat' => 'L\'etat du materiel est obligatoire',
            'photo.image' => 'Le fichier doit être une image',
            'photo.mimes' => 'Formats autorisés : jpg, jpeg, png',
            'photo.max' => 'La photo ne doit pas dépasser 2 Mo',
        ];
    }
}
