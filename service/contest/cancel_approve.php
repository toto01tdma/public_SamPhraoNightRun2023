<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){

    header('Content-Type: application/json');
    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();

    $sql = "UPDATE `contestants_group` SET `status_approve`= :status_approve, `overdue_payment` = :overdue_payment, `cause` = :cause WHERE cg_id = :cg_id";
    $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
    $result = $statment->execute(array(
                        ":cg_id" => $_POST["cg_id"],
                        ":status_approve" => "false",
                        ":overdue_payment" => $_POST["op"],
                        ":cause" => $_POST["cause"])); // รันคำสั่ง Sql
    if($result){                    
        $statment = $conn->prepare("SELECT c_id, status_approve FROM contestants WHERE cg_id = :cg_id"); // ใส่โค้ด Sql ลงไป
        $statment->execute(array(":cg_id" => $_POST["cg_id"]));
        while($result = $statment->fetch(PDO::FETCH_ASSOC)){
            $statment2 = $conn->prepare("UPDATE contestants SET `status_approve` = :status_approve WHERE c_id = :c_id"); // ใส่โค้ด Sql ลงไป
            if($result["status_approve"] != "true"){
                $statment2->execute(array(":c_id" => $result["c_id"],   ":status_approve" => 'false'));
            }
        }
                    
        http_response_code(200); // 200 คือ Success สำเร็จ
        echo json_encode(array('status' => true, 'message' => 'Approve Success')); 
    }else{
        http_response_code(401); // 401 คือ Unauthorized ไม่มีสิทธิ
        echo json_encode(array('status' => false, 'message' => 'Approve Failed'));
    }
}else{
    echo "No";
}
?>
