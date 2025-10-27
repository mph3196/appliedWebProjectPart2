<?php
// Start the session
session_start();
require_once 'settings.php';

// Page meta settings
$currentPage = 'apply';
$pageTitle = 'JSM University Job Applications';
$pageDescription = 'Applications page for JSM University';
$pageHeading = 'Apply';

// Include header and nav bar
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
    echo "<p>Sorry, we are unable to take applications at this time. Please try again later.</p>";
    echo "<p>Debug info: " . mysqli_connect_error() . "</p>";
    include 'footer.inc';
    exit;
}

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirected to the login page
    header('Location: login.php?error=You must log in to submit an application.');
    exit;
}

$userId = $_SESSION['user_id'];

// Check for redirect from jobs page
if (isset($_GET['refNo'])) {
    // If we have a refNo from GET, ensure we preserve it
    if (!isset($_SESSION['form_data'])) {
        $_SESSION['form_data'] = array();
    }
    $_SESSION['form_data']['refNo'] = $_GET['refNo'];
}


// Get the user's name
$sql = "SELECT name FROM User WHERE id = $userId";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
} else {
    $name = "";
}

// Get form data from session if it exists
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

?>

<div class="container" id="apply-container">
    <p>Thank you for your interest in working with us at JSM University!</p>
</div>

