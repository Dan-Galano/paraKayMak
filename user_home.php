<?php
include "config.php";
session_start();
if (isset($_SESSION['idNumber']) && isset($_SESSION['password'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css files/homepage.css">
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <title>Capstone Archive</title>
    </head>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Refresh: 1; url='login.php'");
        echo "<script>alert('Logged out successfully.')</script>";
    }
    ?>

    <body>
        <header>
            <div class="top-section">
                <img class="logo" src="images/psuLogo.svg" alt="PSU Logo">
                <label><b>PANGASINAN</b><span class="university-name"> STATE UNIVERSITY</span></label>

            </div> 
            <label for="" id="sys-name"><b>IT CAPSTONE PROJECT INVENTORY</b></label> 
            <form action="user_home.php" method="post" class="system-name">
                    <button type="submit" name="logout" id="logout"> <img src="images/power.png" style=" width: 40px; border-radius: 50px; border: none;"></button> 
            </form>
        </header>
        <nav class="navi">
            <ul>
                <li id="left-nav">
                    <a href="user_home.php" id="selected">Home</a>
                    <a href="">Capstone checker</a>
                </li>
            </ul>
            <ul>
                <li id="project">
                    <a href="<?php if($_SESSION['status'] == 'With Group'){echo 'upload.php';}?>"><i class="fa-solid fa-user fa"></i>&nbsp&nbspProject</a>
                </li>
            </ul>
        </nav>
        <?php
        $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
        $dateTime = $today->format('Y');
        ?>
        <form action="" method="get" class="content">
            <div class="side-bar">
                <div class="filter">
                    <ul>
                        <li>
                            <button type="submit" onclick="resetDropdown()" name="anytime" value="<?php echo "2000"; ?>" style="border: none; background: none; font-size: large; color: #1935DA;">Any time</button>
                        </li>
                        <li>
                            <button type="submit" onclick="resetDropdown()" name="since2023" value="<?php echo $dateTime; ?>" style="border: none; background: none; font-size: large; color: #1935DA;">Since <?php echo $dateTime; ?></button>
                        </li>
                        <li>
                            <button type="submit" onclick="resetDropdown()" name="since2022" value="<?php echo $dateTime - 1; ?>" style="border: none; background: none; font-size: large; color: #1935DA;">Since <?php echo $dateTime - 1; ?></button>
                        </li>
                        <li>
                            <button type="submit" onclick="resetDropdown()" name="since2021" value="<?php echo $dateTime - 2; ?>" style="border: none; background: none; font-size: large; color: #1935DA;">Since <?php echo $dateTime - 2; ?></button>
                        </li>
                    </ul>
                </div>
                <hr>
                <label for="" id="range-label">Custom range</label>

                <div class="range">
                    <select name="start" id="begin">
                        <option value="" <?php echo empty($selectedYear) ? 'selected' : ''; ?>>begin</option>
                        <?php
                        $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
                        $dateTime = $today->format('Y');
                        $selectedYear = isset($_GET['start']) ? $_GET['start'] : 'start';
                        for ($year = 2000; $year <= $dateTime; $year++) {
                            $selected = ($year == $selectedYear) ? 'selected' : '';
                            echo "<option value=\"$year\" $selected>$year</option>";
                        }
                        ?>
                    </select>
                    <select name="end" id="end">
                        <option value="" <?php echo empty($selectedYear) ? 'selected' : ''; ?>>end</option>
                        <?php
                        $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
                        $dateTime = $today->format('Y');
                        $selectedYear = isset($_GET['end']) ? $_GET['end'] : 'end';
                        for ($year = 2000; $year <= $dateTime; $year++) {
                            $selected = ($year == $selectedYear) ? 'selected' : '';
                            echo "<option value=\"$year\" $selected>$year</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" name="date-search" id="date-search" value="SEARCH">
                </div>
                <hr>
            </div>

            <div class="search-section">

                <div class="search-bar">
                    <input type="text" placeholder="Enter Title" name="search" value="<?php if (isset($_GET['search'])) {
                                                                                            echo $_GET['search'];
                                                                                        } ?>">
                    <button type="submit" name="searchBarSubmit"><i class="fa-solid fa-magnifying-glass fa-2xl"></i></button>
                </div>

                <div class="search-result">
                    <ul>
                        <li>
                            <?php
                            if (isset($_GET['searchBarSubmit']) || isset($_GET['date-search']) || isset($_GET['since2023']) || isset($_GET['since2022']) || isset($_GET['since2021']) || isset($_GET['anytime'])) {
                                $filtervalues = $_GET['search'];
                                if (isset($_GET['start']) && isset($_GET['end']) && is_numeric($_GET['start']) && is_numeric($_GET['end']) && ($_GET['start'] < $_GET['end'])) {
                                    $startDate = $_GET['start'];
                                    $endDate = $_GET['end'];
                                    // echo "nakapasok sa if";
                                    $query = "SELECT * FROM upload_capstones WHERE CONCAT(`Capstone_Title`, `Capstone_Abstract`) LIKE '%$filtervalues%' && SUBSTRING(Date_Created, 1, 4) BETWEEN '$startDate' AND '$endDate' AND SUBSTRING(Date_Created, 6, 2) BETWEEN '01' AND '12';";
                                } else if (isset($_GET['since2023'])) {
                                    // echo "2023 idol";
                                    $query = "SELECT * FROM upload_capstones WHERE CONCAT(`Capstone_Title`, `Capstone_Abstract`) LIKE '%$filtervalues%' && SUBSTRING(Date_Created, 1, 4) = '$dateTime';";
                                } else if (isset($_GET['since2022'])) {
                                    // echo "2022 idol";
                                    $query = "SELECT * FROM upload_capstones WHERE CONCAT(`Capstone_Title`, `Capstone_Abstract`) LIKE '%$filtervalues%' && SUBSTRING(Date_Created, 1, 4) BETWEEN '" . $_GET['since2022'] . "' AND '$dateTime' AND SUBSTRING(Date_Created, 6, 2) BETWEEN '01' AND '12';";
                                } else if (isset($_GET['since2021'])) {
                                    // echo "2021 idol";
                                    $query = "SELECT * FROM upload_capstones WHERE CONCAT(`Capstone_Title`, `Capstone_Abstract`) LIKE '%$filtervalues%' && SUBSTRING(Date_Created, 1, 4) BETWEEN '" . $_GET['since2021'] . "' AND '$dateTime' AND SUBSTRING(Date_Created, 6, 2) BETWEEN '01' AND '12';";
                                } else if (isset($_GET['anytime'])) {
                                    $query = "SELECT * FROM upload_capstones WHERE CONCAT(`Capstone_Title`, `Capstone_Abstract`) LIKE '%$filtervalues%' && SUBSTRING(Date_Created, 1, 4) BETWEEN '" . $_GET['anytime'] . "' AND '$dateTime' AND SUBSTRING(Date_Created, 6, 2) BETWEEN '01' AND '12';";
                                } else {
                                    $query = "SELECT * FROM upload_capstones WHERE CONCAT(`Capstone_Title`, `Capstone_Abstract`) LIKE '%$filtervalues%'";
                                }
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['status'] == "approved") {
                                        $abstract = substr($row['Capstone_Abstract'], 0, 300);
                                        $pdf = $row['FileContent'];
                            ?>
                                        <a href="pdfViewer.php?title=<?php echo urlencode($pdf); ?>" target=”_blank”><b><?php echo $row['Capstone_Title']; ?></b> <br></a>
                                        <label><?php echo $row['Date_Created']; ?></label>
                                        <label for=""><?php echo $abstract . "..."; ?></label><br><br>
                                    <?php }
                                }
                            } else {
                                $query = "SELECT * FROM upload_capstones";
                                $result = mysqli_query($connect, $query);

                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['status'] == "approved") {
                                        $abstract = substr($row['Capstone_Abstract'], 0, 300);
                                        $pdf = $row['FileContent'];
                                    ?>
                                        <a href="pdfViewer.php?title=<?php echo urlencode($pdf); ?>" target=”_blank”><b><?php echo $row['Capstone_Title']; ?></b> <br></a>
                                        <label><?php echo $row['Date_Created']; ?></label>
                                        <label for=""><?php echo $abstract . "..."; ?></label><br><br>
                            <?php }
                                }
                            } ?>
                        </li>

                    </ul>
                </div>
            </div>
        </form>
        <script>
            function resetDropdown() {
                // Set the dropdown to its default value ("Select Date")
                document.getElementById('begin').value = 'begin';
                document.getElementById('end').value = 'end';
            }
        </script>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "Please log in first.";
    header("Refresh: 3; url='login.php'");
}
?>