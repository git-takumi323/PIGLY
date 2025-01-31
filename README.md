# PIGLY

## 環境構築

git clone リポジトリ
cd src
cp .env.example .env DB 修正　 docker-compose.yml 参照
docker-compose up --build -d
docker-compose exec php bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed --class=WeightLogsTableSeeder

## 実行環境

Laravel Framework 8.83.29
PHP 7.4.9
mysql Ver 9.0.1 for macos14.4 on x86_64 (Homebrew)
nginx:1.21.1

## データベース設計

Pigly/データベース設計参照

## URL

開発環境:http://localhost/
トップページ(管理画面):/weight_logs
体重登録:/weight_logs/create
体重検索:/weight_logs/search
体重詳細:/weight_logs/{:weightLogId}
体重更新:/weight_logs/{:weightLogId}/update
体重削除:/weight_logs/{:weightLogId}/delete
目標設定:/wight_logs/goal_setting
会員登録:/register/step1
初期目標体重登録:/register/step2
ログイン:/login
ログアウト:/logout
