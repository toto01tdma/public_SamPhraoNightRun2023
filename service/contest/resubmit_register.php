<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){

    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();
    $obj->getSessionStart();

    $slip_id = rand(00000,99999);
    $cg_id = $_POST["cg_id"];
    $slip_name = (isset($_FILES["slip"])) ? "cg".$cg_id."slip".$slip_id : "";

    if(isset($_FILES["slip"])){
        $img_tmp = $_FILES["slip"]['tmp_name'];
        $typeImage = strtolower(pathinfo($_FILES["slip"]['name'], PATHINFO_EXTENSION)); // นามสกุลของรูปที่ส่งมา
        $slip_name = $slip_name.".".$typeImage; // เอาไว้ตั้งเป็นชื่อไฟล์รูปเก็บลงฐานข้อมูล
    }

    $sql = "UPDATE `contestants_group` SET `status_approve`= :status_approve, `date_register`= :date_register WHERE `cg_id` = :cg_id ";
    $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
    $result = $statment->execute(array(
                        ":status_approve" => "",
                        ":cg_id" => $cg_id,
                        ":date_register" => date("Y-m-d H:i:s"))); // รันคำสั่ง Sql
    if($result){
        if(isset($_FILES["slip"])){
            $sql = "INSERT INTO `slips`(`slip_id`, `cg_id`, `slip_name`, `upload_date`) 
                    VALUES (:slip_id, :cg_id, :slip_name, :upload_date)";
            $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
            $result = $statment->execute(array(
                        ":slip_id" => $slip_id,
                        ":cg_id" => $cg_id,
                        ":slip_name" => $slip_name,
                        ":upload_date" => date("Y-m-d H:i:s"))); // รันคำสั่ง Sql
            $upload = copy($img_tmp, "../../assets/slips/".$slip_name);
        }

        $statment = $conn->prepare("SELECT c_id, status_approve FROM contestants WHERE cg_id = :cg_id"); // ใส่โค้ด Sql ลงไป
        $statment->execute(array(":cg_id" => $cg_id));
        while($result = $statment->fetch(PDO::FETCH_ASSOC)){
            $statment2 = $conn->prepare("UPDATE contestants SET `status_approve` = :status_approve WHERE c_id = :c_id"); // ใส่โค้ด Sql ลงไป
            if($result["status_approve"] != "true"){
                $statment2->execute(array(":c_id" => $result["c_id"],   ":status_approve" => ""));
            }
        }
        $_SESSION["alert"] = "ยืนยันการชำระอีกรอบสำเร็จ";
        header("location: ../../pages/check_approve/");
    }else{
        $_SESSION["alert"] = "ยืนยันการชำระอีกรอบไม่สำเร็จ";
        header("location: ../../pages/homepage/");
    }
    
}else{
    echo "No";
}
?>
