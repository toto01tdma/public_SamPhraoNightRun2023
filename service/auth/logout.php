<?php
    session_start();
    
    if(isset($_SESSION['admin'])){
        unset($_SESSION["admin"]);

        $_SESSION["alert"] = "ออกจากระบบเรียบร้อย"; 
        header("location: ../../pages/homepage/");
    }
?>
    

