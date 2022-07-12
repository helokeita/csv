<?php
session_start();

$id = $_GET['id'];
$name = $_GET['name'];
$price = $_GET['price'];
$stock = $_GET['stock'];

$before_id = $_SESSION['before_id'];


if ( empty( $id ) || empty( $name ) || empty( $price ) || empty( $stock )) {
    $_SESSION['error_message'] = '入力されていない項目があります';
    header('Location:edit.php');
    exit;
}else{
    
    unset( $_SESSION['id'] );
    unset( $_SESSION['name'] );
    unset( $_SESSION['price'] );
    unset( $_SESSION['stock'] );
    unset( $_SESSION['before_id'] );


    // CSVを取得
    // ファイルを読み込む
    require_once('class/csv.php');
    // インスタンス化
    $csvread_obj = new csv("csv/item.csv","r+");

    $csvread_obj ->setid($id);
    $csvread_obj ->setname($name);
    $csvread_obj ->setprice($price);
    $csvread_obj ->setstock($stock);

    // $csvArray = $csvread_obj->getalldata();

    // $selectArray = $csvread_obj ->selectdata($csvArray,$before_id);

    $edit_id = $id -1;
    $csvread_obj ->edit($edit_id);
    
    
    header('Location:index.php');
    exit;
}

?>