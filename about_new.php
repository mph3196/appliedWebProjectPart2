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

// HTML Content
echo '<h1><strong>Who are We</strong></h1>';
echo '<p class="aboutus">';
echo 'At JSM University, we are more than just a place of learning—we are a community committed to shaping future leaders, innovators, and changemakers. Founded on the values of excellence, integrity, and inclusivity, JSM University provides a dynamic environment where students are empowered to explore their potential, challenge ideas, and make meaningful contributions to society.';
echo 'Our academic programs are designed to blend cutting-edge knowledge with real-world application, ensuring our graduates are not only career-ready but also equipped to make a lasting impact in their chosen fields. With a dedicated faculty, modern facilities, and a culture that fosters creativity and collaboration, JSM University stands as a hub of knowledge, research, and innovation.';
echo 'Above all, we are committed to nurturing minds and inspiring futures—helping every student discover their path and achieve their vision.';
echo '</p>';

// GROUP DETAILS
echo '<div class="containerdetails">';
echo '<h2>GROUP Details</h2>';
echo '<p><strong>Group Name:</strong>JSM</p>';
echo '<p><strong>Meeting Location:</strong> John St, Hawthorn VIC 3122, BA513 Business & Arts</p>';
echo '<p><strong>Lecturer:</strong> Dr. Atie Kia</p>';
echo '<p><strong>Lab Tutor:</strong> Dr. Atie Kia</p>';
echo '<p><strong>Meeting Times(Day & Time):</strong></p>';
echo '<ul>';
echo '<li>Tuesday<ul><li>12:30PM – 2:30PM</li></ul></li>';
echo '<li>Thursday<ul><li>10:30AM – 12:30PM</li></ul></li>';
echo '</ul>';
echo '<img src="images/group_photo.jpg" alt="JSM Team Photo" class="group-photo">';
echo '</div>';

// OUR TEAM
echo '<h2 class="team"><strong>OUR TEAM</strong></h2>';
echo '<aside id="teaminfo">';
echo '<h3><strong>Student ID\'s</strong></h3>';
echo '<ul>';

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
	
	$sql = "SELECT * FROM Role WHERE MemberID = '" . $member['MemberID'] . "'";
	$roles = mysqli_query($conn, $sql);
	
	while ($role = mysqli_fetch_assoc($roles)) {
		echo '<p><strong>Role: </strong>' . $role['Description'] . '</p>';
	}
	
	echo '<p><strong>Contributions:</strong></p>';
	echo '<ul>';
	echo '<li><strong>Individual Responsibility:</strong>NEED TO DYNAMISE</li>';
    echo '<li><strong>Shared Responsibilities:</strong>NEED TO DYNAMISE</li>';
	echo '</ul>';
	echo '<p><strong>Favourite Hobbies:</strong></p>';
	echo '<ul>';
	
	$sql = "SELECT * FROM Hobby WHERE MemberID = '" . $member['MemberID'] . "'";
	$hobbies = mysqli_query($conn, $sql);
	
	while ($hobby = mysqli_fetch_assoc($hobbies)) {
		echo '<li>' . $hobby['Description'] . '</li>';
	}
	
	echo '</ul>';
	echo '<p><strong>Favourite Language</strong>: ' . $member['FavLanguage'] . '</p>';
	echo '<p><strong>Favourite Quote in ' . $member['FavLanguage'] . ': </strong> \"' . $member['FavQuote'] . '"</p>';
    echo '</div>';
}	

mysqli_close($conn);

include 'footer.inc';

?>