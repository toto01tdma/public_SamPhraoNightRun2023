<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){

    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();
    $obj->getSessionStart();

    $num_child = 0;

    for($i = 0; $i < $_POST["number_people"]; $i++){

        $statment = $conn->prepare("SELECT id_card FROM contestants WHERE id_card = :id_card"); // ใส่โค้ด Sql ลงไป
        $statment->execute(array(":id_card" => base64_encode($_POST['id_card'.($i+1)])));
        $result = $statment->fetch(PDO::FETCH_ASSOC);
        if($result){
            $_SESSION["alert"] = "มีเลขบัตรนี้อยู่ในระบบแล้ว";
            header("location: ../../pages/homepage/");
            exit;
        }

        $name[$i] = $_POST["name".($i+1)];
        $id_card[$i] = base64_encode($_POST["id_card".($i+1)]);
        $birth_day[$i] = $_POST["birth_day".($i+1)];
        $age[$i] = $_POST["age".($i+1)];
        $gender[$i] = $_POST["gender".($i+1)];
        $nationality[$i] = $_POST["nationality".($i+1)];
        $club[$i] = $_POST["club".($i+1)];
        $phone[$i] = $_POST["phone".($i+1)];
        $size[$i] = $_POST["size".($i+1)];
        $type_sirt[$i] = $_POST["type_sirt".($i+1)];
        $type[$i] = $_POST["type".($i+1)];
        $sub_type[$i] = $_POST["sub_type".($i+1)];
        $price[$i] = $_POST["price".($i+1)];
        $delivery[$i] = $_POST["get_delivery".($i+1)];
        $address[$i] = $_POST["contest_address".($i+1)];

        if($age[$i] <= 12){
            $c_status_approve[$i] = "true";
            $num_child += 1;
        }else{
            $c_status_approve[$i] = "";
        }
    }

    if($num_child >= $_POST["number_people"]){
        $cg_status_approve = "true";
    }else{
        $cg_status_approve = "";
    }

    $cg_id = rand(00000,99999);
    $slip_id = rand(00000,99999);
    $slip_name = (isset($_FILES["slip"])) ? "cg".$cg_id."slip".$slip_id : "";

    if(isset($_FILES["slip"])){
        $img_tmp = $_FILES["slip"]['tmp_name'];
        $typeImage = strtolower(pathinfo($_FILES["slip"]['name'], PATHINFO_EXTENSION)); // นามสกุลของรูปที่ส่งมา
        $slip_name = $slip_name.".".$typeImage; // เอาไว้ตั้งเป็นชื่อไฟล์รูปเก็บลงฐานข้อมูล
    }

    $sql = "INSERT INTO `contestants_group`(`cg_id`, `status_approve`, `date_register`, `total`, `overdue_payment`) 
            VALUES (:cg_id, :status_approve, :date_register, :total, :overdue_payment)";
    $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
    $result = $statment->execute(array(
                        ":cg_id" => $cg_id,
                        ":status_approve" => $cg_status_approve,
                        ":date_register" => date("Y-m-d H:i:s"),
                        ":total" => $_POST["total"],
                        ":overdue_payment" => $_POST["total"])); // รันคำสั่ง Sql
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
        for($i = 0; $i < $_POST["number_people"]; $i++){
            $sql = "INSERT INTO `contestants`(`cg_id`, `status_approve`, `name`, `id_card`, `birth_day`, `age`, `gender`, `nationality`, `club`, `phone`, `size`, `type_sirt`, `type`, `delivery`, `address`, `sub_type`, `price`) 
                    VALUES (:cg_id, :status_approve, :name, :id_card, :birth_day, :age, :gender, :nationality, :club, :phone, :size, :type_sirt, :type, :delivery, :address, :sub_type, :price)";
            $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
            $result2 = $statment->execute(array(
                                ":cg_id" => $cg_id,
                                ":status_approve" => $c_status_approve[$i],             
                                ":name" => $name[$i],
                                ":id_card" => $id_card[$i],
                                ":birth_day" => $birth_day[$i],
                                ":age" => $age[$i],
                                ":gender" => $gender[$i],
                                ":nationality" => $nationality[$i],
                                ":club" => $club[$i],
                                ":phone" => $phone[$i],
                                ":size" => $size[$i],
                                ":type_sirt" => $type_sirt[$i],
                                ":type" => $type[$i],
                                ":delivery" => $delivery[$i],
                                ":address" => $address[$i],
                                ":sub_type" => $sub_type[$i],
                                ":price" => $price[$i]
                            )); // รันคำสั่ง Sql
        }
        if($result2){    
            $_SESSION["alert"] = "ลงทะเบียนเข้าแข่งขันสำเร็จ";
            header("location: ../../pages/check_approve/");
        }else{    
            $_SESSION["alert"] = "ลงทะเบียนเข้าแข่งขันไม่สำเร็จ"; 
            header("location: ../../pages/homepage/");
        }   
    }else{
        $_SESSION["alert"] = "ลงทะเบียนไม่สำเร็จ";
        header("location: ../../pages/homepage/");
    }
    
}else{
    echo "No";
}
?>
