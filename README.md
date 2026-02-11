#　環境構築

##　Dockerビルド
- https://github.com/days1024/test-contact-form.git
- docker-compose up -d --build

##　Laravel環境構築
- docker-compose exec php bash
- composer install
- cp .env.example .env ,環境変数を適宜変更
- php artisan key:generate
- php artisan migrate
- php artisan db:seed


## 開発環境
- お問い合わせフォーム入力ページ: http://localhost/
- お問い合わせフォーム確認ページ  http://localhost/confirm
- サンクスページ  http://localhost/thanks
- お問い合わせ管理画面: http://localhost/admin
- 管理画面ユーザー登録: http://localhost/register
- 管理画面ユーザーログイン: http://localhost/login
- phpMyAdmin: http://localhost:8080/

#　使用技術

- PHP: 8.5.1/8.1.34
- Composer 2.9.3
- Docker version 29.1.3
- MySQL 8.0.26
- nginx:1.21.1
- Laravel: 8.83.29

# ER図

![ER図](src/resources/app/er.png)