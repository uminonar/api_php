<?php

//データベースに接続
  $dsn = 'mysql:dbname=api_sample;host=localhost';
  $user = 'root';
  $password = 'rihoriho1002';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');


//データベースにデータを入力する
//各項目を取得(URLデコードを行う)

  if(isset($_POST) && !empty($_POST)){

    $json = json_decode($_POST['json'],TRUE);

    $userName = $json['userName'];
    $sentToMail = $json['sentToEmail'];
    // $confirmMail = $json['confirmMail']; これはいらない
    $contactMail = $json['contactMail'];
    $selfee = $json['selfURL'];

    //　下記はSNSにするときの設定、今回はなし
    // $introduction = urldecode($_POST['introduction']);
    
    $sql = "INSERT INTO `user`(`id`, `name`,`email_set`,`contactMail`,`selfee`) ";

    //書き方、特にnullのあたり間違ってない？
    $sql .= "VALUES (null,'".$userName."','".$sentToMail."','".$contactMail."','".$selfee."', null)";

    //上記のidの箇所は、autoincrementで設定しているのでそもそもid項目を抜いても大丈夫）

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    
  }
  //データベースから切断
  $dbh = null;

?>














