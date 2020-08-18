<?php 
    require 'connection.php';        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat&display=swap"
      rel="stylesheet"
    />
	<link rel="stylesheet" href="style.css" />
    <script defer src="app.js"></script>
</head>
<body class="sort-back">

    <nav class="navbar navbar-expand-lg">
			<a class="navbar-brand" href="index.php">AutoDice Dashboard</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="sort.php">View Students</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="report.php">Report of School</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="student.php">Manage Students</a>
					</li>

					<li class="nav-item has-dropdown">
						<a class="nav-link" href="#">Theme</a>
						<ul class="dropdown">
							<li class="dropdown-item">
							<a id="light" href="#">light</a>
							</li>
							<li class="dropdown-item">
							<a id="dark" href="#">dark</a>
							</li>
						</ul>
					</li>
				</ul>
				<!-- <form class="form-inline my-2 my-lg-0" action="search.php" method="post">
					<input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form> -->
			</div>
	</nav>

    <div class="sort">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Students</li>
        </ol>
    </nav>

    <?php 
        $query1 = "select * from marks
        inner join exams on exams.id = marks.exam_type
        inner join subject on subject.id = marks.sub
        inner join student on student.id = marks.student";
        // Reference : https://www.zentut.com/sql-tutorial/sql-inner-join/
        $res1 = mysqli_query($conn, $query1);

        $full_array = [];
        while ($row1 = mysqli_fetch_array($res1)) {
            $full_array[] = array($row1[1] , $row1[2] , $row1[3] , $row1[4] , $row1[15]);
        }
        $full_arrlength = count($full_array);

        // Taking subjects from Database
        $query2 = "select * from subject";
        $res2 = mysqli_query($conn, $query2);

        $subjects = [];
        while ($row2 = mysqli_fetch_array($res2)) {
            $subjects[] = $row2[1];
        }

        // Taking exam type from Database
        $query3 = "select * from exams";
        $res3 = mysqli_query($conn, $query3);

        $exams = [];
        while ($row3 = mysqli_fetch_array($res3)) {
            $exams[] = $row3[1];
        }

        // Taking students from Database
        $query4 = "select * from student";
        $res4 = mysqli_query($conn, $query4);

        $students = [];
        while ($row4 = mysqli_fetch_array($res4)) {
            $students[] = array($row4[0] , $row4[1] , $row4[6]);
        }
        $arraylength_s = count($students);

        // Taking standards from Database
        $query5 = "select * from standard";
        $res5 = mysqli_query($conn, $query5);

        $standards = [];
        while ($row5 = mysqli_fetch_array($res5)) {
            $standards[] = array($row5[1]);
        }
        $arraylength_std = count($standards);
    ?>
    <p style="float: left; margin-top: 7px; margin-left: 40px; margin-right: 20px;">Sort : </p>
        
    <table class="table-bordered table-hover table-striped" style="width: 97%; margin-left: 20px; margin-right: 20px;">
        <thead class="sort-table">
    <form action="sort.php" method="post">
    <button style="width: 100px;" class="btn btn-outline sort-search">Search</button>
    <button disabled style="width: 25px; height: 25px; border-radius: 5px; margin-left: 1000px;" class="bg-danger">
    </button>&nbsp;<span>Compulsory Field</span>
    <br><br>
    <tr>
        <td>
            <select required name="exam_type" class="bg-danger">
                <option value="" disabled selected hidden>Exam Type</option>
                <!-- Reference : https://www.w3docs.com/snippets/css/how-to-create-a-placeholder-for-an-html5-select-box-by-using-only-html-and-css.html -->
                <option value="1"><?php echo $exams[0]; ?></option>
                <option value="2"><?php echo $exams[1]; ?></option>
                <option value="3"><?php echo $exams[2]; ?></option>
                <option value="4"><?php echo $exams[3]; ?></option>
                <option value="5"><?php echo $exams[4]; ?></option>
                <option value="6"><?php echo $exams[5]; ?></option>
            </select>
        <!-- </td>
     
        <td> -->
            <select name="standard" class="sort-table">
                <option value="" disabled selected hidden>Standard</option>
                <!-- Reference : https://www.w3docs.com/snippets/css/how-to-create-a-placeholder-for-an-html5-select-box-by-using-only-html-and-css.html -->
                <option value="1"><?php echo $standards[0][0]; ?></option>
                <option value="2"><?php echo $standards[1][0]; ?></option>
                <option value="3"><?php echo $standards[2][0]; ?></option>
                <option value="4"><?php echo $standards[3][0]; ?></option>
                <option value="5"><?php echo $standards[4][0]; ?></option>
                <option value="6"><?php echo $standards[5][0]; ?></option>
                <option value="7"><?php echo $standards[6][0]; ?></option>
                <option value="8"><?php echo $standards[7][0]; ?></option>
                <option value="9"><?php echo $standards[8][0]; ?></option>
                <option value="10"><?php echo $standards[9][0]; ?></option>
            </select>
        </td>

        <td>
            <select name="English" class="sort-table">
                <option value="" disabled selected hidden>English</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
            </select>
        </td>

        <td>
            <select name="Hindi" class="sort-table">
                <option value="" disabled selected hidden>Hindi</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
            </select>
        </td>

        <td>
            <select name="Marathi" class="sort-table">
                <option value="" disabled selected hidden>Marathi</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
            </select>
        </td>

        <td>
            <select name="Maths" class="sort-table">
                <option value="" disabled selected hidden>Maths</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
            </select>
        </td>

        <td>
            <select name="Science" class="sort-table">
                <option value="" disabled selected hidden>Science</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
            </select>
        </td>

        <td>
            <select name="Social" class="sort-table">
                <option value="" disabled selected hidden>Social Studies</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
            </select>
        </td>

        <td>
            <select name="Total" class="sort-table">
                <option value="" disabled selected hidden>Total Marks</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
            </select>
        </td>

        <td>
            <select name="Percent" class="sort-table">
                <option value="" disabled selected hidden>Percentage</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
            </select>
        </td>
    </tr>
        
    </form>
    
    
            <tr>
                <td>NAME</td>
                <td><?php echo $subjects[0]; ?></td>
                <td><?php echo $subjects[1]; ?></td>
                <td><?php echo $subjects[2]; ?></td>
                <td><?php echo $subjects[3]; ?></td>
                <td><?php echo $subjects[4]; ?></td>
                <td><?php echo $subjects[5]; ?></td>
                <td>TOTAL MARKS</td>
                <td>PERCENTAGE</td>
            </tr>
        </thead>

    <?php 
        $found = false;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // To convert exam_type number to words
            if ($_POST['exam_type'] == 1) {
                $exam_name = 'UNIT TEST 1';
            }elseif ($_POST['exam_type'] == 2) {
                $exam_name = 'UNIT TEST 2';
            }elseif ($_POST['exam_type'] == 3) {
                $exam_name = 'UNIT TEST 3';
            }elseif ($_POST['exam_type'] == 4) {
                $exam_name = 'UNIT TEST 4';
            }elseif ($_POST['exam_type'] == 5) {
                $exam_name = 'SEMESTER 1';
            }elseif ($_POST['exam_type'] == 6) {
                $exam_name = 'SEMESTER 2';
            }
            
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$exam_name;
            

            // English filter with standard
            if (isset($_POST['standard']) && isset($_POST['exam_type']) && isset($_POST['English'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                $english = $_POST['English'];

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;
                if ($english == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 90px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 90px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_eng = [];
                $eng_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $eng_marks[] = $marks[0];
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_eng[] = $temp;
                
                    if ($english == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($eng_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($eng_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_eng = count($eng_marks);
                    $arr_l = count($final_eng);
                    for ($e=0; $e < $arraylength_eng; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($eng_marks[$e] == $final_eng[$i][1]) {

                                // Specially for restricting duplicate students
                                if (in_array($final_eng[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_eng[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_eng[$i][0] ?></td>
                                    <td><?php echo $final_eng[$i][1] ?></td>
                                    <td><?php echo $final_eng[$i][2] ?></td>
                                    <td><?php echo $final_eng[$i][3] ?></td>
                                    <td><?php echo $final_eng[$i][4] ?></td>
                                    <td><?php echo $final_eng[$i][5] ?></td>
                                    <td><?php echo $final_eng[$i][6] ?></td>
                                    <td><?php echo $final_eng[$i][7] ?></td>
                                    <td><?php echo $final_eng[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Hindi filter with standard
            elseif (isset($_POST['standard']) && isset($_POST['exam_type']) && isset($_POST['Hindi'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Hindi'];

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;
                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 225px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 225px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[1]; // For hindi - 1
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][2]) { // For hindi - 2

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Marathi filter with standard
            elseif (isset($_POST['standard']) && isset($_POST['exam_type']) && isset($_POST['Marathi'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Marathi'];

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;
                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 360px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 360px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[2]; // For marathi - 2
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][3]) { // For marathi - 3

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Maths filter with standard
            elseif (isset($_POST['standard']) && isset($_POST['exam_type']) && isset($_POST['Maths'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Maths'];

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;
                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 500px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 500px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[3]; // For maths - 3
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][4]) { // For maths - 4

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Science filter with standard
            elseif (isset($_POST['standard']) && isset($_POST['exam_type']) && isset($_POST['Science'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Science'];

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;
                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 630px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 630px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[4]; // For science - 4
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][5]) { // For science - 5

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Social Studies filter with standard
            elseif (isset($_POST['standard']) && isset($_POST['exam_type']) && isset($_POST['Social'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Social'];

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;
                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 768px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 768px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[5]; // For social - 5
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][6]) { // For social - 6

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Total Marks filter with standard
            elseif (isset($_POST['standard']) && isset($_POST['exam_type']) && isset($_POST['Total'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Total'];

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;
                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 925px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 925px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = array_sum($marks); // For total marks
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][7]) { // For total marks

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Percent filter with standard
            elseif (isset($_POST['standard']) && isset($_POST['exam_type']) && isset($_POST['Percent'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Percent'];

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;
                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 1060px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 1060px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = array_sum($marks); // Percent will be sorted by total marks
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][7]) { // Percent will be sorted by total marks

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Percent filter without standard
            elseif (isset($_POST['exam_type']) && isset($_POST['Percent'])) {
                
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Percent'];

                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 1130px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 1130px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = array_sum($marks); // For total marks
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][7]) { // For total marks

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Total Marks filter without standard
            elseif (isset($_POST['exam_type']) && isset($_POST['Total'])) {
                
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Total'];

                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 1000px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 1000px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = array_sum($marks); // For total marks
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][7]) { // For total marks

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Social Studies filter without standard
            elseif (isset($_POST['exam_type']) && isset($_POST['Social'])) {
                
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Social'];

                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 850px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 850px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[5]; // For social - 5
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][6]) { // For social - 6

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Science filter without standard
            elseif (isset($_POST['exam_type']) && isset($_POST['Science'])) {
                
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Science'];

                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 715px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 715px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[4]; // For science - 4
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][5]) { // For science - 5

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Maths filter without standard
            elseif (isset($_POST['exam_type']) && isset($_POST['Maths'])) {
                
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Maths'];

                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 580px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 580px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[3]; // For maths - 3
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][4]) { // For maths - 4

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Marathi filter without standard
            elseif (isset($_POST['exam_type']) && isset($_POST['Marathi'])) {
                
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Marathi'];

                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 450px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 450px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $hin_marks[] = $marks[2]; // For marathi - 2
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][3]) { // For marathi - 3

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Hindi filter without standard
            elseif (isset($_POST['exam_type']) && isset($_POST['Hindi'])) {
                
                $exam_type = $_POST['exam_type'];
                $hindi = $_POST['Hindi'];

                if ($hindi == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 317px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 317px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_hin = [];
                $hin_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            $marks[] = $record[0];
                            $found = true;        
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }

                    $hin_marks[] = $marks[1]; // For hindi - 1
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_hin[] = $temp;
                
                    if ($hindi == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($hin_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_hin = count($hin_marks);
                    $arr_l = count($final_hin);
                    for ($e=0; $e < $arraylength_hin; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($hin_marks[$e] == $final_hin[$i][2]) { // For hindi - 2

                                // Specially for restricting duplicate students
                                if (in_array($final_hin[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_hin[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_hin[$i][0] ?></td>
                                    <td><?php echo $final_hin[$i][1] ?></td>
                                    <td><?php echo $final_hin[$i][2] ?></td>
                                    <td><?php echo $final_hin[$i][3] ?></td>
                                    <td><?php echo $final_hin[$i][4] ?></td>
                                    <td><?php echo $final_hin[$i][5] ?></td>
                                    <td><?php echo $final_hin[$i][6] ?></td>
                                    <td><?php echo $final_hin[$i][7] ?></td>
                                    <td><?php echo $final_hin[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // English filter without standard
            elseif (isset($_POST['exam_type']) && isset($_POST['English'])) {
                
                $exam_type = $_POST['exam_type'];
                $english = $_POST['English'];

                if ($english == 1) {
                    // $eng_marks = sort($eng_marks);
                    // sort($eng_marks);
                    echo "<span style='margin-left: 183px;'>Ascending</span>";
                }else {
                    // $eng_marks = rsort($eng_marks);
                    // rsort($eng_marks);
                    echo "<span style='margin-left: 183px;'>Descending</span>";
                }
                // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
            

                $final_eng = [];
                $eng_marks = [];
                $s_name = []; // To prevent duplicate entries of same students
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    $temp = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        // echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    }
                    $eng_marks[] = $marks[0];
                    $temp = array($stu_id[1], $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], array_sum($marks), $percent);
                    $final_eng[] = $temp;
                
                    if ($english == 1) {
                        // $eng_marks = sort($eng_marks);
                        sort($eng_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ascending";
                    }else {
                        // $eng_marks = rsort($eng_marks);
                        rsort($eng_marks);
                        // echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descending";
                    }
                    // Reference : https://www.w3schools.com/php/php_arrays_sort.asp
                
                    }

                    $arraylength_eng = count($eng_marks);
                    $arr_l = count($final_eng);
                    for ($e=0; $e < $arraylength_eng; $e++) { 
                        for ($i=0; $i < $arr_l; $i++) { 
                            if ($eng_marks[$e] == $final_eng[$i][1]) {

                                // Specially for restricting duplicate students
                                if (in_array($final_eng[$i][0] , $s_name)) {
                                    $do_nothing = 0;
                                }else {
                                    $s_name[] = $final_eng[$i][0];
                                
                                ?>
                                <tbody>
                                    <td><?php echo $final_eng[$i][0] ?></td>
                                    <td><?php echo $final_eng[$i][1] ?></td>
                                    <td><?php echo $final_eng[$i][2] ?></td>
                                    <td><?php echo $final_eng[$i][3] ?></td>
                                    <td><?php echo $final_eng[$i][4] ?></td>
                                    <td><?php echo $final_eng[$i][5] ?></td>
                                    <td><?php echo $final_eng[$i][6] ?></td>
                                    <td><?php echo $final_eng[$i][7] ?></td>
                                    <td><?php echo $final_eng[$i][8] ?></td>
                                
                                <?php
                                }
                            }
                        }
                    }
                    
                }

            // Standard filter with exam_type
            elseif (isset($_POST['standard']) && isset($_POST['exam_type'])) {
                $standard = $_POST['standard'];
                $exam_type = $_POST['exam_type'];
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STD : ".$standard;

                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $standard == $record[4] && $exam_type == $record[1]) {
                            // echo $record[4];
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            ?>
            <tbody>
                <td><?php echo $stu_id[1]; ?></td>
                <td><?php echo $marks[0]; ?></td>
                <td><?php echo $marks[1]; ?></td>
                <td><?php echo $marks[2]; ?></td>
                <td><?php echo $marks[3]; ?></td>
                <td><?php echo $marks[4]; ?></td>
                <td><?php echo $marks[5]; ?></td>
                <td><?php echo array_sum($marks); ?></td>
                <td>
                <?php
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    } 
                ?>
                </td>
                <?php
                    }
                }

            // Exam-type filter
            elseif (isset($_POST['exam_type'])) {
                $exam_type = $_POST['exam_type'];
            
                for ($i=0; $i < $arraylength_s; $i++) { 
                    $stu_id = $students[$i];
                    $marks = [];
                    for ($j=0; $j < $full_arrlength; $j++) { 
                        $record = $full_array[$j];

                        if ($stu_id[0] == $record[3] && $exam_type == $record[1]) {
                            $marks[] = $record[0];
                            $found = true;
                            
                        }
                    }
                    if ($found){
                        $found = false;
                    }else{
                        continue;
                    }
            ?>
            <tbody>
                <td><?php echo $stu_id[1]; ?></td>
                <td><?php echo $marks[0]; ?></td>
                <td><?php echo $marks[1]; ?></td>
                <td><?php echo $marks[2]; ?></td>
                <td><?php echo $marks[3]; ?></td>
                <td><?php echo $marks[4]; ?></td>
                <td><?php echo $marks[5]; ?></td>
                <td><?php echo array_sum($marks); ?></td>
                <td>
                <?php
                    if ($exam_type == 5 || $exam_type == 6) {
                        $percent = (string)number_format((array_sum($marks)/600)*100 , 2);
                        $percent .= " %";
                        echo $percent;
                        // Reference : https://stackoverflow.com/questions/4483540/show-a-number-to-two-decimal-places#:~:text=Use%20the%20PHP%20number_format()%20function.&text=This%20will%20display%20exactly%20two,for%20int%2C%20then%20use%20this.
                    }else{
                        $percent = (string)number_format((array_sum($marks)/120)*100 , 2);
                        $percent .= " %";
                        echo $percent;
                        // Reference : https://stackoverflow.com/questions/1035634/converting-an-integer-to-a-string-in-php
                        // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
                    } 
                ?>
                </td>
                <?php
                    }
                }

                }else {
                    echo "<br>";
                }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>