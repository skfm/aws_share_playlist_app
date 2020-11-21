<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|',
            'insta_url' => ['nullable', 'url', 'regex:/instagram.com/'],
            'youtube_url' => ['nullable', 'url', 'regex:/youtube.com\/channel/'],
            'twitter_url' => ['nullable', 'url', 'regex:/twitter.com/'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ユーザー名',
        ];
    }

    public function messages()
    {
        return [
            "image" => "指定されたファイルが画像ではありません。",
            "mines" => "指定された拡張子（PNG/JPG/GIF）ではありません。",
            "url" => "URLを入力してください",
            "insta_url.regex" => "Instagramの正しいURLを指定してください。",
            "youtube_url.regex" => "YouTubeの正しいURLを指定してください。",
            "twitter.regex" => "Twitterの正しいURLを指定してください。"
        ];
    }
}
