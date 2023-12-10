<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css files/create-acc4.css">
    <title>Registration</title>
</head>

<body>

    <div class="wrapper">
        <div class="wrap-header">
            <label class="title"><b>REGISTER</b></label>
        </div>


        <div class="labels">
            <ul>
                <li>Last Name</li>
                <li id="second-Label">First Name</li>
                <li id="third-Label">M.I.</li>
            </ul>
        </div>
        <form action="registration.php" method="post" class="field-input1">
            <div class="top-inp">
                <input type="text" name="lastName" id="">
                <input type="text" name="firstName">
                <input type="text" id="middle-initial" name="midInitial">
            </div>

            <div class="field-input2">
                <label for="" id="major-label">Major</label>
                <div class="major-select">
                    <select name="program" id="major">
                        <?php
                        include('config.php');
                        $program = mysqli_query($connect, "SELECT * FROM student_program");
                        while ($result = mysqli_fetch_array($program)) {
                        ?>
                            <option value="<?php echo $result['ProgramID'] ?>"><?php echo $result['Program_Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="field-input3">
                <label for="">ID Number</label>
                <input type="text" name="idNumber">
                <label for="">Password</label>
                <input type="password" name="userPassword">
            </div>


            <hr>

            <div class="user-label">
                <label for="">Are you?</label>
            </div>

            <div class="type-label">
                <label for=""><b>A Student</b></label>
                <label for="" id="type2"><b>A Student with group</b></label>
            </div>
            <div class="user-type">
                <input type="radio" name="groupStatus" value="Without Group" checked>
                <input type="radio" name="groupStatus" value="With Group">
            </div>

            <hr>

            <div class="buttons">
                <input type="submit" name="btnRegister" value="REGISTER" id="register">
            </div>
            <div class="login">
                <label for="login">Already Have an Account? <a href="login.php">Log in</a></label>
            </div>

        </form>
    </div>
</body>

</html>

<?php
require "config.php";
if (isset($_POST['btnRegister'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $midInitial = $_POST['midInitial'];
    $program = $_POST['program'];
    $idNumber = $_POST['idNumber'];
    $groupStatus = $_POST['groupStatus'];
    $userPassword = $_POST['userPassword'];

    $select = "SELECT * FROM user WHERE UserID = '$idNumber'";
    $result = mysqli_query($connect, $select);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("ID Number is already registered!")</script>';
    } else {
        $sql = "INSERT INTO `user`(`UserID`, `password`, `Last_Name`, `First_Name`, `Middle_Initial`, `ProgramID`, `groupStatus`) VALUES ('$idNumber','$userPassword','$lastName','$firstName','$midInitial', '$program', '$groupStatus')";
        $query = mysqli_query($connect, $sql);
        if ($query) {
            echo "<script>alert('Registered succesfully!')</script>";
            header("Refresh: 1; url='login.php'");
        } else {
            echo "<script>alert('Error!')</script>";
        }
    }
} else if (isset($_POST['btnLogin'])) {
    header("Refresh: 0, url='login.php'");
}
?>