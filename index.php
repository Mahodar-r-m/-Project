<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
<body class="light">

    <nav class="navbar navbar-expand-lg">
			<a class="navbar-brand" href="index.php">AutoDice Dashboard</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
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
    
	<header>
    <div class="jumbotron text-center">
        <h1>AutoDice High School of Tech-Knowledge</h1>
		<img src="logo.png" alt="Logo" class="logo" height="270" width="270">
    </div>
	</header>
	<section style="margin-top: 40px;">
		<p style="font-size: 50px; font-family: Verdana, Geneva, sans-serif;"><strong>EXAM SECTION</strong></p>
		<img style="margin-left: 43%;" src="17169.png" alt="Exam Logo" class="logo" height="200" width="200">
		<p style="font-size: 25px; font-family: Comic Sans MS;"><b><span style="color: magenta;">Automated</span> Student Score Management with Grade calculation</b></p>
	</section>
	</body>
</html>