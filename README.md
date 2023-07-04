# ヒヤリハットを社内周知するシステムです

　WEB上で、ヒヤリハットの内容や対応策を文章や写真を使った掲示板形式で周知・共有できるシステムです。

　(ヒヤリハットとは、重大な災害や事故に直結する一歩手前の出来事のことで、

　思いがけない出来事に「ヒヤリ」としたり、事故寸前のミスに「ハッ」としたりしたことを書き込みます。)

　レスポンシブ対応となっていますので、スマホやタブレットからも利用可能です。
 
　
## 本システムの特徴
- **本システム開発の顧客モデル**
 
    - 工場のある中小企業で部署同士が離れていても危機管理を共有する必要があり、今まで紙面での提出だったものをWebに切り替えるという想定で作成しました。
 
 - **工夫した点**
    - アカウントの管理は、管理職員として登録された人のみが行えるようにしました。
    - 投稿の編集は、投稿者か管理職員のみ編集が可能にしました。
    - ユーザーアカウントを削除しても投稿自体は残ります。
    - 端末をあまり使わない人でも分かりやすいようにできるだけ簡略化しています。


## 使用までの流れ
    - GitHubからインストール
    　↓
    - composer install
    　↓
    - .envファイルの作成
    　↓
    - php artisan key:genetrate
    　↓
    - php artisan migrate
    　↓
    - php artisan db:seed
    　↓
    - npm install
    　↓
    - npm run dev


## 機能一覧
- **一般社員画面側**
    - ログイン
    - 投稿の一覧表示
        - 対応済・対応求ムのフィルタリング可能
    - 投稿の個別表示
        - 投稿者のみ、投稿の編集・削除が可能
    - 新規投稿の作成


- **管理職員画面側**
    - ログイン
    - 投稿の一覧表示
        - 対応済・対応求ムのフィルタリング可能
    - 投稿の個別表示
        - 投稿の編集・削除
    - 新規投稿の作成
    - 社員一覧
        - 社員情報の検索
        - 社員情報の編集・削除
    - 社員の新規登録
 
## 設計書

　ポートフォリオの作成にあたり、要件設計・画面詳細・テーブル定義書などを作成しております。
 
 　**[こちらのリンクから、ご覧いただけます。](doc)**

## 実装環境

　バックエンド　： Laravel10  , MySQL

　フロントエンド： HTML・CSS, Tailwind CSS v2.0
 
