<?php
session_start();

$csvArray = array();
$selectArray = array();


$id =$_GET['id'];

$_SESSION['before_id'] = $id;

unset($_GET['id']);


// CSVを取得
// ファイルを読み込む
require_once('class/csv.php');
// インスタンス化
$csvread_obj = new csv("csv/item.csv","r");

$csvArray = $csvread_obj->getalldata();

$selectArray = $csvread_obj ->selectdata($csvArray,$id);





// テンプレートエンジンクラス
require_once('class/templete.php');

// インスタンス化
$templete_file = new templete('edit.html.twig');

// htmlに渡すデータ
$data = array(
    'title' => 'csv商品管理',
    'message'  => '商品編集',
    'csvArray' => $selectArray
);

$templete_file->dataset($data);

$templete_file->display();


?>