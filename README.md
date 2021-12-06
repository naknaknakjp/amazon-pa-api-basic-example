# Amazon Product Advertising API基本操作サンプル
Amazon Product Advertising APIの基本操作をPHPで実装したサンプルプログラムです。

# コマンドの使い方
sample.phpファイルと同じ階層で実行してください。

## ブラウズノード情報を取得
ブラウズノードIDを指定してブラウズノード情報を取得します。  
APIはGetBrowseNodesを利用しています。  
https://webservices.amazon.com/paapi5/documentation/getbrowsenodes.html
### コマンド
```
php ./sample.php GetBrowseNodes [ブラウズノードID(カンマ区切りで複数指定可)]
```
### サンプル
```
% php ./sample.php GetBrowseNodes 13299531
% php ./sample.php GetBrowseNodes 13299531,2229202051
```

## ASINを指定して商品情報を取得
ASINを指定して商品情報を取得します。
APIはGetItemsを利用しています。  
https://webservices.amazon.com/paapi5/documentation/get-items.html
### コマンド
```
% php ./sample.php GetItems [ASIN(カンマ区切りで複数指定可)]
```
### サンプル
```
% php ./sample.php GetItems B00FBWBM3G
% php ./sample.php GetItems B00FBWBM3G,B07BB4FDLG
```


## ASINを指定してバリエーション違いの商品情報を取得
ASINを指定して カラーやサイズの違いなどバリエーション違いの商品を取得します。
APIはGetVariationsを利用しています。
### コマンド
```
php ./sample.php GetVariations [ASIN]
```

### サンプル
```
% php ./sample.php GetVariations B00RF33PFM
```



## キーワードを指定して商品情報を検索
キーワードを指定して商品検索を行い、マッチする商品情報を取得します。  
検索対象は指定したSearch Indexに関連する商品となります。  
Search IndexはAPIに仕様上省略することができません。  
キーワード以外にもアーティスト名、ブランド名などいろいろな条件を指定出来ますが、本サンプルではキーワード指定のみとします。  
APIはSearchItemsを利用しています。
### コマンド
```
% php ./sample.php SearchItems [キーワード] [Search Index]
```
### サンプル
```
% php ./sample.php SearchItems すみっコぐらし Toys
```

### Search Indexについて
Search Indexは以下のTopicsに列挙されているリンクから選ぶことができます。
https://webservices.amazon.com/paapi5/documentation/locale-reference.html
