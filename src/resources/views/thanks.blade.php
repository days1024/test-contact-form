<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">



<main>
 <div class="background-text">
     Thank you
 </div>
 <div class="thanks__content">
      <div class="thanks__heading">
          <h2>お問い合わせありがとうございました</h2>
          <form class="form" action="/" method="get">
            @csrf
             <div class="form__button">
                 <button class="form__button-submit" type="submit">HOME</button>
             </div>
          </form>
      </div>
 </div>  
</main>
</body>

</html>