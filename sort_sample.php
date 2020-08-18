<!-- TRIED BUT NOT WORKED EXTRA FILE -->
<?php 
    require 'connection.php';        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort Sample</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Students</li>
        </ol>
    </nav>

    <?php
        // Taking exam type from Database
        $query3 = "select * from exams";
        $res3 = mysqli_query($conn, $query3);

        $exams = [];
        while ($row3 = mysqli_fetch_array($res3)) {
            $exams[] = $row3[1];
        }

        // Taking standards from Database
        $query5 = "select * from standard";
        $res5 = mysqli_query($conn, $query5);

        $standards = [];
        while ($row5 = mysqli_fetch_array($res5)) {
            $standards[] = array($row5[1]);
        }
        $arraylength_std = count($standards);

        // Taking subjects from Database
        $query2 = "select * from subject where 1";
        $res2 = mysqli_query($conn, $query2);

        $subjects = [];
        while ($row2 = mysqli_fetch_array($res2)) {
            $subjects[] = $row2[1];
        }

    ?>

    <form style="float: left;" action="sort_sample.php" method="post">
        Sort : 
        <select required name="exam_type">
            <option value="" disabled selected hidden>Exam Type</option>
            <!-- Reference : https://www.w3docs.com/snippets/css/how-to-create-a-placeholder-for-an-html5-select-box-by-using-only-html-and-css.html -->
            <option value="1"><?php echo $exams[0]; ?></option>
            <option value="2"><?php echo $exams[1]; ?></option>
            <option value="3"><?php echo $exams[2]; ?></option>
            <option value="4"><?php echo $exams[3]; ?></option>
            <option value="5"><?php echo $exams[4]; ?></option>
            <option value="6"><?php echo $exams[5]; ?></option>
        </select>
        <button>Search</button>
    </form>
    
    <form action="sort_sample.php" method="post">
    &nbsp;&nbsp;&nbsp;Sort : 
        <select required name="standard">
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
        <button>Search</button>
    </form>

    <table>
        <thead>
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
        <!-- PHP Code to filter data -->
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $query1 = "select * from marks
                inner join exams on exams.id = marks.exam_type
                inner join subject on subject.id = marks.sub
                inner join student on student.id = marks.student where 1";
                // Reference : https://www.zentut.com/sql-tutorial/sql-inner-join/

                if (isset($_POST['exam_type'])) {
                    $exam = $_POST['exam_type'];
                    $query1.=" and exam_type=$exam";
                }
                $res1 = mysqli_query($conn, $query1);
            //     while ($row1 = mysqli_fetch_array($res1)) {
            //         // echo $row1[3]." ";
            //     }
            // }
        ?>

        <tbody>
            <?php 
                up: 
                $stop = 0;
            ?>
            <tr>
                <td></td>
                <?php 
                    $c=1;
                    $sum=0;
                    while ($row1 = mysqli_fetch_array($res1)) {
                
                        ?>
                        <td><?php echo $row1[1]; ?></td>
                        <?php
                        $c+=1;
                        $sum+=$row1[1];
                        if ($c<= 6) {
                            continue;
                        }else {
                            $stop = 1;
                            break;
                        }
                    }
                
                ?>
                
                <td><?php echo $sum; ?></td>
                <td><?php echo "Percent"; ?></td>
            </tr>
            <?php
                if ($stop == 1) {
                    goto up;
                    // Reference : https://www.php.net/manual/en/control-structures.goto.php
                }else {
                    goto down;
                }
                
            }
            ?>
        </tbody>

        <?php 
            down:
        ?>
    </table>

</body>
</html>