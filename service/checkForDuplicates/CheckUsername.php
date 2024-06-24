<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    header('Content-Type: application/json');
    require_once("../connect.php");
    $obj = new ConnectDatabase();
    $conn = $obj->getConnect();

    $statment = $conn->prepare("SELECT username FROM admins WHERE username = :username"); // ใส่โค้ด Sql ลงไป
    $statment->execute(array(":username" => $_POST['username']));
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
    

