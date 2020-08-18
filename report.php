<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- For Trophy Icon -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                    <li class="nav-item active">
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
	
	<div class="report">
	<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report of School</li>
        </ol>
    </nav>

	<?php 
		require 'connection.php';

		$stud = [];
		$query1 = "select * from student";
		$res1 = mysqli_query($conn, $query1);
		while ($row1 = mysqli_fetch_array($res1)) {
			$stud[] = array($row1[0], $row1[6], $row1[1]); // Stu_ID , Std , Name
		}
		$arrlen_stu = count($stud);

		$marks = [];
		$query2 = "select * from marks";
		$res2 = mysqli_query($conn, $query2);
		while ($row2 = mysqli_fetch_array($res2)) {
			$marks[] = array($row2[4],$row2[1]); // Stu_ID , Marks
		}
		$arrlen_marks = count($marks);

		$fresher = []; // To find out freshers
		$gold = 0;
		$silver = 0;
		$bronze = 0;
		for ($i=1; $i < 11; $i++) { 
			$std_wise_data = [];
			for ($j=0; $j < $arrlen_stu; $j++) {
				$total_m = 0; 
				if ($i == $stud[$j][1]) {
					// echo $stud[$j][2]." - ".$stud[$j][1]."<br>"; // printing name and STD
					for ($k=0; $k < $arrlen_marks; $k++) { 
						if ($stud[$j][0] == $marks[$k][0]) {
							$total_m += $marks[$k][1];
						}
					}
					if ($total_m > 0) {
						$percent = number_format(($total_m/1680)*100 , 2);
						// echo $stud[$j][1]." - ".$stud[$j][2]." - ".$percent."<br>";
						$std_wise_data[] = array($stud[$j][1], $stud[$j][2], $percent); // STD , Name , Overall Percent
					}else{
						$fresher[] = $stud[$j][2];
					}
					
				}
			}
			$len_data = count($std_wise_data);
			$rankers = [];
			$achievers = [];
			$defaulters = [];
			for ($s=0; $s < $len_data; $s++) { 
				if ($std_wise_data[$s][2] >= 80) {
					$rankers[] = $std_wise_data[$s];
				}elseif ($std_wise_data[$s][2] >= 40) {
					$achievers[] = $std_wise_data[$s];
				}else {
					$defaulters[] = $std_wise_data[$s];
				}
			}
			?> <div class="">
			<table class="table-bordered report_table col-lg-4"> 
			<thead class="tab_head"><tr><td style="text-align: center;" colspan=2>STANDARD : <?php echo $i; ?></td></tr></thead>
			<!-- Print Rankers -->
			<tbody><tr class="gold"><td style="padding-left: 15px;" colspan=2>RANKERS : <?php echo count($rankers); ?></td></tr>

			<?php
			$gold += count($rankers);
			if (count($rankers) > 0) {
				foreach ($rankers as $value){
					?>
					<tr class="gold">
						<td style="padding-left: 60px;"><?php echo $value[1]; ?></td> 
						<td style="text-align: center;"><?php echo $value[2]; ?></td>
					</tr>
					<?php
				}
			}else {
				?>
				<tr class="gold">
					<td style="padding-left: 40px;">No RANKERS in this class</td>
					<td></td>
				</tr>
				<?php
			}
			?>
			<!-- Print Achievers -->
			<tr class="silver"><td style="padding-left: 15px;" colspan=2>ACHIEVERS : <?php echo count($achievers); ?></td></tr>
			<?php
			$silver += count($achievers); 
			if (count($achievers) > 0) {
				foreach ($achievers as $value){
					?>
					<tr class="silver"> 
						<td style="padding-left: 60px;"><?php echo $value[1]; ?></td>
						<td style="text-align: center;"><?php echo $value[2]; ?></td>
					</tr>
					<?php
				}
			}else {
				?>
				<tr class="silver">
					<td style="padding-left: 40px;">No ACHIEVERS in this class</td>
					<td></td>
				</tr>
				<?php
			}
			?>
			<!-- Print Defaulters -->
			<tr class="bronze"><td style="padding-left: 15px;" colspan=2>DEFAULTERS : <?php echo count($defaulters); ?></td></tr>
			<?php
			$bronze += count($defaulters);
			if (count($defaulters) > 0) {
				foreach ($defaulters as $value){
					?>
					<tr class="bronze">
						<td style="padding-left: 60px;"><?php echo $value[1]; ?></td>
						<td style="text-align: center;"><?php echo $value[2]; ?></td>
					</tr>
					<?php
				}
			}else {
				?>
				<tr class="bronze">
					<td style="padding-left: 40px;">No DEFAULTERS in this class</td>
					<td></td>
				</tr>
				<?php
			}
			?> </tbody></table></div><?php
		}	
		?>
		<table style="border-spacing: 55px;" class="finale">
			<tr><td class="medal_text" style="font-size: 25px;" colspan=5><strong>Total School Report</strong></td></tr>
			<tr>
				<td class="medal_text"><?php echo "RANKERS : ".$gold; ?></td>
				<td></td>
				<td class="medal_text"><?php echo "ACHIEVERS : ".$silver; ?></td>
				<td></td>
				<td class="medal_text"><?php echo "DEFAULTERS : ".$bronze; ?></td>
			</tr>
			<tr>
				<!-- Reference : https://www.w3schools.com/icons/tryit.asp?filename=tryicons_fa-trophy -->
				<td class="medal gold"><i class="fa fa-trophy"></i></td>
				<td class="dummy"></td>
				<td class="medal silver"><i class="fa fa-trophy"></i></td>
				<td class="dummy"></td>
				<td class="medal bronze"><i class="fa fa-trophy"></i></td>
			</tr>
		</table>
		<?php
		if (count($fresher) > 0) {
			?> 	<table class="table-bordered fresh_total">
				<tr class="tab_head"><td>
			Freshers :
			</td></tr><tr class="fresher">
			<?php
			foreach ($fresher as $value){
				?> <td>
				<?php echo $value; ?>
				</td>
				<!-- Reference : https://www.php.net/manual/en/control-structures.foreach.php -->
				<?php
			}
			?> </tr></table> 
			<div class="report_last">
				<b>FRESHERS</b> are those students who just joined <b>AUOTDICE</b> and not attended any exams yet.<br>
				They are learner's right !!!
			</div><?php
		}
	?>
    </div>
</body>
</html>