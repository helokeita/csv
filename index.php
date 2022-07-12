<?php

// 変数
$keys = ['商品ID','商品名','金額','在庫'];
$csvArray = array();
$count = 0;


// CSVを取得
// ファイルを読み込む
require_once('class/csv.php');
// インスタンス化
$csvread_obj = new csv("csv/item.csv","r");
// データを取得
$csvArray = $csvread_obj->getalldata();


// テンプレートエンジンクラス
require_once('class/templete.php');

// インスタンス化
$templete_file = new templete('index.html.twig');

// htmlに渡すデータ
$data = array(
    'title' => 'csv商品管理',
    'message'  => '商品一覧',
    'csvArray' => $csvArray
);

$templete_file->dataset($data);

$templete_file->display();

?>