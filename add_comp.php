<?php
session_start();

$id = $_GET['id'];
$name = $_GET['name'];
$price = $_GET['price'];
$stock = $_GET['stock'];


if ( empty( $id ) || empty( $name ) || empty( $price ) || empty( $stock )) {
    $_SESSION['error_message'] = '入力されていない項目があります';
    header('Location:add.php');
    exit;
}else{
    
    unset( $_GET['id'] );
    unset( $_GET['name'] );
    unset( $_GET['price'] );
    unset( $_GET['stock'] );


    // CSVを取得
    // ファイルを読み込む
    require_once('class/csv.php');
    // インスタンス化
    $csvread_obj = new csv("csv/item.csv","a+");

    $csvread_obj->add($id,$name,$price,$stock);
	// 表示画面にリダイレクト
    header('Location:index.php');
    exit;
}

?>