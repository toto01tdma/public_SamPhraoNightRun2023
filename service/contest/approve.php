<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){

    header('Content-Type: application/json');
    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();

    $sql = "UPDATE `contestants_group` SET `status_approve`= :status_approve, `overdue_payment` = :overdue_payment WHERE cg_id = :cg_id";
    $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
    $result = $statment->execute(array(
                        ":cg_id" => $_POST["cg_id"],
                        ":status_approve" => "true",
                        ":overdue_payment" => "0")); // รันคำสั่ง Sql
    if($result){

        // $statment = $conn->prepare("SELECT c_id FROM contestants WHERE `number` IS NOT NULL "); // ใส่โค้ด Sql ลงไป
        // $statment->execute();
        // $count = $statment->rowCount();

        $statment = $conn->prepare("SELECT c_id FROM contestants WHERE cg_id = :cg_id"); // ใส่โค้ด Sql ลงไป
        $statment->execute(array(":cg_id" => $_POST["cg_id"]));
        while($result = $statment->fetch(PDO::FETCH_ASSOC)){
            // $count += 1;
            // $number_format = str_pad($count, 5, '0', STR_PAD_LEFT);
            $statment2 = $conn->prepare("UPDATE contestants SET `status_approve` = :status_approve WHERE c_id = :c_id"); // ใส่โค้ด Sql ลงไป
            $statment2->execute(array(":c_id" => $result["c_id"],   ":status_approve" => 'true'));
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
