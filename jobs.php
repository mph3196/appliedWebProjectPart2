<?php
$currentPage = 'jobs'; 
$pageTitle = 'JSM Jobs Applications Page'; 
$pageDescription = 'Careers page for JSM website'; 
$pageHeading = 'Careers - Positions Available'; 

// Include HTML Components 
include 'header.inc'; 
include 'nav.inc'; 

// Import Database
require_once 'settings.php';

// Establish connection to MySQL database
$conn = mysqli_connect($host, $user, $password, $database);

// Error handling
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//SQL query to retrieve basic job information from Jobs table and store result
$sql = "SELECT RefNo, Title, Salary, ReportsTo, ShortDescription FROM Jobs ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
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
    // Main Loop
while ($job = mysqli_fetch_assoc($result)) {
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
            // Query to fetch all responsibilities for the job
            $sql_resp = "SELECT Description FROM JobResponsibility WHERE RefNo = '$refNo' ORDER BY RespID ASC";

            // Execute responsibility query
            $responsibilities = mysqli_query($conn, $sql_resp);
            
            // Loop through all responsibility records for the job
            while ($resp = mysqli_fetch_assoc($responsibilities)) {
                echo '<li>' . $resp['Description'] . '</li>';
            }
        ?>
        </ul>

       <!-- Essential Requirements -->
        <h3>Essential Requirements</h3> 
        <ol> 
        <?php
            // Query to fetch all essential requirements for the job
            $sql_ess = "SELECT Description FROM JobEssential WHERE RefNo = '$refNo' ORDER BY EssentialID ASC";

            // Execute essential requirements query
            $essentials = mysqli_query($conn, $sql_ess);
            
            // Loop through all essential requirement records for the job
            while ($req = mysqli_fetch_assoc($essentials)) {
                echo '<li>' . $req['Description'] . '</li>'; 
            }
        ?>
        </ol>

       <!-- Preferable Requirements -->
        <h3>Preferable Requirements</h3> 
        <ul>
        <?php
            // Query to fetch all preferable requirements for the job
            $sql_pref = "SELECT Description FROM JobPreferable WHERE RefNo = '$refNo' ORDER BY PreferableID ASC";

            // Execute preferable requirements query
            $preferables = mysqli_query($conn, $sql_pref);
                           
                // Loop through all preferable requirement records for the job
                while ($pref = mysqli_fetch_assoc($preferables)) {
                    echo '<li>' . $pref['Description'] . '</li>';
                } 
        ?>
        </ul>

        <p class="apply-button"> <!-- Apply Button -->
            <a href="apply.php">Apply Now</a>
        </p>

    </section> <!-- End of jobs -->

<?php

    }  // End of while loop 

mysqli_close($conn); // Close Database Connection

include 'footer.inc'; // Include Footer 

?>