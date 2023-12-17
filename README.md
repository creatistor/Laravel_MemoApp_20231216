## アプリ起動のために下記手順を実施

1. コマンドから入力
### `git clone https://github.com/creatistor/Laravel_MemoApp_20231216.git`
### `cd Laravel_MemoApp_20231216`
### `composer install`
### `npm install`
### `php artisan key:generate`
### `npm run dev`
### `php artisan serve`

2. .env.example ファイルをコピーして名称を .env に変更して同ディレクトリ上に保存する
3. XAMPPを起動する
4. MySQLの[Admin]を押下
5. 左サイドメニューの[新規作成]を押下
6. [データベース名]を[laravel],右側のプルダウンは[utf8mb4_general_ci] を選択して[作成]を押下する

7. Laravel_MemoApp_20231216内で下記コマンドを実行(データベースにmigrationを行う)
### `php artisan migrate`
