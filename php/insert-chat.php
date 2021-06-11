<?php 
    session_start();

    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
    
        $outgoing_id = $_SESSION['unique_id']; //sender id
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); //reciever id
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $e_val = mysqli_real_escape_string($conn, $_POST['e_value']); //getting from js

        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg , emotion)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$e_val}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>