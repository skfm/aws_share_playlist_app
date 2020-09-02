<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistRequest extends FormRequest
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
            'title' => 'required|max:50',
            'description' => 'required|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'プレイリストタイトル',
            'description' => 'プレイリストの説明',
            'url' => 'プレイリストURL',
        ];
    }
}
