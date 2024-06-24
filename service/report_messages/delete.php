<?php
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        require_once("../connect.php");
        $obj = new ConnectDatabase();
        $obj->getSessionStart();
        $conn = $obj->getConnect();

        if(!isset($_SESSION["admin"])){ 
            header("location: ../../pages/homepage/");
            exit;
        }

        $sql = "DELETE FROM message_report_problem WHERE id_mes = :id_mes";
        $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
        $result = $statment->execute(array(":id_mes" => $_POST["id_mes"]));
        if($result){
            http_response_code(200); // 200 คือ Success สำเร็จ
            echo json_encode(array('status' => true, 'message' => 'success')); 
        }else{
            http_response_code(401); // 401 คือ Unauthorized ไม่มีสิทธิ
            echo json_encode(array('status' => false, 'message' => 'failed'));
        }
    }
?>