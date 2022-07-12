<?php
session_start();

$error_message = '';

//確認画面からエラーが帰った時の処理
if(!empty($_SESSION['error_message'])){
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

// テンプレートエンジンクラス
require_once('class/templete.php');

// インスタンス化
$templete_file = new templete('add.html.twig');

// htmlに渡すデータ
$data = array(
    'title' => 'csv商品管理',
    'message'  => '商品追加',
    'error' => $error_message
);

$templete_file->dataset($data);

$templete_file->display();

?>