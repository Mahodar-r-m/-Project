<?php 
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            require 'connection.php';

            $id = $_GET['id'];
            $total_score = $_GET['total_score'];

            $percent = number_format(($total_score/1680)*100 , 2);
            // echo $percent;

            if ($percent >= 95) {
                $grade = "A++";
            } elseif ($percent >= 90) {
                $grade = "A+";
            } elseif ($percent >= 85) {
                $grade = "A";
            } elseif ($percent >= 80) {
                $grade = "B+";
            } elseif ($percent >= 75) {
                $grade = "B";
            } elseif ($percent >= 65) {
                $grade = "C+";
            } elseif ($percent >= 55) {
                $grade = "C";
            } elseif ($percent >= 40) {
                $grade = "D";
            } elseif ($percent >= 35) {
                $grade = "E";
            } else {
                $grade = "FAIL";
            }
            // echo $grade;

            $query = "select * from student where id=$id";
            $res = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($res);
            $name = $row[1];
            $std = $row[6];
            // echo $name.$std;

            // Code to print data on format certificate
            header('content-type: image/jpeg');
            $font = realpath('Spartan-Bold.ttf');
            $image = imagecreatefromjpeg("format.jpg");
            $color = imagecolorallocate($image, 242, 94, 141);
            $name = $name;
            imagettftext($image, 25, 0, 280, 385, $color, $font, $name);

            $font2 = realpath('Lato-Regular.ttf');
            $color2 = imagecolorallocate($image, 134, 125, 198);
            $std = $std;
            imagettftext($image, 16, 0, 380, 484, $color2, $font2, $std);

            $std = $std+1;
            imagettftext($image, 16, 0, 612, 550, $color2, $font2, $std);

            $grade = $grade;
            imagettftext($image, 16, 0, 285, 517, $color2, $font2, $grade);        

            // imagejpeg($image , 'certificate.jpg'); // For saving image into same folder of directory of php files
            imagejpeg($image , null , 95);
            // Reference : https://www.phptutorial.info/?imagejpeg

            // Free up memory
            imagedestroy($image);

            // Reference : https://youtu.be/bfV8kTCiMG8
            
        }
?>

