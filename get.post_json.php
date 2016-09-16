<?php

  //データベースに接続
  $dsn = 'mysql:dbname=LAA0767625-acahara;host=mysql111.phy.lolipop.lan';
  $user = 'LAA0767625';
  $password = 'rihoriho1002';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');


  //postsのうち削除されていないものを全件取得して$posts[]に収める

  $sql = 'SELECT * FROM `posts` WHERE `deleteFlag` = 0 ORDER BY `created` DESC';
  
  //SELECT文実行
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  //格納する変数の初期化　
  $posts = array();

  while(1){

    //実行結果として得られたデータを取得
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec == false){
      break;
    }
    // var_dump($rec);
    // jsonにする際 (PHP)
    // , 区切りでDBにはいっている写真データ文字列を、配列データにする
    // 配列=explode(分解文字列,文字列,[要素数]) 要素数いらない
    $pictureArray = explode(':', $rec['picture']);
    $rec['picture'] = $pictureArray;

    $movieArray = explode(',',$rec['movie']);
    $rec['movie'] = $movieArray;



    // 取得したデータを配列に格納しておく
    $posts[] = $rec;
  }
  // var_dump($posts);


  //データベースから切断
  $dbh = null;


  //$posts[]をjson形式で出力表示
  //これはどう変えたら？ やり方がわからない
  //ここでサニタイズなどの処理をする？$postsの後あたり
  $jsonData = json_encode( $posts );
  echo $jsonData;

?>



