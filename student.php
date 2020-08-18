<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    
    <!-- For View & Delete Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Icons for add icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
<body class="light">

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
					<li class="nav-item">
						<a class="nav-link" href="sort.php">View Students</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="report.php">Report of School</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link active" href="student.php">Manage Students</a>
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
    <div class="student">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage Students</li>
        </ol>
    </nav>

    &nbsp;&nbsp;&nbsp;
    <button class="btn stu_head"><a class="stu_head add_s" href="addstu.php"><i style="padding-top: 5px;" class="material-icons">
    add_box</i>&nbsp;Add Student</a></button>
    &nbsp;&nbsp;
    <button class="btn stu_head"><a class="stu_head refresh" href="student.php"><i class="fa fa-refresh"></i>&nbsp;Refresh Page</a></button>
    <!-- Reference : https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-refresh -->
    <br><br>
    <?php 
        require 'connection.php';
        
        $query = "select * from student";
        $res = mysqli_query($conn, $query);
    ?>
    
    <table class="table-bordered table-hover table-striped" style="width: 97%; margin-left: 20px; margin-right: 20px;">
        <thead class="stu_head">
            <tr>
                <td style="padding-left: 17px;">NAME</td>
                <td style="padding-left: 17px;">MAIL ID</td>
                <td style="text-align: center;">PHONE NO.</td>
                <td style="text-align: center;">GENDER</td>
                <td style="text-align: center;">ROLL NO.</td>
                <td style="text-align: center;">STANDARD</td>
                <td style="text-align: center;">VIEW</td>
                <td style="text-align: center;">DELETE</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                $total = mysqli_num_rows($res);
                if ($total==0) {
                    ?> <tr><td>No Records found</td></tr> <?php
                }else {
                    
                    while ($row = mysqli_fetch_array($res)) {
                        ?>
                        <tr>
                            <td style="padding-left: 17px;"><?php echo $row['1']; ?></td>
                            <td style="padding-left: 17px;"><?php echo $row['2']; ?></td>
                            <td style="text-align: center;"><?php echo $row['3']; ?></td>
                            <td style="text-align: center;"><?php echo $row['4']; ?></td>
                            <td style="text-align: center;"><?php echo $row['5']; ?></td>
                            <td style="text-align: center;"><?php echo $row['6']; ?></td>
                            <td style="text-align: center;"><a class="stu_link" href="viewstu.php?id=<?php echo $row['id']; ?>"><i class="fa fa-eye"></i></a></td>
                            <!-- Reference - https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-eye -->
                            <td style="text-align: center;"><a class="stu_link" href="deletestu.php?id=<?php echo $row['id']; ?>" onclick="return confirmdelete()"><i class="fa fa-trash-o"></i></a></td>
                            <!-- Reference - https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-trash-o -->
                        </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
    </table>

    <script>
        function confirmdelete() {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
                    }
    </script>
    <!-- Reference : https://stackoverflow.com/questions/9139075/how-to-show-a-confirm-message-before-delete -->
    <!-- Reference : https://youtu.be/8wndhVl4gy0 -->

    <?php 
        if (isset($_GET['delete'])) {
            echo "<script>alert('Student Deleted Successfully')</script>";
        }
    ?>
    <!-- Reference : https://youtu.be/8wndhVl4gy0 -->
    </div>
</body>
</html>