@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection


@section('header')
<form class="form" action="/logout" method="post">
     @csrf
     <button class="form__button-submit" type="submit">logout</button>
</form>
@endsection

@section('content')
<div class="admin-form__content">
 <div class="admin-form__heading">
     <h2 class="admin-form__logo">Admin</h2>
 </div>
 <div class="search-form">
     <div class="search-form__content">
         <form class="search-form__item" action="/search" method="get">
             <input class="search-form__item-input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください" />
             <div class="select-wrapper">
                 <select class="search-form__item-select" name="gender">
                     <option value="" disabled selected>選択してください</option>
                     <option value="1"{{ request('gender')==1?'selected':'' }} >男性</option>
                     <option value="2"{{ request('gender')==2?'selected':'' }} >女性</option>
                     <option value="3"{{ request('gender')==3?'selected':'' }} >その他</option>
                     <option value="4"{{ request('gender')==4?'selected':'' }}>全て</option>
                 </select>
             </div>
             <div class="select-wrapper">
                 <select class="search-form__item-select" name="category_id">
                     <option value="" disabled selected>お問い合わせの種類</option>
                     @foreach ($categories as $category)
                         <option value="{{ $category['id'] }}"
                         {{ request('category_id') == $category['id'] ? 'selected' : '' }}>
                             {{ $category['content'] }}
                         </option>
                     @endforeach
                 </select>
             </div>
             <div class="calendar-wrapper">
                 <input class="search-form__item-calendar"type="date" id="birthdate" name="birthdate" value="{{ request('birthdate') }}">
              </div>
             <div class="search-form__button">
                 <button class="search-form__button-submit" type="submit">検索</button>
             </div>
         </form>
         <form class="resset-form__button" action="/reset" method="post">
            @csrf
             <button class="resset-form__button-submit" type="submit">リセット</button>
         </form>
     </div>


 </div>
 <div class="export-content">
     <div class="export-content">
         <form action="/export" method="get">
             <input type="hidden" name="keyword" value="{{ request('keyword') }}">
             <input type="hidden" name="gender" value="{{ request('gender') }}">
             <input type="hidden" name="category_id" value="{{ request('category_id') }}">
             <input type="hidden" name="birthdate" value="{{ request('birthdate') }}">
             <button type="submit" class="export-form__botton__submit">エクスポート</button>
         </form>
     </div>
     <div class="pagination">
        {{ $contacts->links('pagination::bootstrap-4') }} 
     </div>
 </div>
 <div class="contact-table">
     <table class="contact-table__inner">
         <tr class="contact-table__row">
             <th class="contact-table__header">お名前</th>
             <th class="contact-table__header">性別</th>
             <th class="contact-table__header">メールアドレス</th> 
             <th class="contact-table__header">お問い合わせの種類</th>
             <th class="contact-table__header"></th>  
          </tr>
          @foreach ($contacts as $contact)
          <tr class="contact-table__row">
             <td class="contact-table__item">{{ $contact['last_name'] }}　{{ $contact['first_name'] }}</td>
             <td class="contact-table__item">
                 @php
                     $genderLabels = [
                     1 => '男性',
                     2 => '女性',
                     3 => 'その他',
                     ];
                 @endphp
                 {{ $genderLabels[$contact['gender']]}}</td>
             <td class="contact-table__item">{{ $contact['email'] }}</td>
             <td class="contact-table__item">{{ $contact['category']['content'] }}</td>
             <td class="contact-table__item" >
                  <!-- モーダルリンク -->
                 <a href="#modal-{{ $contact['id'] }}" class="detail-button">詳細</a>
              </td>
                 <div id="modal-{{ $contact['id'] }}" class="modal">
                     <div class="modal-content">
                         <a href="#" class="close">&times;</a>
                         <p class=modal-content__item><strong class="modal-content__lavel">お名前</strong>
                         <span class="modal-content__value"> {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                         </span>
                         </p>
                         <p class=modal-content__item><strong class="modal-content__lavel">性別</strong> 
                         <span class="modal-content__value">
                             {{ $genderLabels[$contact['gender']] }}
                         </span>
                         </p>
                         <p class=modal-content__item><strong class="modal-content__lavel">メールアドレス</strong>
                         <span class="modal-content__value">
                             {{ $contact['email'] }}
                            </span>
                         </p>
                         <p class=modal-content__item><strong class="modal-content__lavel">電話番号</strong>
                         <span class="modal-content__value">
                             {{ $contact['tel'] }}
                            </span>
                         </p>
                         <p class=modal-content__item><strong class="modal-content__lavel">住所</strong>
                         <span class="modal-content__value">
                             {{ $contact['address'] }}
                            </span>
                         </p>
                         <p class=modal-content__item><strong class="modal-content__lavel">建物名</strong>
                         <span class="modal-content__value">
                             {{ $contact['building'] }}
                            </span>
                         </p>
                         <p class=modal-content__item><strong class="modal-content__lavel">お問い合わせの種類</strong>
                         <span class="modal-content__value">
                             {{ $contact['category']['content'] }}
                            </span>
                         </p>
                         <p class=modal-content__item><strong class="modal-content__lavel">内容</strong> 
                         <span class="modal-content__value">
                             {{ $contact['detail'] ?? 'なし' }}
                         </span>
                         </p>
                         <p class=modal-content__item><strong class="modal-content__lavel">作成日</strong>
                         <span class="modal-content__value">
                             {{ $contact['created_at'] }}
                            </span>
                         </p>
                         <form action="/delete" method="POST">
                         @csrf
                         @method('DELETE')
                          <input type="hidden" name="id" value="{{ $contact->id }}">
                         <button type="submit" class="modal-content__delete">削除</button>
                         </form>
                     </div>
                 </div>
          </tr>
          @endforeach
        </table>
   </div>
</div>

@endsection