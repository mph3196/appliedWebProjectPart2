<?php
require_once 'settings.php';

$currentPage = 'about';
$pageTitle = 'JSM About Us Page';
$pageDescription = 'About page for JSM University';
$pageHeading = 'About Us';

include 'header.inc';
include 'nav.inc';

// Disable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_OFF);
// Establish connection to MySQL database
$conn = @mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    echo "<div class='container'>";
    echo "<h1>Database Connection Error</h1>";
    echo "<p>Sorry, we are unable to retrieve job listings at the moment. Please try again later.</p>";
    echo "<p>Debug info: " . mysqli_connect_error() . "</p>";
    include 'footer.inc';
    exit;
}
if (!$conn) {
    echo "<p>Connection failed: " . mysqli_connect_error() . "</p>";
}
?>

<h1><strong>Who are We</strong></h1> 
<p class="aboutus">
At JSM University, we are more than just a place of learning—we are a community committed to shaping future leaders, innovators, and changemakers. Founded on the values of excellence, integrity, and inclusivity, JSM University provides a dynamic environment where students are empowered to explore their potential, challenge ideas, and make meaningful contributions to society.
Our academic programs are designed to blend cutting-edge knowledge with real-world application, ensuring our graduates are not only career-ready but also equipped to make a lasting impact in their chosen fields. With a dedicated faculty, modern facilities, and a culture that fosters creativity and collaboration, JSM University stands as a hub of knowledge, research, and innovation.
Above all, we are committed to nurturing minds and inspiring futures—helping every student discover their path and achieve their vision.
</p>

<div class="containerdetails">
    <h2>GROUP Details</h2>
    <p><strong>Group Name:</strong> JSM</p>
    <p><strong>Meeting Location:</strong> John St, Hawthorn VIC 3122, BA513 Business & Arts</p>
    <p><strong>Lecturer:</strong> Dr. Atie Kia</p>
    <p><strong>Lab Tutor:</strong> Dr. Atie Kia</p>
    <p><strong>Meeting Times (Day & Time):</strong></p>
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

<h2 class="team"><strong>OUR TEAM</strong></h2>

<aside id="teaminfo">
    <h3><strong>Student ID's</strong></h3>
    <ul>
        <?php
        $sql = "SELECT * FROM Member";
        $members = mysqli_query($conn, $sql);

        while ($member = mysqli_fetch_assoc($members)) {
            echo "<li>{$member['FullName']} - {$member['MemberID']}</li>";
        }
        ?>
    </ul>
</aside>

<?php
// Display each team member's details
$sql = "SELECT * FROM Member";
$members = mysqli_query($conn, $sql);

while ($member = mysqli_fetch_assoc($members)) {
    echo '<div class="container">';
    echo "<div class=\"header\"><strong>{$member['FullName']}</strong></div>";
    echo "<p>{$member['Bio']}</p>";

    // Roles
    $sqlRoles = "SELECT * FROM Role WHERE MemberID = '{$member['MemberID']}'";
    $roles = mysqli_query($conn, $sqlRoles);
    while ($role = mysqli_fetch_assoc($roles)) {
        echo "<p><strong>Role:</strong> {$role['Description']}</p>";
    }

    // Contributions
    echo "<strong>Contributions:</strong>";
    echo "<ul>";
    $sqlTasks = "
        SELECT t.Description 
        FROM Contribution c 
        JOIN Task t ON c.TaskID = t.TaskID 
        WHERE c.MemberID = {$member['MemberID']}
    ";
    $tasks = mysqli_query($conn, $sqlTasks);
    while ($task = mysqli_fetch_assoc($tasks)) {
        echo "<li>{$task['Description']}</li>";
    }
    echo "</ul>";

    // Hobbies
    echo "<strong>Hobbies:</strong>";
    echo "<ul>";
    $sqlHobbies = "SELECT * FROM Hobby WHERE MemberID = '{$member['MemberID']}'";
    $hobbies = mysqli_query($conn, $sqlHobbies);
    while ($hobby = mysqli_fetch_assoc($hobbies)) {
        echo "<li>{$hobby['Description']}</li>";
    }
    echo "</ul>";

    // Favourite Language & Quote
    echo "<p><strong>Favourite Language:</strong> {$member['FavLanguage']}</p>";
    echo "<p><strong>Favourite Quote in {$member['FavLanguage']}:</strong> 
      <span lang=\"{$member['LangCode']}\">\"{$member['FavQuote']}\"</span></p>";

    echo "</div>"; // end container
}
?>

<h2 id="funfacts"><strong>Fun Facts</strong></h2>
<div class="card" role="region" aria-label="Fun facts about three people">
    <table class="funfacttable">
        <caption>Fun facts — facts about our team</caption>
        <tr>
            <th scope="col"></th>
            <th scope="col">Dream Job</th>
            <th scope="col">Coding Snack</th>
            <th scope="col">Favourite Programming Language</th>
        </tr>
        <tbody>
            <?php
            $sql = "SELECT * FROM Member";
            $members = mysqli_query($conn, $sql);

            echo "<tr>";
            while ($member = mysqli_fetch_assoc($members)) {
                echo "<td><strong>{$member['FullName']}</strong></td>";
                echo "<td>{$member['DreamJob']}</td>";
                echo "<td>{$member['CodingSnack']}</td>";
                echo "<td>{$member['ProgLang']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
mysqli_close($conn);
include 'footer.inc';
?>
