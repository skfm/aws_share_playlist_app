![SPY](https://user-images.githubusercontent.com/44170627/99727163-e8271c80-2afa-11eb-8922-ca297f8c99f2.png)

# SPY(Share Playlist Youtube)
「SYP」はYouTubeで作成したプレイリストを共有するサイトです。
プレイリストはYouTubeで為になった複数の動画をジャンルごとにまとめて共有できるサービスです。
しかしあまり利用されていないと思い、それ専用の共有サイトを作成しました。
またYouTubeの検索アルゴリズムに引っかかりづらい優良動画を広める目的も兼ねて制作しました。

## 本番環境　テストユーザー
- TOPページ： [https://spyknwledge.com/](URL "https://spyknwledge.com/")
- ログインページ： [https://spyknwledge.com/login](URL "https://spyknwledge.com/login")
- メールアドレス：test@test.com
- パスワード：12345678

## SPYのターゲット
- プログラミング、筋トレ、ダイエットなどの情報を調べているユーザー
- 自分が使用してみてよかった体験などをたくさんの人に伝えたいユーザー

## SPYの効果
- ダイエットなどで実際におこない効果があった動画などを調べることができる
- 検索アルゴリズムで上位に入っていないが優良な動画を見つけられる可能性が上がる
- YouTubeのプレイリストの利用率向上

## 使用技術
- HTML
- CSS(scss,MDBootstrap)
- JavaScript(jQuery、Vue)
- PHP7.3(Laravel7.27.0)
- nginx
- MYSQL 5.7
- AWS S3
- AWS EC2
- AWS Route53
- Docker(Laradock)

## ER図
![er](https://user-images.githubusercontent.com/44170627/103448817-2a3ea300-4ce2-11eb-9679-b0fb3d45a6aa.png)


## 実装機能(抜粋)
以下にSPYで実装した機能をお伝えします。

### プレイリスト投稿機能

![記事投稿](https://user-images.githubusercontent.com/44170627/103450905-6680fc00-4d00-11eb-9dbb-a0b69507a163.png)

ヘッダー部分の「投稿する」からYouTubeのプレイリストを投稿します。
投稿プレイリストにはタグを5つまで選択できます。
またカテゴリーを選んで投稿することも可能です。

### ユーザー情報登録機能

![ユーザー編集](https://user-images.githubusercontent.com/44170627/99728482-d5ade280-2afc-11eb-9965-86daaf7eeecf.png)

ユーザー情報はヘッダーの「プロフィール編集」から登録が可能です。
名前、紹介文、主要なSNSをやっているユーザーはSNSを登録できます。

ユーザーページで下記のように表示されます。

![ユーザーページ](https://user-images.githubusercontent.com/44170627/99728493-d9da0000-2afc-11eb-855c-06dbed450094.png)

### 検索機能

![検索](https://user-images.githubusercontent.com/44170627/99729066-b95e7580-2afd-11eb-84f4-9a4e962a8713.png)

タグとタイトルから部分一致での検索ができます。

### ストック機能とストックしたプレイリストのフォルダ分け機能

![ストックフォルダー詳細](https://user-images.githubusercontent.com/44170627/103450904-5ec15780-4d00-11eb-9d48-ff116753831b.png)

投稿されているプレイリスト内のアイコン(上記画像の赤枠部分)を
クリックすることでプレイリストの保存が可能です。

ストックしたプレイリストはユーザーページから確認できます。
またフォルダを作成し、ストックしたプレイリストにフォルダを割り当てることで
ユーザー任意のカテゴリー別にプレイリストを確認することも可能となります。

### ランキング機能

![人気順](https://user-images.githubusercontent.com/44170627/99730645-2a069180-2b00-11eb-8688-4e08f965190e.png)

TOPページの人気のプレイリスト部分はストックされた数が
多いプレイリスト順に表示されるようしています。

### 並び替え機能

![並び替え](https://user-images.githubusercontent.com/44170627/99731065-b3b65f00-2b00-11eb-86aa-888c25ab3faa.png)

カテゴリー一覧ページ、タグまたはタイトル検索結果一覧ページ内では
プレイリストを並び替えることができます。
並び替えは「ストックのされた数が多い順、投稿日が新しい順、投稿日が古い順です。



