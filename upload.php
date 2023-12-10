<?php
include "config.php";
session_start();
if (isset($_SESSION['idNumber']) && isset($_SESSION['password'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project</title>
        <link rel="stylesheet" href="css files/upload3.css">
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <form action="upload.php" method="post">
            <header>

                <div class="top-section">
                    <img class="logo" src="images/psuLogo.svg" alt="PSU Logo">
                    <label><b>PANGASINAN</b><span class="university-name"> STATE UNIVERSITY</span></label>

                </div>
                <div class="system-name">
                    <label for=""><b>IT CAPSTONE PROJECT INVENTORY</b></label>
                    <button type="submit" name="logout" id="logout">LOGOUT</button>
                </div>

                <?php
                if (isset($_POST['logout'])) {
                    session_start();
                    echo "<script>alert('Logged out successfully.')</script>";
                    session_destroy();
                    header("Refresh: 0; url='login.php'");
                }
                ?>

            </header>
        </form>
        <nav class="navi">
            <ul>
                <li id="left-nav">
                    <a href="user_home.php">Home</a>
                    <a href="">Capstone checker</a>
                </li>
            </ul>
            <ul>
                <li id="project">
                    <a href="" id="selected"><i class="fa-solid fa-user fa"></i>&nbsp&nbspProject</a>
                </li>
            </ul>
        </nav>

        <div class="container">
            <div class="fields">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="input1">
                        <label for="">Title:</label>
                        <input type="text" name="title" required>
                        <label for="">Abstract:</label>
                        <textarea name="abstract" name="abstract" id="" cols="30" rows="20" required></textarea>
                        <input type="submit" name="submitFile" id="submitFile" value="Submit">
                    </div>

                    <div class="input2">
                        <label for="">Date Created</label>
                        <input type="month" name="dateCreated" required>

                        <label for="" id="program-label">Program</label>
                        <select name="program" id="program">
                            <?php
                            include('config.php');
                            $program = mysqli_query($connect, "SELECT * FROM student_program");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['ProgramID'] ?>"><?php echo $result['Program_Name'] ?></option>
                            <?php } ?>
                        </select>

                        <label for="capstoneFile" name="fileContent" id="upload">Upload file</label>
                        <input type="file" name="capstoneFile" id="capstoneFile" required>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "Please log in first.";
    header("Refresh: 3; url='login.php'");
}
?>

<?php
if (isset($_POST['submitFile'])) {
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $dateCreated = $_POST['dateCreated'];
    $program = $_POST['program'];

    $fileName = $_FILES['capstoneFile']['name'];
    $tmpFileName = $_FILES['capstoneFile']['tmp_name'];
    $targetdir = 'capstones/';

    $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $dateTime = $today->format('Y-m-d');
    $upload = false;

    if (!file_exists($targetdir)) {
        mkdir('photos/');
    }

    $directory = $targetdir . $fileName;
    $fileExt = strtolower(pathinfo($directory, PATHINFO_EXTENSION));

    if ($fileExt == 'pdf') {
        move_uploaded_file($tmpFileName, $targetdir . $fileName);
        $upload = true;
    } else {
        echo '<script>alert("File type unsupported.")</script>';
    }

    if ($upload) {
        $sql = 'INSERT INTO `upload_capstones`(`Capstone_Title`, `Capstone_Abstract`, `Date_Created`, `FileContent`, `Date_File_Uploaded`, `ProgramID`, `status`) VALUES ("' . $title . '","' . $abstract . '","' . $dateCreated . '","' . $fileName . '","' . $dateTime . '","' . $program . '","pending")';
        $result = mysqli_query($connect, $sql);
        echo '<script>alert("Capstone has been uploaded successfully!")</script>';
    }
}
?>