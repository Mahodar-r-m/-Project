<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>

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
    <?php
        ob_start();
        // Reference : https://stackoverflow.com/questions/1912029/warning-cannot-modify-header-information-headers-already-sent-by-error
        require 'connection.php';
        $id = $_GET['id'];
        $name = $_GET['name'];
        $mail = $_GET['mail'];
        $phone = $_GET['phone'];
        $gender = $_GET['gender'];
        $standard = $_GET['standard'];
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="student.php">Manage Students</a></li>
            <li class="breadcrumb-item"><a href="viewstu.php?id=<?php echo $id; ?>">View Student</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Bio</li>
        </ol>
    </nav>

    &nbsp;&nbsp;&nbsp;
    <a href="viewstu.php?id=<?php echo $id; ?>">&nbsp;Back</a>

    <center>
    <!-- Reference : https://youtu.be/5W2qazb1-7c -->
    <!-- Reference : https://youtu.be/EaBxXVSt9dA -->
    <form class="add" action="updatestu.php?id=<?php echo $id; ?>" method="post">
        <h2>UPDATE STUDENT</h2>
        <table class="tab_add">
            <tr><p>
                <td>Name : </td>
                <td><input class="inp" value="<?php echo $name ?>" required type="text" name="name" placeholder="First Name    Middle Name    Last Name"></td>
            </p></tr>
            <tr><p>
                <td>Email ID :</td> 
                <td><input class="inp" value="<?php echo $mail ?>" required type="email" name="mail" placeholder="For eg. abc@gmail.com"></td>
            </p></tr>
            <tr><p>
                <td>Phone No. :</td> 
                <td><input class="inp" value="<?php echo $phone ?>" required type="text" name="phone" placeholder="Enter 10 digit number" maxlength="10"></td>
            </p></tr>
            <!-- Reference : https://www.w3schools.com/tags/att_input_maxlength.asp -->
            <!-- NOTE : maxlength works only with type="text" and doesn't work with type="number" -->
            <tr><p><td>Gender : </td>
                <td><input required type="radio" name="gender" value="male" <?php if ($gender == 'male') {echo "checked";} ?>>
                <label for="male">Male</label>
                <input required type="radio" name="gender" value="female" <?php if ($gender == 'female') {echo "checked";} ?>>
                <label for="female">Female</label>
                <input required type="radio" name="gender" value="other" <?php if ($gender == 'other') {echo "checked";} ?>>
                <label for="other">Other</label></td>
            </p></tr>
            <!-- Reference : https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_radio -->
            <tr><p><td>Select Standard : </td>
                <td><select class="inp" value="<?php echo $standard ?>" required name="standard">
                    <option disabled selected hidden>Select Standard</option>
                    <!-- Reference : https://www.w3docs.com/snippets/css/how-to-create-a-placeholder-for-an-html5-select-box-by-using-only-html-and-css.html -->
                    <option value="1" <?php if ($standard == 1) {echo "selected";} ?>>1</option>
                    <option value="2" <?php if ($standard == 2) {echo "selected";} ?>>2</option>
                    <option value="3" <?php if ($standard == 3) {echo "selected";} ?>>3</option>
                    <option value="4" <?php if ($standard == 4) {echo "selected";} ?>>4</option>
                    <option value="5" <?php if ($standard == 5) {echo "selected";} ?>>5</option>
                    <option value="6" <?php if ($standard == 6) {echo "selected";} ?>>6</option>
                    <option value="7" <?php if ($standard == 7) {echo "selected";} ?>>7</option>
                    <option value="8" <?php if ($standard == 8) {echo "selected";} ?>>8</option>
                    <option value="9" <?php if ($standard == 9) {echo "selected";} ?>>9</option>
                    <option value="10" <?php if ($standard == 10) {echo "selected";} ?>>10</option>
                </select></td>
            </p></tr>
            <!-- Reference : https://www.w3schools.com/tags/tag_select.asp -->
        </table>
        <button class="btn btn-outline-warning" type="submit">Update Student</button>
    </form>
    </center>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $id = $_GET['id'];
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

            $query = "update student set name='$name',mail_id='$mail_id',phone='$phone',gender='$gender',standard='$standard' where id=$id";
            $res = mysqli_query($conn, $query);
            if ($res) {
                $message = "Student Updated Successfully !!!";
                header("Location: viewstu.php?update_s=$message&id=$id");
            }else {
                $message = "Some Error Occured";
                header("Location: viewstu.php?update_s=$message&id=$id");
            }
        }
        ob_end_flush();
        // Reference : https://stackoverflow.com/questions/1912029/warning-cannot-modify-header-information-headers-already-sent-by-error
    ?>
</body>
</html>