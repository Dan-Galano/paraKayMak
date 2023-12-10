<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Capstone Search</title>
</head>
<body>
  <form id="searchForm">
    <label for="searchTitle">Enter Capstone Title:</label>
    <input type="text" id="searchTitle" name="searchTitle">
    <button type="button" onclick="searchCapstone()">Search</button>
  </form>

  <div id="searchResults"></div>
  <script src="search.js"></script>

  <select name="start" id="program">
  <?php
      $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
      $dateTime = $today->format('Y');
    for($i = 2000; $i <= $dateTime; $i++) {
    ?>
        <option value="<?php $i ?>"><?php echo $i; ?></option>
    <?php } ?>
  </select>

<form method="post" action="test.php">
    <label for="year">Select Year:</label>
    <select name="start" id="program">
        <?php
        $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
        $dateTime = $today->format('Y');
        $selectedYear = isset($_POST['start']) ? $_POST['start'] : '2000';
        for ($year = 2000; $year <= $dateTime; $year++) {
            $selected = ($year == $selectedYear) ? 'selected' : '';
            echo "<option value=\"$year\" $selected>$year</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Submit">
</form>

<form action="" method="get" class="range">
                <select name="start" id="program">
                    <?php
                    $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
                    $dateTime = $today->format('Y');
                    $selectedYear = isset($_GET['start']) ? $_GET['start'] : 'Select Date';
                    for ($year = 2000; $year <= $dateTime; $year++) {
                        $selected = ($year == $selectedYear) ? 'selected' : '';
                        echo "<option value=\"$year\" $selected>$year</option>";
                    }
                    ?>
                </select>
                <select name="end" id="program">
                
                    <?php
                    $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
                    $dateTime = $today->format('Y');
                    $selectedYear = isset($_GET['start']) ? $_GET['start'] : 'Select Date';
                    for ($year = 2000; $year <= $dateTime; $year++) {
                        $selected = ($year == $selectedYear) ? 'selected' : '';
                        echo "<option value=\"$year\" $selected>$year</option>";
                    }
                    ?>
                </select>
                    <input type="submit" name="date-search" id="date-search" value="SEARCH">
                </form>

                <!-- Your HTML form with the dropdown list and reset button -->
<form method="post" action="your_form_handler.php">
    <label for="year">Select Year:</label>
    <select name="year" id="year">
        <option value="" <?php echo empty($selectedYear) ? 'selected' : ''; ?>>Select Date</option>
        <?php
        // Assuming you have a variable $selectedYear that holds the selected year from the form submission
        $selectedYear = isset($_POST['year']) ? $_POST['year'] : ''; // Default to empty if not submitted

        // Generate the options for the dropdown list
        $currentYear = date('Y');
        for ($year = 2000; $year <= $currentYear; $year++) {
            $selected = ($year == $selectedYear) ? 'selected' : '';
            echo "<option value=\"$year\" $selected>$year</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Submit">
    <input type="button" value="Reset" onclick="resetDropdown()">
</form>

<script>
    function resetDropdown() {
        // Set the dropdown to its default value ("Select Date")
        document.getElementById('year').value = '';
    }
</script>

</body>
</html>
