<?php

//データベースに接続
  $dsn = 'mysql:dbname=api_sample;host=localhost';
  $user = 'root';
  $password = 'rihoriho1002';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');


	if (isset($_POST) && !empty($_POST)){

		//渡ってきたjsonデータをデコードする 
		//2つの辞書配列データ’openFlag’,’id’が取れる
	    $json = json_decode($_POST['json'],TRUE);
  
  		// echo "key1 : ".$json['key1']; 参考に

	    // Update文
	    //ここの書き方がわからない！！！！
	    $changeModesql = sprintf('UPDATE `posts` SET `openFlag` = %s WHERE `id` = %s;',$json['openFlag'],$json['id']);

	    //DELETE文実行
	    $stmt = $dbh->prepare($deletesql);
	    $stmt->execute();

	}

//データベースから切断
  $dbh = null;


?>
