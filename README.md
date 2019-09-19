# www-chevalvert [<img src="https://github.com/chevalvert.png?size=100" align="right">](http://chevalvert.fr/)
_https://chevalvert.fr_

<br>

[![preview](preview.png?raw=true)](https://chevalvert.fr/)

<br>

## Development

###### Installation
```sh
$ git clone https://github.com/chevalvert/www-chevalvert
$ cd www-chevalvert
$ npm install
```

###### Usage
```sh
$ npm run start # start kirby-webpack devserver
$ npm run build # build and bundle src/ into www/assets/
```

###### Deployment
```sh
$ npm version [major|minor|patch]
```
<sup>`preversion` and `postversion` scripts will take care of building, pushing and deploying using [`git-ftp`](https://github.com/git-ftp/git-ftp).</sup>

## Credits

Built with [**kirby-webpack**](https://github.com/brocessing/kirby-webpack).

## License

[MIT](https://tldrlegal.com/license/mit-license).
