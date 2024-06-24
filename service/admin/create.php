<?php
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        require_once("../connect.php");
        $obj = new ConnectDatabase();
        $conn = $obj->getConnect();
        $obj->getSessionStart();

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // password_hash คือนำไปแปลงรหัสก่อนเก็บลงฐานข้อมูล

        $sql = "INSERT INTO `admins`(`username`, `password`, `name`, `level`) 
                VALUES (:username, :password, :name, :level)";
        $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
        $result = $statment->execute(array(":username" => $_POST["username"],
                            ":password" => $password,
                            ":name" => $_POST["name"],
                            ":level" => "2"));
        if($result){
            $_SESSION["alert"] = "เพิ่มผู้ดูแลสำเร็จ";
            header("location: ../../pages/manager_admin/");
        }else{
            $_SESSION["alert"] = "เพิ่มผู้ดูแลไม่สำเร็จ"; 
            header("location: ../../pages/homepage/");
        }
    }
?>