<?php
// Define Specific Page Variables
$currentPage = 'jobs'; 
$pageTitle = 'JSM Jobs Applications Page'; 
$pageDescription = 'Careers page for JSM website'; 
$pageHeading = 'Careers - Positions Available'; 

// Include HTML Components 
include 'header.inc'; 
include 'nav.inc'; 

// Import Database
require_once 'settings.php';

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

//  Fetch all Data Required 

$sql_jobs = "SELECT RefNo, Title, Salary, ReportsTo, ShortDescription FROM Jobs ORDER BY id"; 
$jobs_result = mysqli_query($conn, $sql_jobs);

$sql_resp = "SELECT RefNo, Description FROM JobResponsibility ORDER BY RefNo, RespID"; 
$resp_result = mysqli_query($conn, $sql_resp);

$sql_ess = "SELECT RefNo, Description FROM JobEssential ORDER BY RefNo, EssentialID"; 
$ess_result = mysqli_query($conn, $sql_ess);

$sql_pref = "SELECT RefNo, Description FROM JobPreferable ORDER BY RefNo, PreferableID"; 
$pref_result = mysqli_query($conn, $sql_pref);


//  Organise Data in Arrays 

$responsibilities = []; 
while ($row = mysqli_fetch_assoc($resp_result)) {
    $responsibilities[$row['RefNo']][] = $row['Description']; }

$essentials = []; 
while ($row = mysqli_fetch_assoc($ess_result)) {
    $essentials[$row['RefNo']][] = $row['Description']; }

$preferables = []; 
while ($row = mysqli_fetch_assoc($pref_result)) {
    $preferables[$row['RefNo']][] = $row['Description']; }
?>

<aside> 
    <h2>Why Work With Us?</h2>
        <p>At JSM University, we are committed to advancing digital learning and research. 
        Our IT team collaborates with educators, researchers, and students to deliver 
        accessible, secure, and innovative digital solutions.</p>
        
        <p><strong>Why choose us?</strong> We offer competitive salaries, professional development opportunities, 
        and the chance to work with cutting-edge technology. Our collaborative environment encourages 
        innovation and continuous learning, making it the perfect place to grow your career in educational technology.</p>
        
        <p>Join a team that values work-life balance, supports remote work options, and provides 
        comprehensive health benefits. Together, we're shaping the future of digital education.</p>
        <h3>Our Benefits</h3>
    <ul>
        <li>Flexible working arrangements</li>
        <li>Professional development budget</li>
        <li>Health and wellness programs</li>
        <li>University study discounts</li>
        <li>Collaborative team environment</li>
    </ul>

    <h3>Quick Facts</h3>
    <div style="border-radius: 5px; margin: 0;">
        <p><strong>Location:</strong> Melbourne Campus</p>
        <p><strong>Team Size:</strong> 50+ IT Professionals</p>
        <p><strong>Founded:</strong> 1995</p>
        <p><strong>Open Positions:</strong> 4 Available</p>
    </div>

    <h3>Application Tips</h3>
    <div style="background-color: #444754; color: white; padding: 15px; border-radius: 5px;">
        <p><strong>Pro Tip:</strong> Highlight your experience with educational technology and your passion for digital learning in your application!</p>
    </div>
</aside>

<?php

//  Display all Jobs 

while ($job = mysqli_fetch_assoc($jobs_result)) { // Fetches one row as an associative array.
    $refNo = $job['RefNo']; 
?>
    <!-- Job Section -->
    <section class="jobscontainer"> 

    <!-- Job Title Header -->   
    <div class="header"><?php echo $job['Title']; ?></div> 

     <!-- Basic Job Information -->
    <h2>Reference Number: <?php echo $refNo; ?></h2> 
    <p><strong>Salary:</strong> <?php echo $job['Salary']; ?></p> 
    <p><strong>Reports to:</strong> <?php echo $job['ReportsTo']; ?></p> 
    <p><strong>Short Description:</strong> <?php echo $job['ShortDescription']; ?></p> 

<!-- Key Responsibilities -->
        <h3>Key Responsibilities</h3> 
        <ul>
        <?php
            if (isset($responsibilities[$refNo])) {
                foreach ($responsibilities[$refNo] as $resp) {
                    echo '<li>' . $resp . '</li>';
                }
            }
        ?>
        </ul>

        <!-- Essential Requirements -->
        <h3>Essential Requirements</h3> 
        <ol> 
        <?php
            if (isset($essentials[$refNo])) {
                foreach ($essentials[$refNo] as $ess) {
                    echo '<li>' . $ess . '</li>';
                }
            }
        ?>
        </ol>

        <!-- Preferable Requirements -->
        <h3>Preferable Requirements</h3> 
        <ul>
        <?php
            if (isset($preferables[$refNo])) {
                foreach ($preferables[$refNo] as $pref) {
                    echo '<li>' . $pref . '</li>';
                }
            }
        ?>
        </ul>

        <p class="apply-button">
            <a href="apply.php?refNo=<?php echo $refNo; ?>">Apply Now</a>
        </p>

    </section> 

<?php
}  // End of while loop 

mysqli_close($conn); // Close Database Connection

include 'footer.inc'; 

// NOTE: Incorporated work referenced to https://www.w3schools.com/php/
?>
