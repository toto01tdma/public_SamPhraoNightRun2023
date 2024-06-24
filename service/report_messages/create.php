<?php
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        require_once("../connect.php");
        $obj = new ConnectDatabase();
        $conn = $obj->getConnect();

        $sql = "INSERT INTO `message_report_problem`(`head_mes`, `content_mes`, `date_report`) 
                VALUES (:head_mes, :content_mes, :date_report)";
        $statment = $conn->prepare($sql); // ใส่โค้ด Sql ลงไป
        $result = $statment->execute(array( ":head_mes" => $_POST["head_problem"],
                                            ":content_mes" => $_POST["text_problem"],
                                            ":date_report" => date("Y-m-d H:i:s")));
        if($result){
            http_response_code(200); // 200 คือ Success สำเร็จ
            echo json_encode(array('status' => true, 'message' => 'Send report message success')); 
        }else{
            http_response_code(401); // 401 คือ Unauthorized ไม่มีสิทธิ
            echo json_encode(array('status' => false, 'message' => 'Send report message failed'));
        }
    }
?>