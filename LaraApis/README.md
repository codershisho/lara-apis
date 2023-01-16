# 本プロジェクトに関して
- 各プロジェクトで使用するAPI群をフォルダ別で集約する

## 導入しているサービス
- nuxt-schedule（作成中）

## 備忘用コマンド

### モデルとマイグレーション
- php artisan make:model Models/MMember --migration

### APIコントローラー
- php artisan make:controller Apis/Sample/SampleApi

### DB切り替え時のマイグレーション
https://qiita.com/aceimpact/items/51773458a351c8c9d456
https://tech.adseed.co.jp/Laravel%20migration%20file%20migrate%20artisan

#### 特定フォルダにマイグレーション
```
php artisan make:migration create_m_projects_table --path=database/migrations/nuxtSchedule
```
#### 特定フォルダマイグレーション
```
php artisan migrate --path=database/migrations/nuxtSchedule --database=nuxt-schedule
```
