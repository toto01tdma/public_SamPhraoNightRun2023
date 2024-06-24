<?php
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        require_once("../connect.php");
        $obj = new ConnectDatabase();
        $conn = $obj->getConnect();
        $obj->getSessionStart();

        $sql = "UPDATE `admins` SET `name`= :name, `level`= :level 
                WHERE admin_id = :admin_id";
        $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
        $result = $statment->execute(array(":admin_id" => $_POST["admin_id"],
                                            ":name" => $_POST["name"],
                                            ":level" => $_POST["level"]));
        if($result){
            $_SESSION["alert"] = "แก้ไขข้อมูลผู้ดูแลสำเร็จ";
            header("location: ../../pages/manager_admin/");
        }else{
            $_SESSION["alert"] = "แก้ไขข้อมูลผู้ดูแลไม่สำเร็จ"; 
            header("location: ../../pages/manager_admin/");
        }
    }
?>