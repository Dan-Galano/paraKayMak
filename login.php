<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css files/login1.css">
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <img class="logo" src="images/psuLogo.svg" alt="PSU Logo">
            <label class="text-header"><b>PANGASINAN</b> <span class="text-header2">STATE UNIVERSITY</span></label>
        </div>

        <div class="title">
            <label for="">IT CAPSTONE PROJECT INVENTORY</label>
        </div>

        <form action="login.php" method="post" class="field-input">
            <label for="">ID Number</label>
            <input type="text" name="idNumber" placeholder="21-UR-0183">
            <label for="">Password</label>
            <input type="password" name="password" placeholder="********">
            <?php
            require "config.php";
            session_start();

            if (isset($_POST['btnLogin'])) {
                $idNumber = $_POST['idNumber'];
                $password = $_POST['password'];

                if (!empty($idNumber) && !empty($password)) {
                    $sql = "SELECT `UserID`, `password`, `groupStatus` FROM user WHERE user.UserID = '$idNumber' AND user.password = '$password'";
                    $result = mysqli_query($connect, $sql);

                    if (mysqli_num_rows($result) >= 1) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['UserID'] == $idNumber && $row['password'] == $password) { //error here
                            // echo "<script>alert('Logged in successfully!')</script>";
                            $_SESSION['idNumber'] = $row['UserID'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['status'] = $row['groupStatus'];
                            echo "<p style='color: green; margin-left: 37%;'>Logged in.</p>";
                            header("Refresh: 1; url='user_home.php'");
                        } else {
                            echo "<p style='color: red; margin-left: 30%;'>Invalid credentials.</p>";
                        }
                    } else {
                        echo "<p style='color: red; margin-left: 30%;'>Invalid credentials.</p>";
                    }
                } else {
                    echo "<p style='color: red; margin-left: 30%;'>Invalid credentials.</p>";
                }
            } else if (isset($_POST['btnRegister'])) {
                header("Refresh: 0, url='registration.php'");
            }
            ?>
            <input type="submit" name="btnLogin" value="LOGIN" id="login">
        </form>

        <a href="registration.php">Register</a>

    </div>
</body>

</html>