<div class="form-container">
    <h2>Job Application Form</h2>
    <form id="jobApplicationForm" action="process_eoi.php" method="POST">
        <?php
        // Display error from session
        if (!empty($error)) { ?>
            <p class='error'><?php echo htmlspecialchars($error); ?></p>
        <?php
            $_SESSION['error'] = '';
        }
        ?>
        
        <!-- Form will be populated with data from user session if incomplete -->
        <!-- Job Reference Number -->
        <div class="form-group">
            <label for="refNo">Job Reference Number <span class="required">*</span></label>
            <input type="text" id="refNo" name="refNo" pattern="[A-Za-z0-9]{5}"
                title="Enter your 5 character Job Reference Number" minlength="5" maxlength="5"
                value="<?php echo isset($form_data['refNo']) ? htmlspecialchars($form_data['refNo']) : ''; ?>">
        </div>
        
        <!-- Personal Details -->
        <fieldset>
            <legend>Personal Details</legend>
            <div class="two-column">
                <div class="form-group">
                    <label for="firstName">First Name <span class="required">*</span></label>
                    <input type="text" id="firstName" name="firstName" 
                        title="Enter your first name, maximum 20 letters"
                        value="<?php echo htmlspecialchars($form_data['firstName'] ?? $name ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="lastName">Last Name <span class="required">*</span></label>
                    <input type="text" id="lastName" name="lastName" title="Enter your last name, maximum 20 characters"
                        value="<?php echo isset($form_data['lastName']) ? htmlspecialchars($form_data['lastName']) : ''; ?>">
                </div>
            </div>
            
            <!-- Date of Birth -->
            <div class="form-group">
                <label for="dob">Date of Birth <span class="required">*</span></label>
                <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy" title="Enter your date of birth in dd/mm/yyyy format"
                    value="<?php echo isset($form_data['dob']) ? htmlspecialchars($form_data['dob']) : ''; ?>">
            </div>
        </fieldset>
        
        <!-- Gender -->
        <fieldset>
            <legend>Gender <span class="required">*</span></legend>
            <div class="radio-group">
                <label class="radio-container">
                    <input type="radio" id="male" name="gender" value="male" 
                        <?php echo (isset($form_data['gender']) && $form_data['gender'] == 'male') ? 'checked' : ''; ?>>
                    Male
                    <span class="radio-button"></span>
                </label>
                
                <label class="radio-container">
                    <input type="radio" id="female" name="gender" value="female"
                        <?php echo (isset($form_data['gender']) && $form_data['gender'] == 'female') ? 'checked' : ''; ?>>
                    Female
                    <span class="radio-button"></span>
                </label>
                
                <label class="radio-container">
                    <input type="radio" id="other" name="gender" value="other"
                        <?php echo (isset($form_data['gender']) && $form_data['gender'] == 'other') ? 'checked' : ''; ?>>
                    Other
                    <span class="radio-button"></span>
                </label>
                
                <label class="radio-container">
                    <input type="radio" id="preferNotToSay" name="gender" value="preferNotToSay"
                        <?php echo (isset($form_data['gender']) && $form_data['gender'] == 'preferNotToSay') ? 'checked' : ''; ?>>
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
                <input type="text" id="address" name="address" title="Enter your street address"
                    value="<?php echo isset($form_data['address']) ? htmlspecialchars($form_data['address']) : ''; ?>">
            </div>
            
            <div class="two-column">
                <div class="form-group">
                    <label for="suburb">Suburb <span class="required">*</span></label>
                    <input type="text" id="suburb" name="suburb" title="Enter your suburb"
                        value="<?php echo isset($form_data['suburb']) ? htmlspecialchars($form_data['suburb']) : ''; ?>">
                </div>
                
                <div class="two-column">
                    <div class="form-group">
                        <label for="postcode">Postcode <span class="required">*</span></label>
                        <input type="text" id="postcode" name="postcode" title="Enter your postcode (exactly 4 digits)"
                            value="<?php echo isset($form_data['postcode']) ? htmlspecialchars($form_data['postcode']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="state">State <span class="required">*</span></label>
                        <select id="state" name="state">
                            <option value="">Please select</option>
                            <option value="VIC" <?php echo (isset($form_data['state']) && $form_data['state'] == 'VIC') ? 'selected' : ''; ?>>VIC</option>
                            <option value="NSW" <?php echo (isset($form_data['state']) && $form_data['state'] == 'NSW') ? 'selected' : ''; ?>>NSW</option>
                            <option value="QLD" <?php echo (isset($form_data['state']) && $form_data['state'] == 'QLD') ? 'selected' : ''; ?>>QLD</option>
                            <option value="NT" <?php echo (isset($form_data['state']) && $form_data['state'] == 'NT') ? 'selected' : ''; ?>>NT</option>
                            <option value="WA" <?php echo (isset($form_data['state']) && $form_data['state'] == 'WA') ? 'selected' : ''; ?>>WA</option>
                            <option value="SA" <?php echo (isset($form_data['state']) && $form_data['state'] == 'SA') ? 'selected' : ''; ?>>SA</option>
                            <option value="TAS" <?php echo (isset($form_data['state']) && $form_data['state'] == 'TAS') ? 'selected' : ''; ?>>TAS</option>
                            <option value="ACT" <?php echo (isset($form_data['state']) && $form_data['state'] == 'ACT') ? 'selected' : ''; ?>>ACT</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="two-column">
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" title="Enter a valid email address (e.g.: user@jsm.com)" 
                        placeholder="eg. you@email.com"
                        value="<?php echo isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number <span class="required">*</span></label>
                    <input type="text" id="phone" name="phone" title="Enter a phone number between 8 and 12 digits"
                        value="<?php echo isset($form_data['phone']) ? htmlspecialchars($form_data['phone']) : ''; ?>">
                </div>
            </div>
        </fieldset>
        
        <!-- Skills -->
        <fieldset>
            <legend>Skills</legend>
            <div class="checkbox-group">
                <label class="checkmark-container">
                    <input type="checkbox" id="skill1" name="skills[]" value="communication"
                        <?php echo (isset($form_data['skills']) && in_array('communication', $form_data['skills'])) ? 'checked' : ''; ?>>
                    Communication
                    <span class="checkmark"></span>
                </label>
                
                <label class="checkmark-container">
                    <input type="checkbox" id="skill2" name="skills[]" value="teamwork"
                        <?php echo (isset($form_data['skills']) && in_array('teamwork', $form_data['skills'])) ? 'checked' : ''; ?>>
                    Teamwork
                    <span class="checkmark"></span>
                </label>
                
                <label class="checkmark-container">
                    <input type="checkbox" id="skill3" name="skills[]" value="problemSolving"
                        <?php echo (isset($form_data['skills']) && in_array('problemSolving', $form_data['skills'])) ? 'checked' : ''; ?>>
                    Problem Solving
                    <span class="checkmark"></span>
                </label>
                
                <label class="checkmark-container">
                    <input type="checkbox" id="skill4" name="skills[]" value="leadership"
                        <?php echo (isset($form_data['skills']) && in_array('leadership', $form_data['skills'])) ? 'checked' : ''; ?>>
                    Leadership
                    <span class="checkmark"></span>
                </label>
                
                <label class="checkmark-container">
                    <input type="checkbox" id="otherSkills" name="skills[]" value="other"
                        <?php echo (isset($form_data['skills']) && in_array('other', $form_data['skills'])) ? 'checked' : ''; ?>>
                    Other skills
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group">
                <label for="otherSkillsText">Please specify other skills:</label>
                <textarea id="otherSkillsText" name="otherSkillsText" rows="4" title="Specify other skills here"><?php echo isset($form_data['otherSkillsText']) ? htmlspecialchars($form_data['otherSkillsText']) : ''; ?></textarea>
            </div>
        </fieldset>
        
        <div class="form-buttons">
            <button type="submit" id="reset" title="Clear this form" formaction="clear_eoi_form.php">Clear Form</button>
            <button type="submit" id="submit" title="Submit your application">Submit Application</button>
        </div>
        <span class="required" id="requiredNote" style="font-style: italic;">* Fields are required</span>
    </form>
</div>

<?php 
// Include footer
include 'footer.inc'; 
?>
