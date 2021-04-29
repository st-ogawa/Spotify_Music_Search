# Music Search　



SpotifyAPIを利用した楽曲検索サイトです。<br/>
お気に入りの楽曲を見つけたらお気に入り登録ができて、楽曲の詳細ページに飛ぶことができます。
　
***


## Demo

![musicsearch](https://user-images.githubusercontent.com/75051280/116493239-41308300-a8d9-11eb-876e-03a578ca9bcc.gif)


## Dependency

```
laravel: 6.*
laravel/passport: 9.*
laravel/ui: 1.0
axios: 0.19
vue: 2.*
vuex : 3.6.2
vue-router :3.5.1
vuejs-paginate : 2.1.0
```


## Setup

```

$ git clone https://github.com/B-FORME/Spotify_Ogawa.git
↓
$ npm install
↓
$ composer install
↓
$ cp .env.example .env
↓
$ php artisan key:generate
↓
$ php atisan serve
↓
$ npm run dev

```

## Setting

spotifyダッシュボードからClient_IDとClient_Secretを取得してください.
https://developer.spotify.com/dashboard/<br>

取得したキーを`./resources/js/setting/setting.js`に以下のように設置してください。

```
const CLIENT_ID = "";

const CLIENT_SECRET ="";

export default { CLIENT_ID, CLIENT_SECRET}
```

## License

[MIT](/LICENSE)