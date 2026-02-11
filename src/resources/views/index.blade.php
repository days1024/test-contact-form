@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
 <div class="contact-form__heading">
   <h2 class="contact-form__logo">Contact</h2>
 </div>
 <form class="form" action="/confirm" method="post" novalidate>
   @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お名前</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content form__group--name">
        <div class="form__input--text form__input--name">
          <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="(例)山田"/>
         <div class="form__error">
              @error('last_name')
                {{ $message }}
              @enderror
         </div>
       </div>
        <div class="form__input--text form__input--name">
          <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="(例)太郎"/>
         <div class="form__error">
            @error('first_name')
             {{ $message }}
            @enderror
         </div>
       </div>
      </div> 
   </div>
   <div class="form__group">
      <div class="form__group-title">
       <span class="form__label--item">性別</span>
       <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__gender-radio">
          <label>
           <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>男性
          </label>
          <label>
           <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>女性
          </label>
          <label>
           <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>その他
          </label>
         <div class="form__error">
             @error('gender')
               {{ $message }}
             @enderror
         </div>
        </div>
      </div> 
    </div>
    <div class="form__group">
      <div class="form__group-title">
       <span class="form__label--item">メールアドレス</span>
       <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text form__input--email">
          <input type="email" name="email"  value="{{ old('email') }}" placeholder="test@example.com" />
       </div>
       <div class="form__error">
           @error('email')
             {{ $message }}
           @enderror
       </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
       <span class="form__label--item">電話番号</span>
       <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content--tel">
       <div class="form__group-content form__group--tel">
        <div class="form__input--text form__input--tel">
          <input type="tel" name="tel[]"  value="{{old('tel.0') }}" placeholder="080" />
       </div>
       <div class="form__input--hyphen">
         -
       </div>
       <div class="form__input--text form__input--tel">
          <input type="tel" name="tel[]" value="{{ old('tel.1') }}" placeholder="1234" />
       </div>
       <div class="form__input--hyphen">
         -
       </div>
       <div class="form__input--text form__input--tel">
          <input type="tel" name="tel[]"  value="{{old('tel.2') }}" placeholder="5678" />
       </div> 
     </div>
     <div class="form__error">
        @if ($errors->get('tel.*'))
          <p >
           {{ $errors->first('tel.*') }}
          </p>
        @endif
     </div>
     </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
       <span class="form__label--item">住所</span>
       <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text form__input--address">
          <input type="text" name="address" value="{{ old('address') }}" placeholder="東京都" />
       </div>
       <div class="form__error">
          @error('address')
            {{ $message }}
          @enderror
       </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
       <span class="form__label--item">建物名</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text form__input--building">
          <input type="text" name="building" value="{{ old('building') }}" placeholder="マンション〇〇" />
       </div>
       <div class="form__error">
       </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
       <span class="form__label--item">お問い合わせの種類</span>
       <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="contect-form__item select-wrapper">
           <select  class="contect-form__item-select" name="category_id">
             <option value="" disabled {{ old('category_id') === null ? 'selected' : '' }}>選択してください</option>
               @foreach($categories as $id => $content)
               <option value="{{ $id }}" @selected(old('category_id') == $id)>
                 {{ $content }}
                </option>
             @endforeach
            </select>
       </div>
       <div class="form__error">
          @error('category_id')
           {{ $message }}
          @enderror
       </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
       <span class="form__label--item">お問い合わせ内容</span>
       <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__textarea--text form__textarea--detail">
          <textarea type="text" name="detail"  placeholder="お問い合わせ内容をご記入ください">{{ old('detail') }}</textarea>
       </div>
       <div class="form__error">
          @error('detail')
           {{ $message }}
          @enderror
       </div>
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
 </form>
</div>

@endsection

