！　アプリケーション「Your Songs」がPHP/Laravel+Nuxt.jsの構成であったときのPHP/Laravelソースコード


## Your Songs

自分のおすすめの曲を紹介できるサービスです。<br>
url: http://your-songs-laravel.site/

<a href="http://your-songs-laravel.site/"><img src="https://i.gyazo.com/5054aaad1afba85e1a2b3ad3830cc268.png" alt="Image from Gyazo" width="1440"/></a>

## 使用技術
* PHP
* Laravel
* MySQL
* SCSS
* Bootstrap
* Vue.js
* Docker
* docker-compose
* AWS
    * VPC
    * EC2
    * Route53
    * RDS for MySQL
    * S3
* CircleCI

## 本番環境
<a href="https://gyazo.com/0dbe34d3312e2140ef8ffe47b9940896"><img src="https://i.gyazo.com/0dbe34d3312e2140ef8ffe47b9940896.png" alt="Image from Gyazo" width="718"/></a>

データベースにはRDS for MySQLを用いています。
画像は全てS3に保存しています。

## 開発環境
Docker環境での開発になります。
また、開発時にはdocker-composeを使用しています。
開発環境では作業ごとにブランチを切って行っています。

## 機能一覧
* 曲機能(songモデル)
* 曲機能全般
* ユーザ機能(userモデル)
* ユーザ登録・ログイン機能全般
* Githubでのログイン機能
* 曲検索機能（新着順・お気に入り数順・コメント数順で並び替え可）
* 曲のレコメンド機能（vue-carousel）
* ユーザー検索機能
* ユーザーのレコメンド機能（vue-carousel）
* タイムライン（フォローしているユーザーの投稿した曲一覧を表示）
* プロフィール画像の保存機能（S3）
* コメント機能(commentモデル)
* 投稿、削除、表示
* フォロー機能
* フォロー、アンフォロー機能
* フォロー中のユーザー&フォロワーの表示
* お気に入り機能
* お気に入りした曲の表示
* 管理者権限機能（曲の削除、完全削除、回復）
* ページネーション機能

## テスト
単体テスト(PHPUnit)
（記述を作成・修正中です。）

## 改善中・実装中の箇所
* ECS,ECRを設定してCI/CDパイプライン実装
* ALBを設定し常時SSL化の実現
* S3からCloudFrontでCDN配信
＊ SPAの実装
* テストコードの完成 
