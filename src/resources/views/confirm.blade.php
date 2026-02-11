@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
 <div class="confirm__heading">
   <h2 class="confirm__logo">Confirm</h2>
 </div>
 <form class="form" action="/thanks" method="post">
  @csrf
     <table class="confirm-table__inner" >
       <tr class="confirm-table__row">
         <th class="confirm-table__header">お名前</th>
         <td class="confirm-table__name">
           <span class="confirm-table__name-item">
           {{ $contact['last_name'] }}
           </span>
           <span class="confirm-table__name-item">
             {{ $contact['first_name'] }}
            </span>
           <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" readonly />
           <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" readonly />
         </td>
        </tr>
       <tr class="confirm-table__row">
         <th class="confirm-table__header">性別</th>
         <td class="confirm-table__text">
           @php
             $genderLabels = [
             1 => '男性',
             2 => '女性',
             3 => 'その他',
             ];
            @endphp
            <span class="confirm-table__gender-item">
            {{ $genderLabels[$contact['gender']]}}
            </span>
           <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
         </td>
        </tr>
       <tr class="confirm-table__row">
         <th class="confirm-table__header">メールアドレス</th>
         <td class="confirm-table__text">
           <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
         </td>
        </tr>
       <tr class="confirm-table__row">
         <th class="confirm-table__header">電話番号</th>
         <td class="confirm-table__text">
           <span class="confirm-table__tel-item">
             {{ $contact['tel_display'] }}
            </span>
           <input type="hidden" name="tel[]" value="{{ $contact['tel'][0] }}" />
           <input type="hidden" name="tel[]" value="{{ $contact['tel'][1] }}" />
           <input type="hidden" name="tel[]" value="{{ $contact['tel'][2] }}" />
         </td>
        </tr>
       <tr class="confirm-table__row">
         <th class="confirm-table__header">住所</th>
         <td class="confirm-table__text">
           <input type="text" name="address" value="{{ $contact['address'] }}"readonly />
         </td>
        </tr>
       <tr class="confirm-table__row">
         <th class="confirm-table__header">建物名</th>
         <td class="confirm-table__text">
           <input type="text" name="building" value="{{ $contact['building'] }}" readonly/>
         </td>
        </tr>
       <tr class="confirm-table__row">
         <th class="confirm-table__header">お問い合わせの種類</th>
         <td class="confirm-table__text">
          <span class="confirm-table__category_id-item">
             {{ $categories[$contact['category_id']] }}
           </span>
           <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}"/>
         </td>
        </tr>
       <tr class="confirm-table__row">
         <th class="confirm-table__header">お問い合わせ内容</th>
         <td class="confirm-table__text">
           <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly/>
         </td>
        </tr>
     </table>
    </div>
    <div class="form__button">
       <button class="form__button-submit" name="action" 
        value="send" type="submit">送信</button>
       <button class="form__button-edit" name="action"  value="back" type="submit">修正</button>
    </div>
  </form>
</div>
 @endsection