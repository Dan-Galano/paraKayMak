<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css files/classSubmission.css">
   
    <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
    
    <title>Capstone Archive</title>
</head>
<body>
    <header>
        <div class="top-section">
            <img class="logo" src="images/psuLogo.svg" alt="PSU Logo"><br>
            <label><b>PANGASINAN</b><br><span class="university-name"> STATE UNIVERSITY</span></label> 
            
        </div>
        <div class="system-name">
            <label for=""><b>IT CAPSTONE PROJECT INVENTORY</b></label>
            <button type="submit" id="logout">LOGOUT</button>
        </div>
    
        
    </header>
    <nav class="navi">
        <ul>
            <li id="left-nav">
                <a href="user_home.php" >Class</a>
                <a href="ClassSubmission.php"id="selected">Submission</a>
            </li>
        </ul>
        <ul>
            <li id="project">
                <a href=""><i class="fa-solid fa-user fa"></i>&nbsp&nbspProject</a>
            </li>
        </ul>
    </nav>
     
       
    </div>
    <?php
    require "config.php";
    $sql = "SELECT `CID`, `GID`, `title`, `year`, `filename`, `members`, `upload` FROM `books`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    echo "
    <div class='Tables'>
    <table class='table table-striped'>
  <thead>
    <tr>
      <th scope='col'>CAPSTONE ID</th>
      <th scope='col'>GROUP ID</th>
      <th scope='col'>TITLE</th>
      <th scope='col'>YEAR CREATED</th>
      <th scope='col'>FILENAME</th>
      <th scope='col'>MEMBERS</th>
      <th scope='col'>UPLOAD</th>
      <th scope='col'></th>
      <th scope='col'></th>
     
    </tr>
  </thead>
  ";
  while ($row = $result->fetch_assoc()) {
  echo"
  <tbody>
    <tr>
      <th scope='row'>{$row['CID']}</th>
      <td>{$row['GID']}</td>
      <td>{$row['title']}</td>
      <td>{$row['year']}</td>
      <td>{$row['filename']}</td>
      <td>{$row['members']}</td>
      <td>{$row['upload']}</td>
      <td><Button type='button' class='btn btn-success'>Accept</Button></td>
      <td><Button  type='button' class='btn btn-danger' >Reject</Button></td>
    </tr>
    
      
    </tr>
   
    
  </tbody>
</table> ";}
}

?>
    </div>


    
    
</body>
</html>