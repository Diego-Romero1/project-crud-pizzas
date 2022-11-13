<?php
session_start();
if($_SESSION['logueado']){
    include_once("config_products.php");
    include_once("db.php");

    
    $link=new Db();//instancing the object
    $idDel=$_GET['q'];
    $sql="delete from categories where id_category=".$idDel;
    $stmt = $link->prepare($sql);
    $stmt->execute();
    header('location:welcome.php');
}


?>