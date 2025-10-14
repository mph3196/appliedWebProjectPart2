<?php

$currentPage = 'jobs';
$pageTitle = 'JSM Jobs Applications Page';
$pageDescription = 'Careers page for JSM website';
$pageHeading = 'Careers - Positions Available';

include 'header.inc';
include 'nav.inc';

require_once 'settings.php'; // Connect to database
$conn = new mysqli($host, $user, $password, $database); // Create connection
$sql = "SELECT * FROM jobs ORDER BY id ASC";// Fetch all jobs from database
$result = $conn->query($sql);
$jobs = [];// Store jobs in array
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}
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

<!-- =============================-->
<!-- Below lists 4 'applications', each structured within a section jobscontainer class. The reference number is within a header class and the apply button within the apply-button class -->
<!-- All information regarding JSM University content within the jobs container credited to The Claude AI LLM: https://claude.ai/new -->
<!-- Requirements state "one ordered list, one unordered list" - Assumed this meant per section / jobs container application -->
<!-- =============================-->

  <!-- Application 1 -->
  <section class="jobscontainer"> <!-- Section -->
    <div class="header">IT Support Officer</div> <!-- Title --> <!-- Heading of one level -->
    <h2>Reference Number: G03A1</h2> <!-- Reference number (5 alphanumeric) -->

    <p><strong>Salary:</strong> $78,000 – $85,000 per annum</p>  <!-- Salary -->
    <p><strong>Reports to:</strong> Manager, Digital Learning & Research Support</p>  <!-- Reporting Line -->
    <p><strong>Short Description:</strong> Join our IT department to provide  <!-- Short Description -->
      frontline support for digital learning platforms and research technologies 
      that enhance teaching, learning, and innovation.
    </p>

    <h3>Key Responsibilities</h3> <!-- Key Responsibilities --> <!-- Heading of another level -->
    <ul> <!-- Unordered list. -->
      <li>Provide technical support for digital learning platforms (LMS, collaboration tools).</li>
      <li>Assist researchers with software, data storage, and secure computing resources.</li>
      <li>Maintain system documentation and user guides.</li>
      <li>Ensure accessibility and compliance with IT security policies.</li>
    </ul>

    <h3>Essential Requirements</h3> <!-- Essential Requirements -->
    <ol> <!-- Ordered list, -->
      <li>Bachelor’s degree in Information Technology or related field.</li>
      <li>Experience supporting digital learning or research systems.</li>
      <li>Strong communication and problem-solving skills.</li>
    </ol>

    <h3>Preferable Requirements</h3> <!-- Preferable Requirements -->
    <ul>
      <li>Knowledge of accessibility standards in digital education.</li>
      <li>Experience with cloud-based platforms (e.g., Microsoft Azure, AWS).</li>
      <li>Familiarity with research data management practices.</li>
    </ul>

    <p class="apply-button">
      <a href="apply.html">Apply Now</a>
    </p>
  </section>
  <!-- End of Application 1 -->

  <!-- Application 2 -->
  <section class="jobscontainer">  <!-- Section -->
    <div class="header">Research Data Analyst</div> <!-- Title --> <!-- Heading of one level -->
    <h2>Reference Number: G03C3</h2> <!-- Reference number (5 alphanumeric) -->

    <p><strong>Salary:</strong> $88,000 – $95,000 per annum</p> <!-- Salary -->
    <p><strong>Reports to:</strong> Senior Research IT Coordinator</p> <!-- Reporting Line -->
    <p><strong>Short Description:</strong> Provide data management, analytics, and visualization support for academic research projects.</p> <!-- Short Description -->
 
    <h3>Key Responsibilities</h3> <!-- Key Responsibilities --> <!-- Heading of another level -->
    <ul> <!-- Unordered list. -->
      <li>Support researchers with secure data storage solutions.</li>
      <li>Assist in statistical analysis and visualization.</li>
      <li>Ensure compliance with data security and ethics requirements.</li>
    </ul>

    <h3>Essential Requirements</h3>  <!-- Essential Requirements -->
    <ol> <!-- Ordered list, -->
      <li>Bachelor’s Degree in Data Science, Statistics, or IT.</li>
      <li>Experience with R, Python, or SPSS.</li>
    </ol>

    <h3>Preferable Requirements</h3> <!-- Preferable Requirements -->
    <ul>
      <li>Knowledge of big data tools (Hadoop, Spark).</li>
      <li>Experience in higher education research projects.</li>
    </ul>

    <p class="apply-button">
      <a href="apply.html">Apply Now</a>
    </p>
  </section>
  <!-- End of Application 2 -->

  <!-- Application 3 -->
  <section class="jobscontainer"> <!-- Section -->
    <div class="header">Learning Technology Specialist</div><!-- Title --> <!-- Heading of one level --> 
    <h2>Reference Number: G03B2</h2> <!-- Reference number (5 alphanumeric) -->

    <p><strong>Salary:</strong> $82,000 – $90,000 per annum</p>  <!-- Salary -->
    <p><strong>Reports to:</strong> Manager, Digital Learning & Research Support</p> <!-- Reporting Line -->
    <p><strong>Short Description:</strong> Support academics in designing and delivering online and blended learning experiences using the university’s digital platforms.</p> <!-- Short Description -->

    <h3>Key Responsibilities</h3> <!-- Key Responsibilities --> <!-- Heading of another level -->
    <ul> <!-- Unordered list. -->
      <li>Train staff in effective use of the Learning Management System (LMS).</li>
      <li>Collaborate on course design to ensure accessibility and engagement.</li>
      <li>Evaluate and recommend new learning technologies.</li>
    </ul>

    <h3>Essential Requirements</h3> <!-- Essential Requirements -->
    <ol> <!-- Ordered list, -->
      <li>Bachelor’s in Education Technology, IT, or similar.</li>
      <li>Experience with LMS platforms (e.g., Canvas, Blackboard).</li>
    </ol>

    <h3>Preferable Requirements</h3> <!-- Preferable Requirements -->
    <ul>
      <li>Knowledge of instructional design frameworks.</li>
      <li>Familiarity with accessibility standards (WCAG).</li>
    </ul>

    <p class="apply-button">
      <a href="apply.html">Apply Now</a>
    </p>
  </section>
  <!-- End of Application 3 -->

  <!-- Application 4 -->
  <section class="jobscontainer"> <!-- Section -->
    <div class="header">Systems Administrator</div> <!-- Title --> <!-- Heading of one level -->
    <h2>Reference Number: G03D4</h2> <!-- Reference number (5 alphanumeric) -->

    <p><strong>Salary:</strong> $92,000 – $105,000 per annum</p> <!-- Salary -->
    <p><strong>Reports to:</strong> Head of IT Infrastructure</p>  <!-- Reporting Line -->
    <p><strong>Short Description:</strong> Maintain and secure the IT infrastructure supporting digital learning and research systems.</p> <!-- Short Description -->

    <h3>Key Responsibilities</h3> <!-- Key Responsibilities --> <!-- Heading of another level -->
    <ul> <!-- Unordered list. -->
      <li>Manage servers, networks, and cloud environments.</li>
      <li>Ensure uptime and security of digital platforms.</li>
      <li>Implement system updates, patches, and backups.</li>
    </ul>

    <h3>Essential Requirements</h3> <!-- Essential Requirements -->
    <ol> <!-- Ordered list, -->
      <li>Bachelor’s Degree in Information Systems or Computer Science.</li>
      <li>Experience with Linux/Windows server administration.</li>
    </ol>

    <h3>Preferable Requirements</h3>  <!-- Preferable Requirements -->
    <ul>
      <li>Knowledge of Cybersecurity frameworks.</li>
      <li>Cloud certification (Azure, AWS, or GCP).</li>
    </ul>

    <p class="apply-button">
      <a href="apply.html">Apply Now</a>
    </p>
  </section>
  <!-- End of Application 4 -->

<?php include 'footer.inc'; ?>