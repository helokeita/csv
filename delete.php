<?php
session_start();

$id =$_GET['id'];
unset($_GET['id']);


// CSVを取得
// ファイルを読み込む
require_once('class/csv.php');
// インスタンス化
$csvread_obj = new csv("csv/item.csv","r");

$del_id = $id - 1; 
$csvread_obj -> delete($del_id);

header('Location:index.php');
exit;

?>