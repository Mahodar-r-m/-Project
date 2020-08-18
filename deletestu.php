<?php 
    require 'connection.php';

    $id = $_GET['id'];

    $query = "delete from student where id=$id";
    $res = mysqli_query($conn, $query);
    
    $query2 = "delete from marks where student=$id";
    $res2 = mysqli_query($conn, $query2);

    if ($res && $res2){
        $message = "Student deleted successfully !!!";
        header("Location: student.php?delete=$message");
    }else{
        $message = "Some error occurred";
        header("Location: student.php?delete=$message");
    }
?>