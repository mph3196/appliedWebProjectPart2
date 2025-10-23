<?php
$currentPage = 'about';
$pageTitle = 'JSM About Us Page';
$pageDescription = 'About page for JSM University';
$pageHeading = 'About Us';

include 'header.inc';
include 'nav.inc';

require_once 'settings.php';
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<h1><strong>Who are We</strong></h1> 
<!-- Used GenAI GPT5 for who are we section-->
<p class="aboutus">
At JSM University, we are more than just a place of learning—we are a community committed to shaping future leaders, innovators, and changemakers. Founded on the values of excellence, integrity, and inclusivity, JSM University provides a dynamic environment where students are empowered to explore their potential, challenge ideas, and make meaningful contributions to society.
Our academic programs are designed to blend cutting-edge knowledge with real-world application, ensuring our graduates are not only career-ready but also equipped to make a lasting impact in their chosen fields. With a dedicated faculty, modern facilities, and a culture that fosters creativity and collaboration, JSM University stands as a hub of knowledge, research, and innovation.
Above all, we are committed to nurturing minds and inspiring futures—helping every student discover their path and achieve their vision.</p>

<!--Group details section-->
<div class="containerdetails">
  <h2>GROUP Details</h2>
  <p><strong>Group Name:</strong>JSM</p>
  <p><Strong>Meeting Location:</Strong> John St, Hawthorn VIC 3122, BA513 Business & Arts</p>
  <p><strong>Lecturer:</strong> Dr. Atie Kia</p>
  <p><strong>Lab Tutor:</strong> Dr. Atie Kia</p>
  <p><strong>Meeting Times(Day & Time):</strong></p>
  <ul>
    <li>Tuesday
      <ul>
        <li>12:30PM – 2:30PM</li>
      </ul>
    </li>
    <li>Thursday
      <ul>
        <li>10:30AM – 12:30PM</li>
      </ul>
    </li>
  </ul>
<img src="images/group_photo.jpg" alt="JSM Team Photo" class="group-photo">
</div>

<!--Insight about our team-->
<h2 class="team"><strong>OUR TEAM</strong></h2>

  <!--Each member and their student ID-->
<aside id=teaminfo>
  <h3><strong>Student ID's</strong></h3>

<?php

// Get the members
$sql = "SELECT * FROM Member";
$members = mysqli_query($conn, $sql);

// Dynamically display Team Members and their (student) ID 
while ($member = mysqli_fetch_assoc($members)) {
    echo "<li>" . $member['FullName'] . " - " . $member['MemberID'] . "</li>";
}

echo '</ul>';
echo '</aside>';

// Get the members
$sql = "SELECT * FROM Member";
$members = mysqli_query($conn, $sql);

// Dynamically display each team member's details
while ($member = mysqli_fetch_assoc($members)) {
    echo '<div class="container">';
	echo '<div class="header"><strong>' . $member['FullName'] . '</strong></div>';
	
    echo '<p>' . $member['Bio'] . '</p>';
	
  // Roles
	$sql = "SELECT * FROM Role WHERE MemberID = '" . $member['MemberID'] . "'";
	$roles = mysqli_query($conn, $sql);
	
	while ($role = mysqli_fetch_assoc($roles)) {
		echo '<p><strong>Role: </strong>' . $role['Description'] . '</p>';
	}

  // Contributions
echo "<strong>Contributions:</strong>";
echo "<p><ul>";

$sql = "
    SELECT t.Description 
    FROM CONTRIBUTION c 
    JOIN Task t ON c.TaskID = t.TaskID 
    JOIN About a ON c.AID = a.AID 
    WHERE a.MemberID = " . $member['MemberID'] . "
    ORDER BY t.TaskID
";

$tasks = mysqli_query($conn, $sql);

while ($task = mysqli_fetch_assoc($tasks)) {
    echo "<li>" . $task['Description'] . "</li>";
}

echo "</ul></p>";


  // Hobbies
  echo "<strong>Hobbies:</strong>";
  echo "<ul>";
	$sql = "SELECT * FROM Hobby WHERE MemberID = '" . $member['MemberID'] . "'";
	$hobbies = mysqli_query($conn, $sql);
	
	while ($hobby = mysqli_fetch_assoc($hobbies)) {
		echo '<li>' . $hobby['Description'] . '</li>';
	}
	
	echo '</ul>';
	echo '<p><strong>Favourite Language</strong>: ' . $member['FavLanguage'] . '</p>';
	echo '<p><strong>Favourite Quote in ' . $member['FavLanguage'] . ': </strong> "' . $member['FavQuote'] . '"</p>';
    echo '</div>';
}	

?>

<!--Table of funfacts about the team-->
<h2 id="funfacts"><strong>Fun Facts</strong></h2>
<div class="card" role="region" aria-label="Fun facts about three people">
    <table class="funfacttable">
        <caption>Fun facts — facts about our team</caption>
        <tr>
            <th scope="col">Category</th>
            <?php
            // Reset the members pointer
            mysqli_data_seek($members, 0);
            // Display member names as column headers
            while ($member = mysqli_fetch_assoc($members)) {
                echo '<th scope="col">' . $member['FullName'] . '</th>';
            }
            ?>
        </tr>
        
        <tbody>
            <?php
            // Reset the members pointer
            mysqli_data_seek($members, 0);
            
            // Dream Job Row
            echo '</tr>';
            echo '<th scope="row">Dream Job</th>';
            while ($member = mysqli_fetch_assoc($members)) {
                echo '<td>' . $member['DreamJob'] . '</td>';
            }
            echo '</tr>';
            
            // Reset for next row
            mysqli_data_seek($members, 0);
            
            // Coding Snack row
            echo '<tr>';
            echo '<th scope="row">Coding Snack</th>';
            while ($member = mysqli_fetch_assoc($members)) {
                echo '<td>' . $member['CodingSnack'] . '</td>';
            }
            echo '</tr>';
            
            // Reset for next row
            mysqli_data_seek($members, 0);
            
            // Favourite language row
            echo '<tr>';
            echo '<th scope="row">Favourite Programming Language</th>';
            while ($member = mysqli_fetch_assoc($members)) {
                echo '<td>' . $member['ProgLang'] . '</td>';
            }
            echo '</tr>';
    
            ?>
        </tbody>
    </table>
</div>

<?php

mysqli_close($conn);

include 'footer.inc';

?>