<?php
    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();
    $obj->getSessionStart();

    if(!isset($_SESSION["admin"])){ 
        header("location: ../../pages/homepage/");
        exit;
    }else if($_SESSION["admin"]["level"] != "1"){
        header("location: ../../pages/homepage/");
        exit;
    }

    $sql = "DELETE FROM admins WHERE admin_id = :admin_id";
    $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
    $result = $statment->execute(array(":admin_id" => $_GET["admin_id"]));
    if($result){
        $_SESSION["alert"] = "ลบผู้ดูแลสำเร็จ";
        header("location: ../../pages/manager_admin/");
    }else{
        $_SESSION["alert"] = "ลบผู้ดูแลไม่สำเร็จ"; 
        header("location: ../../pages/manager_admin/");
    }
?>