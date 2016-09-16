<?php

//データベースに接続
  $dsn = 'mysql:dbname=api_sample;host=localhost';
  $user = 'root';
  $password = 'rihoriho1002';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');


	if (isset($_POST) && !empty($_POST)){
	    //$deletesql = sprintf('DELETE FROM `posts` WHERE `id`=%s',$_GET['id']);

	    // 論理削除に変更
	    // Update文
	    $deletesql = sprintf('UPDATE `posts` SET `deleteFlag` = 1 WHERE `id` = %s;',$_POST['id']);

	    //DELETE文実行
	    $stmt = $dbh->prepare($deletesql);
	    $stmt->execute();

	}

//データベースから切断
  $dbh = null;

?>