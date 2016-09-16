<?php
//アプリ側から
// http://localhost/api_sample/get_data.php?user_id=1&when=a&where=u&who=oo&detail=9uy&open_flag=0
//　という形でデータが送られてきた際に受け取るプログラム（API）

//＜疑問＞上記の例だと、getで送られてきている。実際にはpost送信でくるのでは？


//データベースに接続
  // $dsn = 'mysql:dbname=LAA0767625-acahara;host=mysql111.phy.lolipop.lan';
  // $user = 'LAA0767625';
  // $password = 'rihoriho1002';
  // $dbh = new PDO($dsn,$user,$password);
  // $dbh->query('SET NAMES utf8');

  $db = mysqli_connect('mysql111.phy.lolipop.lan','LAA0767625','rihoriho1002','LAA0767625-acahara') or die(mysqli_connect_error());
  mysqli_set_charset($db, 'utf8');

  // echo "接続";

//データベースにデータを入力する

  // 参考：echo "key1 : ".$json['key1'];


  if(isset($_POST) && !empty($_POST)){
  //   //各項目を取得(URLデコードを行う)
    $json = json_decode($_POST['json'],TRUE);
  // $date = date("Y/m/d H:i:s");
  // $json = array('userName'=>'hogeUser','time'=>'hogeTime','place'=>'hogePlace','person'=>'hoge','description'=>'hoge','university'=>'hoge','picture'=>'hoge','movie'=>'hoge','created'=>$date,'openFlag'=>0);

    //userIDとuserNameはどう処理したら良いかわからない
    
    $name = $json['userName'];

    $time = $json['time'];
    $place = $json['place'];
    $person = $json['person'];
    $description = $json['description'];
    $university = $json['university'];

    $picture = $json['picture'];//ここが配列に成る。どうしたら？
    // $strPicture = implode(',',$picture);
    // $picture = $strPicture;

    $movie = $json['movie'];
    // $strMovie = implode(',',$movie);
    // $movie = $strMovie;

    //soundはバージョンアップ
    //$sound = urldecode($_POST['sound']);　ここは要らない。

    //intをstringにして納めている、はず。これで良い？
    $created = $json['created'];
    $openFlag = $json['openFlag'];

    //getがあってaction = deleteの時みたいなのを、上に後で書く。今はpostで投稿内容が送られた時なので要らない
    //$deleteFlag = $_POST['deleteFlag']; ここは要らない。


    //！！！確認！！！
    //deleteFlagはデフォルトが入っていて、登録フォームの内容をpostする段階ではいじられないから、項目抜いて良い？

    // $sql = "INSERT INTO `posts`(`id`, `user_id`, `name`,`when`, `where`, `who`,`diary`, `university`,`picture`,`movie`,`sound`,`created`, `openFlag`) ";

    // $sql .= "VALUES (null,".$user_id.",'".$name."','".$when."','".$where."','".$who."','".$diary."','".$university."','".$picture."','".$movie."','".$sound."','".$created."','".$openFlag.")";

    $sql = sprintf('INSERT INTO `posts` SET  `name`="%s", `time`="%s", `place`="%s",`person`="%s", `description`="%s",`university`="%s",`picture`="%s",`movie`="%s",`created`=NOW(),`openFlag`=0',
        $name,
        $time,
        $place,
        $person,
        $description,
        $university,
        $picture,
        $movie
      );
    echo $sql;

    mysqli_query($db, $sql) or die(mysqli_error($db));


    // $stmt = $dbh->prepare($sql);
    // $stmt->execute();

  } 
  //データベースから切断
  // $dbh = null;


?>