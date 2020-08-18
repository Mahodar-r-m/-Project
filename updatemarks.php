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

        $sub_arr = [$english, $hindi, $marathi, $maths, $science, $social];

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Marks</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat&display=swap"
      rel="stylesheet"
    />
	<link rel="stylesheet" href="style.css" />
    <script defer src="app.js"></script>
</head>
<body class="view_full">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="student.php">Manage Students</a></li>
            <li class="breadcrumb-item"><a href="viewstu.php?id=<?php echo $id; ?>">View Student</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Marks</li>
        </ol>
    </nav>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $id = $_GET['id'];

            $exam_type = $_GET['exam'];
            $english = $_GET['eng_id'];
            $hindi = $_GET['hin_id'];
            $marathi = $_GET['mar_id'];
            $maths = $_GET['mat_id'];
            $science = $_GET['sci_id'];
            $social = $_GET['soc_id'];
            // $sub_arr = [$english, $hindi, $marathi, $maths, $science, $social];

            $english_m = $_POST['1'];
            $hindi_m = $_POST['2'];
            $marathi_m = $_POST['3'];
            $maths_m = $_POST['4'];
            $science_m = $_POST['5'];
            $social_m = $_POST['6'];

            mysqli_autocommit($conn, FALSE);
            
            $query1 = "update marks set marks=$english_m where id=$english";
            $res1 = mysqli_query($conn , $query1);
            $query2 = "update marks set marks=$hindi_m where id=$hindi";
            $res2 = mysqli_query($conn , $query2);
            $query3 = "update marks set marks=$marathi_m where id=$marathi";
            $res3 = mysqli_query($conn , $query3);
            $query4 = "update marks set marks=$maths_m where id=$maths";
            $res4 = mysqli_query($conn , $query4);
            $query5 = "update marks set marks=$science_m where id=$science";
            $res5 = mysqli_query($conn , $query5);
            $query6 = "update marks set marks=$social_m where id=$social";
            $res6 = mysqli_query($conn , $query6);

            $final = mysqli_commit($conn);
            if ($final) {
                $message = "Marks updated successfully";
                header("Location: viewstu.php?id=$id&update_m=$message");
            }else{
                $message = "Some error occured";
                header("Location: viewstu.php?id=$id&update_m=$message");
            }
        }
    ?>

    &nbsp;&nbsp;&nbsp;
    <a href="viewstu.php?id=<?php echo $id; ?>">Back</a>
    <center>
    <form class="add" action="updatemarks.php?id=<?php echo $id; ?>&exam=<?php echo $exam_type; ?>&
                eng_id=<?php echo $english; ?>&hin_id=<?php echo $hindi; ?>&
                mar_id=<?php echo $marathi; ?>&mat_id=<?php echo $maths; ?>&
                sci_id=<?php echo $science; ?>&soc_id=<?php echo $social; ?>" method="post">
        <h2>UPDATE MARKS</h2>
        <!-- To display name of student of which we are editing marks -->
        <p><b>Name : </b><?php 
            $query_name = "select * from student";
            $res_name = mysqli_query($conn, $query_name);
            while ($row_name = mysqli_fetch_array($res_name)) {
                if ($id == $row_name[0]) {
                    echo $row_name[1];
                }
            }
        ?></p><p><b>Exam : </b><?php echo $exam_type; ?>
            <!-- <select required name="exam_type"> -->
                <!-- <option value="" disabled selected hidden>Select Exam</option> -->
                <!-- Reference : https://www.w3docs.com/snippets/css/how-to-create-a-placeholder-for-an-html5-select-box-by-using-only-html-and-css.html -->
                <!-- <option value="1">UNIT TEST 1</option>
                <option value="2">UNIT TEST 2</option>
                <option value="3">UNIT TEST 3</option>
                <option value="4">UNIT TEST 4</option>
                <option value="5">SEMESTER 1</option>
                <option value="6">SEMESTER 2</option> -->
            <!-- </select> -->
        </p>
        <p><b>NOTE : </b>
        <?php
            if ($exam_type=="SEMESTER 1" || $exam_type=="SEMESTER 2") {
                echo "SEMESTER are of 100 Marks";
            }else {
                echo "UNIT TEST are of 20 Marks";
            }
            ?>
         </p><table class="tab_add">
            <?php
            $query = "select * from subject";
            $res = mysqli_query($conn, $query);

            $i=0;
            while ($row = mysqli_fetch_array($res)) {
                ?> <tr><td> <?php
                echo $row['1']." :  ";

                $query7 = "select marks from marks where id=$sub_arr[$i]";
                $res7 = mysqli_query($conn, $query7);
                $row7 = mysqli_fetch_array($res7);
                ?></td>
                <td><input class="inp" type="number" name="<?php echo $row['0'] ?>" value="<?php echo $row7[0]; ?>"></td></tr>
                
                <?php
                $i++;
            }
        ?></table>
        <button class="btn btn-outline-warning" type="submit">Update</button>
    </form>
    </center>
</body>
</html>