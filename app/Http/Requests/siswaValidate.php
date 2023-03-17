<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class siswaValidate extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|max:255',
            'id_jenkel' => 'required|integer',
            // 'nik' => 'required|unique:siswas,nik|max:12',
            'nik' => 'required|max:12',
            // note : tgl_lahir is not required ok
            'jurusan' => 'required|max:12',
            'angkatan' => 'required|max:2',
            'alamat' => 'required|string|max:5000'
        ];
    }

    public function messages(): array
    {
        return [
            // custom error message
            'nama.required' => 'Fill up the name bruh 🗿',
            'id_jenkel.required' => 'Choose your gender or you are gay 🗿',
            'nik.required' => 'Seriously you don\'t have NIK? 🗿',
            'jurusan.required' => 'Just fill this thing k? 🗿',
            'angkatan.required' => 'What is your graduation, 0? 🗿',
            'alamat.required' => 'Your place so i can say hi to you 🗿',
        ];
    }
}
