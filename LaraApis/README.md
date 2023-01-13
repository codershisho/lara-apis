## コマンド

### モデルとマイグレーション
- php artisan make:model Models/MMember --migration

### APIコントローラー
- php artisan make:controller Apis/Sample/SampleApi

### DB切り替え時のマイグレーション
https://qiita.com/aceimpact/items/51773458a351c8c9d456
https://tech.adseed.co.jp/Laravel%20migration%20file%20migrate%20artisan

php artisan migrate --path=database/migrations/nuxtSchedule --database=nuxt-schedule

php artisan make:migration create_m_projects_table --path=database/migrations/nuxtSchedule