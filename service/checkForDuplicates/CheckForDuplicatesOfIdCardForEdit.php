<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();

    $statment = $conn->prepare("SELECT id_card FROM contestants WHERE id_card = :id_card AND NOT id_card = :old_id_card"); // ใส่โค้ด Sql ลงไป
    $statment->execute(array(":id_card" => base64_encode($_POST['id_card']),
                             ":old_id_card" => base64_encode($_POST["old_id_card"])));
    $result = $statment->fetch(PDO::FETCH_ASSOC);

    if($result){
        $response = [
            'status' => false,
            'message' => 'Failed'
        ];
    
        http_response_code(400);
        echo json_encode($response);
    }else{
        $response = [
            'status' => true,
            'message' => 'Success'
        ];
    
        http_response_code(200);
        echo json_encode($response);
    }

}
?>
    

