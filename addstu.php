<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

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
            <li class="breadcrumb-item active" aria-current="page">Add Student</li>
        </ol>
    </nav>
    &nbsp;&nbsp;&nbsp;
    <a href="student.php">Back</a>
    <center>
    <form  class="add" action="addstu.php" method="post">
        <h1>ADD STUDENT</h1>
        <p>Name : <input required type="text" name="name" placeholder="First Name    Middle Name    Last Name"></p>
        <p>Email ID : <input required type="email" name="mail" placeholder="For eg. abc@gmail.com"></p>
        <p>Phone No. : <input required type="text" name="phone" placeholder="Enter 10 digit number" maxlength="10"></p>
        <!-- Reference : https://www.w3schools.com/tags/att_input_maxlength.asp -->
        <!-- NOTE : maxlength works only with type="text" and doesn't work with type="number" -->
        <p>Gender : 
            <input required type="radio" name="gender" value="male">
            <label for="male">Male</label>
            <input required type="radio" name="gender" value="female">
            <label for="female">Female</label>
            <input required type="radio" name="gender" value="other">
            <label for="other">Other</label>
        </p>
        <!-- Reference : https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_radio -->
        <p>Select Standard : 
            <select required name="standard">
                <option value="" disabled selected hidden>Select Standard</option>
                <!-- Reference : https://www.w3docs.com/snippets/css/how-to-create-a-placeholder-for-an-html5-select-box-by-using-only-html-and-css.html -->
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </p>
        <!-- Reference : https://www.w3schools.com/tags/tag_select.asp -->
        <button type="submit">Add Student</button>
    </form>
    </center>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            require 'connection.php';

            $name = $_POST['name'];
            $mail_id = $_POST['mail'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $standard = $_POST['standard'];

            $name = strtolower($name); // Converts whole string to lowercase
            
            // Added in between bcoz wanted lowercase letters of name
            $roll_1 = substr($name, 0, 2); // Takes first 2 letters of name
            $roll_2 = substr($phone, 8 , 10); // Takes first 2 numbers of phone
            $roll_3 = substr($mail_id, 0, 2); // Takes first 2 letters of mail
            // Reference : https://stackoverflow.com/questions/3787540/how-to-get-first-5-characters-from-string
            
            $roll_no = "{$roll_1}{$roll_2}{$roll_3}";
            // Reference : https://www.php.net/manual/en/language.operators.string.php#:~:text=String%20Operators%20%C2%B6&text=The%20first%20is%20the%20concatenation,argument%20on%20the%20left%20side.
            
            $name = ucwords($name); // Converts first letter of every sting to upper case
            // Reference : https://www.w3schools.com/php/php_ref_string.asp 

            $query = "insert into student(name, mail_id, phone, gender, roll_no, standard) values('$name', '$mail_id', '$phone', '$gender', '$roll_no', '$standard')";
            $res = mysqli_query($conn, $query);
            if ($res) {
                $message = "Student Added Successfully !!!";
                header("Location: addstu.php?add_s=$message");
            }else {
                $message = "Some Error Occured";
                header("Location: addstu.php?add_s=$message");
            }
        }

        if (isset($_GET['add_s'])) {
            echo "<script>alert('Student Added Successfully')</script>";
        }
    ?>
</body>
</html>