@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header')
     <div>
         <a  class="form__button-submit" href="{{ route('register') }}" >
          register
         </a>
     </div>
@endsection

@section('content')
<div class="login-form">
 <div class="login-form__content">
     <div class="login-form__heading">
         <h2 class="login-form__logo">Login</h2>
     </div>
     <form class="form" action="/login" method="post">
        @csrf
         <div class="form__group">
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
             <button class="form__button-login" type="submit">ログイン</button>
            </div>
     </form>
 </div>
</div>
@endsection