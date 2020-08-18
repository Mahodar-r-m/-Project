<?php 
    require 'connection.php'; 
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $id = $_GET['id'];
        $exam_type = $_GET['exam'];

        
        $query_exam = "select * from exams";
        $res_exam = mysqli_query($conn, $query_exam);
        while ($row_exam = mysqli_fetch_array($res_exam)) {
            if ($row_exam['1'] == $exam_type) {
                $exam_type_id = $row_exam['0'];
            }
        }
    }
 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $id = $_GET['id'];

        $exam_type = $_GET['exam_type'];
        $english = $_POST['1'];
        $hindi = $_POST['2'];
        $marathi = $_POST['3'];
        $maths = $_POST['4'];
        $science = $_POST['5'];
        $social = $_POST['6'];
        echo $exam_type;

        if ($conn -> connect_errno) {
            echo "Failed to connect to MySQL: " . $conn -> connect_error;
        }
        // if (!$conn -> query("insert into marks(marks, exam_type, sub, student) values($english, $exam_type, 1, $id)")) {
        //     echo("Error description: " . $conn -> error);
        // }
        // Reference : https://www.w3schools.com/php/func_mysqli_error.asp

        mysqli_autocommit($conn, FALSE);
        
        $query1 = "insert into marks(marks, exam_type, sub, student) values($english, $exam_type, 1, $id)";
        $res1 = mysqli_query($conn , $query1);
        $query2 = "insert into marks(marks, exam_type, sub, student) values($hindi, $exam_type, 2, $id)";
        $res2 = mysqli_query($conn , $query2);
        $query3 = "insert into marks(marks, exam_type, sub, student) values($marathi, $exam_type, 3, $id)";
        $res3 = mysqli_query($conn , $query3);
        $query4 = "insert into marks(marks, exam_type, sub, student) values($maths, $exam_type, 4, $id)";
        $res4 = mysqli_query($conn , $query4);
        $query5 = "insert into marks(marks, exam_type, sub, student) values($science, $exam_type, 5, $id)";
        $res5 = mysqli_query($conn , $query5);
        $query6 = "insert into marks(marks, exam_type, sub, student) values($social, $exam_type, 6, $id)";
        $res6 = mysqli_query($conn , $query6);

        $final = mysqli_commit($conn);
        if ($final) {
            echo "<br>Marks added successfully";
            header("Location: viewstu.php?id=$id");
        }else {
            echo "<br>Some error occured";
            header("Location: viewstu.php?id=$id");
        }
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
            <li class="breadcrumb-item active" aria-current="page">Add Marks</li>
        </ol>
    </nav>

    &nbsp;&nbsp;&nbsp;
    <a href="viewstu.php?id=<?php echo $id; ?>">Back</a>
    <center>
    <form class="add" action="addmarks.php?id=<?php echo $id; ?>&exam_type=<?php echo $exam_type_id; ?>" method="post">
        <h2>ADD MARKS</h2>
        <!-- To display name of student of which we are adding marks -->
        <p><b>Name : </b><?php 
            $query_name = "select * from student";
            $res_name = mysqli_query($conn, $query_name);
            while ($row_name = mysqli_fetch_array($res_name)) {
                if ($id == $row_name[0]) {
                    echo $row_name[1];
                }
            }
        ?>
        </p><p><b>Exam : </b><?php echo $exam_type; ?></p>
        
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
            while ($row = mysqli_fetch_array($res)) {
                ?> <tr><td> <?php
                echo $row['1']." :  ";
                ?></td>
                <td><input class="inp" required type="number" name="<?php echo $row['0'] ?>"></td></tr>
                <?php
            }
        ?></table>
        <button class="btn btn-outline-warning" type="submit">Add</button>
    </form>
    </center>
</body>
</html>