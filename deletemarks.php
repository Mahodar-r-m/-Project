<?php 
    require 'connection.php'; 
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        $id = $_GET['id'];
        $exam_type = $_GET['exam'];
        $english = $_GET['eng_id'];
        $hindi = $_GET['hin_id'];
        $marathi = $_GET['mar_id'];
        $maths = $_GET['mat_id'];
        $science = $_GET['sci_id'];
        $social = $_GET['soc_id'];

        mysqli_autocommit($conn, FALSE);

        $query1 = "delete from marks where id=$english";
        $res1 = mysqli_query($conn, $query1);
        $query2 = "delete from marks where id=$hindi";
        $res2 = mysqli_query($conn, $query2);
        $query3 = "delete from marks where id=$marathi";
        $res3 = mysqli_query($conn, $query3);
        $query4 = "delete from marks where id=$maths";
        $res4 = mysqli_query($conn, $query4);
        $query5 = "delete from marks where id=$science";
        $res5 = mysqli_query($conn, $query5);
        $query6 = "delete from marks where id=$social";
        $res6 = mysqli_query($conn, $query6);

        $final = mysqli_commit($conn);
        if ($final) {
            $message = "Marks deleted successfully";
            header("Location: viewstu.php?id=$id&delete=$message");
        }else{
            $message = "Some error occured";
            header("Location: viewstu.php?id=$id&delete=$message");
        }

    }
?>