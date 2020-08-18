<?php 
    require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>

    <style>
        .bio{
            color: #2C3335;
            padding: 5px;
            align: left;
            border-radius: 10px;
            box-shadow: 5px 5px 10px #7B8788;
            background-image: linear-gradient(to bottom right , #01CBC6 , #BB2CD9);
            font-size: 17px;
        }
        .colm{
            padding-left: 150px;
        }
        .last{
            padding-bottom: 15px;
        }
        .report{
            background-image: linear-gradient(to right , #EA425C , white);
            border-radius: 15px;
            margin-left: 60px;
            box-shadow: 5px 5px 10px #7B8788;
            float: left;
        }
        .report thead tr td{
            padding: 4px;
        }
        .report tbody tr td{
            padding: 4px;
            text-align: center;
        }
        .certi{
            width: 300px;
            padding: 20px;
            float: right;
            margin: 30px;
            background-image: linear-gradient(to top right , #45CE30 , white);
            border-radius: 30px;
            font-size: 20px;
            box-shadow: 5px 5px 10px #7B8788;
        }
        .certi button{
            margin-top: 10px;
        }
    </style>

    <!-- For Download Icon -->
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Google Icons for add and edit icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat&display=swap"
      rel="stylesheet"
    />
	<link rel="stylesheet" href="style.css" />
    <script defer src="app.js"></script>
</head>
<body class="light view_full">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="student.php">Manage Students</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Student</li>
        </ol>
    </nav>

    <div class="view_full">
    
    <a href="student.php">&nbsp;&nbsp;&nbsp;&nbsp;Back</a>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            $id = $_GET['id'];
            
        }
    ?>
    <table class="container bio table-borderless bg-warning"><thead><tr>
    <?php 
        $query1 = "select * from student where id=$id";
        $res1 = mysqli_query($conn, $query1);
        while ($row1 = mysqli_fetch_array($res1)) {
            ?><td colspan=3>
            <h2>&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;BIO</h2>
            <!-- Reference : https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-user -->
            </td>
            <td>
            <button style="float: right; margin: 20px;" class="btn"><a style="font-size: 19px; float: right; color: #192A56;" href="updatestu.php?id=<?php echo $id ?>&name=<?php echo $row1['1']; ?>&
            mail=<?php echo $row1['2']; ?>&phone=<?php echo $row1['3']; ?>&gender=<?php echo $row1['4']; ?>&
            standard=<?php echo $row1['6']; ?>"><i class="material-icons">mode_edit</i>&nbsp;EDIT</a></button>
            </td></tr></thead><tbody>
            <!-- Reference - https://www.w3schools.com/icons/tryit.asp?filename=tryicons_google-mode_edit -->

            <?php
            echo "<tr><td class='colm' colspan=2><b>NAME &nbsp;&nbsp; : &nbsp;&nbsp; </b>".$row1['1']."</td>";
            echo "<td><b style='margin-left: 50px;'>ROLL NO. &nbsp;&nbsp; : &nbsp;&nbsp; </b>".$row1['5']."</td></tr>";
            echo "<tr><td class='colm' colspan=2><b>STANDARD &nbsp;&nbsp; : &nbsp;&nbsp; </b>".$row1['6']."</td>";
            echo "<td><b style='margin-left: 50px;'>Phone No. &nbsp;&nbsp; : &nbsp;&nbsp; </b>".$row1['3']."</td></tr>";
            echo "<tr><td class='colm last' colspan=1><b>Email ID &nbsp;&nbsp; : &nbsp;&nbsp; </b>".$row1['2']."</td></tr>";
            ?> </tbody> <?php
        }

        $query2 = "select * from marks
                    inner join exams on exams.id = marks.exam_type
                    inner join subject on subject.id = marks.sub";
        // Reference : https://www.zentut.com/sql-tutorial/sql-inner-join/
        $res2 = mysqli_query($conn, $query2);

        $query3 = "select * from exams";
        $res3 = mysqli_query($conn, $query3);

        $query4 = "select * from subject";
        $res4 = mysqli_query($conn, $query4);

        $subject = [];
        while ($row4 = mysqli_fetch_array($res4)) {
            $subject[] = $row4[1];
        }
        $exam = [];
        while ($row3 = mysqli_fetch_array($res3)) {
            $exam[] = $row3[1];
        }
        $join = [];
        while ($row2 = mysqli_fetch_array($res2)) {
            $join[] = array($row2[1] , $row2[8] , $row2[6] , $row2[4] , $row2[0]);
        }
        $arrlength_s = count($subject);
        $arrlength_e = count($exam);
        $arrlength_j = count($join);
        // Reference : https://www.w3schools.com/php/php_arrays_indexed.asp
    ?>
    </table>
    
    <table class="table-bordered report"><br>

        <thead class="bg-danger">
            <tr><td align="center" colspan=11><h2><i class="fa fa-vcard"></i>&nbsp;REPORT CARD</h2></td></tr>
            <!-- Reference : https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-vcard -->
            <tr>
                <td>EXAMS</td>
                <td><?php echo $subject[0]; ?></td>
                <td><?php echo $subject[1]; ?></td>
                <td><?php echo $subject[2]; ?></td>
                <td><?php echo $subject[3]; ?></td>
                <td><?php echo $subject[4]; ?></td>
                <td><?php echo $subject[5]; ?></td>
                <td>TOTAL MARKS</td>
                <td>PERCENTAGE</td>
                <td>ADD / EDIT</td>
                <td>DELETE</td>
            </tr>
        </thead>
        <tbody>
        <?php
            $final_array = [];
            $report_card = true;
            $success = false;
            $total_score = 0;
            for ($j=0; $j < $arrlength_e; $j++) { 
                $final_array[] = $exam[$j];
                for ($i=0; $i < $arrlength_s; $i++) { 

                    for ($k=0; $k < $arrlength_j; $k++) {
                    
                        if ($subject[$i]==$join[$k][1] && $exam[$j]==$join[$k][2] && $id==$join[$k][3]) {
                            $final_array[] = $join[$k][0];
                            $marks_id[] = $join[$k][4];
                            $success = true;
                            break;
                        }
                    }
                    if($success){
                        $success = false;
                    }else{
                        $marks_id[] = "0";
                        $final_array[] = "-";
                        $report_card = false;
                    }
                }
            ?>
                <tr>
                <td><?php echo $final_array[0]; ?></td>
                <td><?php echo $final_array[1]; ?></td>
                <td><?php echo $final_array[2]; ?></td>
                <td><?php echo $final_array[3]; ?></td>
                <td><?php echo $final_array[4]; ?></td>
                <td><?php echo $final_array[5]; ?></td>
                <td><?php echo $final_array[6]; ?></td>
                <td><?php echo array_sum($final_array); ?></td>
                <!-- Reference : https://www.w3schools.com/php/func_array_sum.asp -->
                <td><?php
                    $total_score = $total_score + array_sum($final_array);
                    if ($exam[$j]=='SEMESTER 1' || $exam[$j]=='SEMESTER 2') {
                        $percent = (string)number_format((array_sum($final_array)/600)*100 , 2);
                        $percent .= " %";
                        echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($final_array)/120)*100 , 2);
                        $percent .= " %";
                        echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    } 
                ?></td>
                <td>
                    <?php 
                        if (array_sum($final_array)>0) {
                            ?>
                            <a href="updatemarks.php?id=<?php echo $id ?>&exam=<?php echo $final_array[0]; ?>&
                            eng_id=<?php echo $marks_id[0]; ?>&hin_id=<?php echo $marks_id[1]; ?>&
                            mar_id=<?php echo $marks_id[2]; ?>&mat_id=<?php echo $marks_id[3]; ?>&
                            sci_id=<?php echo $marks_id[4]; ?>&soc_id=<?php echo $marks_id[5]; ?>">
                            <i class="material-icons">mode_edit</i></a>
                            <!-- Reference - https://www.w3schools.com/icons/tryit.asp?filename=tryicons_google-mode_edit -->
                            <?php
                        }else {
                            ?>
                            <a href='addmarks.php?id=<?php echo $id ?>&exam=<?php echo $final_array[0]; ?>'>
                            <i class="material-icons">add_box</i></a>
                            <!-- Reference - https://www.w3schools.com/icons/tryit.asp?filename=tryicons_google-add_box -->
                            <?php
                        }
                    ?>
                </td>
                <td>
                <?php 
                    if (array_sum($final_array)>0) {
                        ?>
                        <a href="deletemarks.php?id=<?php echo $id ?>&exam=<?php echo $final_array[0]; ?>&
                        eng_id=<?php echo $marks_id[0]; ?>&hin_id=<?php echo $marks_id[1]; ?>&
                        mar_id=<?php echo $marks_id[2]; ?>&mat_id=<?php echo $marks_id[3]; ?>&
                        sci_id=<?php echo $marks_id[4]; ?>&soc_id=<?php echo $marks_id[5]; ?>" onclick="return confirmdelete()">
                        <i style="font-size: 20px;" class="fa fa-trash-o"></i></a>
                        <!-- Reference - https://www.w3schools.com/icons/tryit.asp?filename=tryicons_google-mode_edit -->
                        <?php
                    }else {
                        ?>
                        <i style="font-size: 20px;" disabled class="fa fa-trash-o"></i>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            $final_array = [];
            $marks_id = [];
            $success = false;
            }
        if ($report_card) {
        ?>
        <!-- <a href="certi.php?id=<?php //echo $id; ?>&total_score=<?php //echo $total_score; ?>">Grade</a> -->
        <tr class="bg-danger">
            <td colspan="7">TOTAL SCORE</td>
            <td><?php echo $total_score; ?></td>
            <td><?php
                $percent = (string)number_format(($total_score/1680)*100 , 2);
                $percent .= " %";
                echo $percent;
        }
            ?></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table><br>

    <div class="certi">
    <?php 
        if ($report_card) {
            echo "Your Report Card is available now<br>";
            ?> <button class="btn"><a target="_blank" href="certi.php?id=<?php echo $id; ?>&
            total_score=<?php echo $total_score; ?>"><i class="fa fa-eye"></i>&nbsp;&nbsp;Preview</a></button>
            <!-- Reference : https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-eye -->

            <a href="certi_download.php?id=<?php echo $id; ?>&total_score=<?php echo $total_score; ?>"> 
            <button style="margin-left: 20px;" class="btn"><i class="fa fa-download"></i>&nbsp;&nbsp;<a href="certificate.jpg" download>Download</a></button></a>
            <!-- Reference - https://www.w3schools.com/howto/howto_css_download_button.asp -->
            <!-- Reference : https://www.w3schools.com/tags/tryit.asp?filename=tryhtml5_a_download -->
            <?php
            
        }else {
            echo "Report card will be available after completion of all exams";
            ?> <button class="btn" disabled><i class="fa fa-eye"></i>&nbsp;&nbsp;Preview</button>
            <button style="margin-left: 20px;" class="btn" disabled><i class="fa fa-download"></i>&nbsp;&nbsp;Download</button>
            <!-- Reference - https://www.w3schools.com/howto/howto_css_download_button.asp -->
            <!-- Reference - https://www.w3schools.com/tags/att_button_disabled.asp -->
            <?php
            
        }
    ?>
    </div>
    <?php 
        if (isset($_GET['update'])) {
            echo "<script>alert('Student Updated Successfully')</script>";
        }
    ?>

    <!-- Checking for confirm delete -->
    <script>
        function confirmdelete() {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
                    }
    </script>

    <!-- To display success update / deleted of marks message -->
    <!-- To display success update of students message -->
    <?php 
        if (isset($_GET['delete'])) {
            echo "<script>alert('Marks Deleted Successfully')</script>";
        }
        if (isset($_GET['update_m'])) {
            echo "<script>alert('Marks Updated Successfully')</script>";
        }
        if (isset($_GET['update_s'])) {
            echo "<script>alert('Student Updated Successfully')</script>";
        }
    ?>
    </div>
</body>
</html>