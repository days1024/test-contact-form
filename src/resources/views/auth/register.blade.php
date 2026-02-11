@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header')
<a href="{{ route('login') }}" class="form__button-submit">
    login
</a>
@endsection

@section('content')
<div class="register-form">
 <div class="register-form__content">
     <div class="register-form__heading">
         <h2 class="register-form__logo">Register</h2>
     </div>
     <form class="form"  action="/register" method="post"  novalidate>
         @csrf
         <div class="form__group">
             <div class="form__group-title">
                 <span class="form__label--item">お名前</span>
             </div>
             <div class="form__group-content">
                 <div class="form__input--text">
                     <input type="text" name="name"  value="{{ old('name') }}" placeholder="山田太郎" />
                      <div class="form__error">
                         @error('name')
                             {{ $message }}
                         @enderror
                     </div>
                 </div>
             </div>
             <div class="form__group-title">
                 <span class="form__label--item">メールアドレス</span>
             </div>
             <div class="form__group-content">
                 <div class="form__input--text">
                     <input type="email" name="email"  value="{{ old('email') }}" placeholder="test@example.com" />
                     <div class="form__error">
                         @error('email')
                             {{ $message }}
                         @enderror
                     </div>
                 </div>
             </div>
             <div class="form__group-title">
                 <span class="form__label--item">パスワード</span>
             </div>
             <div class="form__group-content">
                 <div class="form__input--text">
                     <input type="password" name="password"  value="{{ old('password') }}" placeholder="パスワード" />
                     <div class="form__error">
                         @error('password')
                             {{ $message }}
                         @enderror
                     </div>
                 </div>
             </div>
         </div>
         <div class="form__button">
             <button class="form__button-register" type="submit">登録</button>
            </div>
     </form>
 </div>
</div>
@endsection