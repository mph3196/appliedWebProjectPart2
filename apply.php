<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirected to the login page
    header('Location: login.php?error=You must log in to submit an application.');
    exit;
}
$userId = $_SESSION['user_id'];
$currentPage = 'apply';
$pageTitle = 'JSM University Job Applications';
$pageDescription = 'Applications page for JSM University';
$pageHeading = 'Apply';

include 'header.inc';
include 'nav.inc';
?>

<!-- Keep all your apply.html content here -->
<div class="container" id="apply-container">
  <p>Thank you for your interest in working with us at JSM University!</p>
</div>

<div class="form-container">
  <h2>Job Application Form</h2>
  <form id="jobApplicationForm" action="https://mercury.swin.edu.au/it000000/formtest.php" method="POST">
    <?php
            if (isset($_GET['error'])) { ?>
              <p class='error'><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php } ?>
<!-- Job Reference Number -->
        <div class="form-group">
          <label for="refNo">Job Reference Number <span class="required">*</span></label>
          <input type="text" id="refNo" name="refNo" pattern="[A-Za-z0-9]{5}"
          title="Enter your 5 character Job Reference Number" minlength="5" maxlength="5">
        </div>
        
        <!-- Personal Details -->
         <fieldset>
          <legend>Personal Details</legend>
          <div class="two-column">
            <div class="form-group">
              <label for="firstName">First Name <span class="required">*</span></label>
              <input type="text" id="firstName" name="firstName" title="Enter your first name, maximum 20 letters">
            </div>
            
            <div class="form-group">
              <label for="lastName">Last Name <span class="required">*</span></label>
              <input type="text" id="lastName" name="lastName" title="Enter your last name, maximum 20 characters">
            </div>
          </div>
          
          <!-- Date of Birth -->
          <div class="form-group">
            <label for="dob">Date of Birth <span class="required">*</span></label>
            <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy" title="Enter your date of birth in dd/mm/yyyy format">
          </div>
        </fieldset>
        
        <!-- Gender -->
        <fieldset>
          <legend>Gender <span class="required">*</span></legend>
          <div class="radio-group">
            <label class="radio-container">
              <input type="radio" id="male" name="gender" value="male">
              Male
              <span class="radio-button"></span>
            </label>
            
            <label class="radio-container">
              <input type="radio" id="female" name="gender" value="female">
              Female
              <span class="radio-button"></span>
            </label>
            
            <label class="radio-container">
              <input type="radio" id="other" name="gender" value="other">
              Other
              <span class="radio-button"></span>
            </label>
            
            <label class="radio-container">
              <input type="radio" id="preferNotToSay" name="gender" value="preferNotToSay">
              Prefer not to say
              <span class="radio-button"></span>
            </label>
          </div>
        </fieldset>

        <fieldset>
          <legend>Contact Information</legend>
          <!-- Address -->
          <div class="form-group">
            <label for="address">Street Address <span class="required">*</span></label>
            <input type="text" id="address" name="address" required title="Enter your street address" maxlength="40" >
          </div>
          
          <div class="two-column">
            <div class="form-group">
              <label for="suburb">Suburb <span class="required">*</span></label>
              <input type="text" id="suburb" name="suburb" required
              title="Enter your suburb" maxlength="40">
            </div>
              
            <div class="two-column">
              <div class="form-group">
                <label for="postcode">Postcode <span class="required">*</span></label>
                <input type="text" id="postcode" name="postcode" required pattern="[0-9]{4}"
                title="Enter your postcode (exactly 4 digits)" minlength="4" maxlength="4">
              </div>

              <div class="form-group">
                <label for="state">State <span class="required">*</span></label>
                <select id="state" name="state" required>
                  <option value="">Please select</option>
                  <option value="VIC">VIC</option>
                  <option value="NSW">NSW</option>
                  <option value="QLD">QLD</option>
                  <option value="NT">NT</option>
                  <option value="WA">WA</option>
                  <option value="SA">SA</option>
                  <option value="TAS">TAS</option>
                  <option value="ACT">ACT</option>
                </select>
              </div>
            </div>
          </div>
          
          <!-- Contact Information -->
          <div class="two-column">
            <div class="form-group">
              <label for="email">Email <span class="required">*</span></label>
              <input type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              title="Enter a valid email address (e.g.: user@jsm.com)" placeholder="eg. you@email.com">
            </div>
            
            <div class="form-group">
              <label for="phone">Phone Number <span class="required">*</span></label>
              <input type="text" id="phone" name="phone" required pattern="[0-9]{8,12}"
              title="Enter a phone number between 8 and 12 digits" minlength="8" maxlength="12">
            </div>
          </div>
        </fieldset>
        
        <!-- Skills -->
        <fieldset>
          <legend>Skills</legend>
          <div class="checkbox-group">
            <label class="checkmark-container">
              <input type="checkbox" id="skill1" name="skills" value="communication">
              Communication
              <span class="checkmark"></span>
            </label>
            
            <label class="checkmark-container">
              <input type="checkbox" id="skill2" name="skills" value="teamwork">
              Teamwork
              <span class="checkmark"></span>
            </label>
            
            <label class="checkmark-container">
              <input type="checkbox" id="skill3" name="skills" value="problemSolving">
              Problem Solving
              <span class="checkmark"></span>
            </label>
            
            <label class="checkmark-container">
              <input type="checkbox" id="skill4" name="skills" value="leadership">
              Leadership
              <span class="checkmark"></span>
            </label>
            
            <label class="checkmark-container">
              <input type="checkbox" id="otherSkills" name="skills" value="other">
              Other skills
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="form-group">
            <label for="otherSkillsText">Please specify other skills:</label>
            <textarea id="otherSkillsText" name="otherSkillsText" rows="4" title="Specify other skills here"></textarea>
          </div>
        </fieldset>
        
        <div class="form-buttons">
          <button type="reset" id="reset" title="Clear this form">Clear Form</button>
          <button type="submit" id="submit" title="Submit your application">Submit Application</button>
        </div>
        <span class="required" id="requiredNote" style="font-style: italic;">* Fields are required</span>
      </form>
    </div>
<?php include 'footer.inc'; ?>