<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .center {
            text-align: center;
            margin-top: 50px;
        }

        th,
        td {
            text-align: center;
        }
    </style>
    <title>Professor Approval</title>
</head>

<body>
    <?php
    if (isset($_POST['approve'])) {
        $UpCapstoneID = $_POST['capstoneID'];

        $select = "UPDATE upload_capstones SET status = 'approved' WHERE UpCapstoneID = '$UpCapstoneID'";
        $result = mysqli_query($connect, $select);

        echo "<script>alert('Capstone Approved!')</script>";
        header("Refresh: 1; url='prof-approval.php'");
    }
    if (isset($_POST['reject'])) {
        $UpCapstoneID = $_POST['capstoneID'];

        //delete file from folder
        $query = "SELECT * FROM upload_capstones WHERE UpCapstoneID = '$UpCapstoneID'";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            // echo $row['FileContent'];
            unlink('capstones/' . $row['FileContent']);
        }

        $select = "DELETE FROM upload_capstones WHERE UpCapstoneID = '$UpCapstoneID'";
        $result = mysqli_query($connect, $select);
        echo "<script>alert('Capstone Rejected.')</script>";


        header("Refresh: 1; url='prof-approval.php'");
    }
    ?>
    <div class="container">
        <h1 class="text-center mb-4">Uploaded Capstones</h1>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date Created</th>
                    <th>File Name</th>
                    <th>Date File Uploaded</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM upload_capstones WHERE status = 'pending' ORDER BY UpCapstoneID ASC";
                $result = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['UpCapstoneID']; ?></td>
                        <td><?php echo $row['Capstone_Title']; ?></td>
                        <td><?php echo $row['Date_Created']; ?></td>
                        <td><?php echo $row['FileContent']; ?></td>
                        <td><?php echo $row['Date_File_Uploaded']; ?></td>
                        <td>
                            <form action="prof-approval.php" method="post">
                                <input type="hidden" name="capstoneID" value="<?php echo $row['UpCapstoneID']; ?>">
                                <div class="btn-group" role="group">
                                    <button type='submit' name="approve" value="Approve" class='btn btn-success btn-sm mx-2'>Accept</button>
                                    <button type='submit' name="reject" value="Reject" class='btn btn-danger btn-sm'>Reject</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>