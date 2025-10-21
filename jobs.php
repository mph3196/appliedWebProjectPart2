<?php

$currentPage = 'jobs';
$pageTitle = 'JSM Jobs Applications Page';
$pageDescription = 'Careers page for JSM website';
$pageHeading = 'Careers - Positions Available';

include 'header.inc';
include 'nav.inc';

require_once 'settings.php';
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT RefNo, Title, Salary, ReportsTo, ShortDescription FROM Jobs ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
?>

  <aside> <!--Required aside -->
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

if (mysqli_num_rows($result) > 0) {
    // Loop through each job record
    while ($job = mysqli_fetch_assoc($result)) {
        $refNo = $job['RefNo'];
?>

    <section class="jobscontainer"> <div class="header"><?php echo $job['Title']; ?></div> <h2>Reference Number: <?php echo $refNo; ?></h2> <p><strong>Salary:</strong> <?php echo $job['Salary']; ?></p> 
        <p><strong>Reports to:</strong> <?php echo $job['ReportsTo']; ?></p> 
        <p><strong>Short Description:</strong> <?php echo $job['ShortDescription']; ?></p> 

        <h3>Key Responsibilities</h3> 
        <ul>
        <?php
            // Display Key Responsibilities
            $sql_resp = "SELECT Description FROM JobResponsibility WHERE RefNo = '$refNo' ORDER BY RespID ASC";
            $responsibilities = mysqli_query($conn, $sql_resp);
            
            while ($resp = mysqli_fetch_assoc($responsibilities)) {
                echo '<li>' . $resp['Description'] . '</li>';
            }
        ?>
        </ul>

        <h3>Essential Requirements</h3> 
        <ol> 
        <?php
            // Display Essential Requirements
            $sql_ess = "SELECT Description FROM JobEssential WHERE RefNo = '$refNo' ORDER BY EssentialID ASC";
            $essentials = mysqli_query($conn, $sql_ess);
            
            while ($req = mysqli_fetch_assoc($essentials)) {
                echo '<li>' . $req['Description'] . '</li>';
            }
        ?>
        </ol>

        <?php
            // Display Preferable Requirements
            $sql_pref = "SELECT Description FROM JobPreferable WHERE RefNo = '$refNo' ORDER BY PreferableID ASC";
            $preferables = mysqli_query($conn, $sql_pref);
            
            // Only display the heading/list if there are preferable requirements
            if (mysqli_num_rows($preferables) > 0) {
                echo '<h3>Preferable Requirements</h3>';
                echo '<ul>';
                while ($pref = mysqli_fetch_assoc($preferables)) {
                    echo '<li>' . $pref['Description'] . '</li>';
                }
                echo '</ul>';
            }
        ?>

        <p class="apply-button">
            <a href="apply.php">Apply Now</a>
        </p>
    </section>

<?php
    } 
} 

// Close the database connection
mysqli_close($conn);

include 'footer.inc';
?>