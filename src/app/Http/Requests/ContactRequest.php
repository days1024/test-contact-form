<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            //
            'first_name' => ['required','string','max:8',
             function ($attribute, $value, $fail) {
             if (mb_strlen($value . request()->input('last_name')) > 8) {
               $fail(__('validation.max.string', ['attribute' => '氏名', 'max' => 8]));
              }
             }
             ],
            'last_name' => ['required', 'string', 'max:8'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel' => ['required'],
            'tel.*' => [
                'required',
                // カスタムバリデーション
                function ($attribute, $value, $fail) {
                    // 全角数字チェック
                    if (preg_match('/[０-９]/', $value)) {
                        $fail('電話番号は半角数字で入力してください');
                    }
                    // 5桁チェック
                    elseif (strlen($value) > 5) {
                        $fail('電話番号は5桁まで数字で入力してください');
                    }
                }
            ],
            'address' => ['required'],
            'category_id' => ['required'],
            'detail' => ['required', 'max:120']

        ];
    }


        public function messages()
        {
         return [
        'first_name.required' => '名を入力してください',
        'first_name.string' => '名を文字列で入力してください',
        'last_name.required' => '姓を入力してください',
        'last_name.string' => '姓を文字列で入力してください',
        'gender.required' => '性別を選択してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メールアドレスはメール形式で入力してください',
        'tel.required' => '電話番号を入力してください',
        'tel.*.required' => '電話番号を入力してください',
        'tel.*.digits_between' => '電話番号は半角数字で正しく入力してください',
        'address.required' => '住所を入力してください',
        'category_id.required' => 'お問い合わせの種類を選択してください',
        'detail.required' => 'お問い合わせ内容を入力してください',
        'detail.max' => 'お問い合わせ内容をは120文字以内で力してください',
    ];
    }
}
