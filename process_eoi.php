<?php
session_start();
$userId = $_SESSION['user_id'];
require_once 'settings.php';

// Prevent direct access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit;
}

// Sanitise script courtesy of Atie Kia (https://github.com/atieasadikia/COS10026-S2-2025/blob/main/lecture07/form.php)
function sanitise_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Store Form Data
    $_SESSION['form_data'] = $_POST;

    // Sanitise form data
    $refNo = sanitise_input($_POST["refNo"]);
    $firstName = sanitise_input($_POST["firstName"]);
    $lastName = sanitise_input($_POST["lastName"]);
    $dob = sanitise_input($_POST["dob"]);
    $gender = sanitise_input($_POST["gender"]);
    $address = sanitise_input($_POST["address"]);
    $suburb = sanitise_input($_POST["suburb"]);
    $postcode = sanitise_input($_POST["postcode"]);
    $state = sanitise_input($_POST["state"]);
    $email = sanitise_input($_POST["email"]);
    $phone = sanitise_input($_POST["phone"]);
    $skills = '';
    if (isset($_POST['skills']) && is_array($_POST['skills'])) {
        $skills = implode(", ", array_map('sanitise_input', $_POST['skills']));
    }
    $otherSkills = sanitise_input($_POST['otherSkillsText']);

    // Validate Form Data

    // Validate Reference Number
    if (empty($refNo)) {
        $_SESSION['error'] = 'Reference Number is required';
        header('Location: apply.php');
        exit;
    }

    if (!preg_match("/^[A-Za-z0-9]{5}$/", $refNo)){
        $_SESSION['error'] = 'Please enter a valid reference number';
        header('Location: apply.php');
        exit; 
    }

    // Validate First Name
    if (empty($firstName)) {
        $_SESSION['error'] = 'Please enter your first name';
        header('Location: apply.php');
        exit;
    }
    
    if (!preg_match("/^[A-Za-z]{1,20}$/", $firstName)){
        $_SESSION['error'] = 'First name must be 1-20 letters only';
        header('Location: apply.php');
        exit; 
    }

    // Validate Last Name
    if (empty($lastName)) {
        $_SESSION['error'] = 'Please enter your last name';
        header('Location: apply.php');
        exit;
    }

    if (!preg_match("/^[A-Za-z]{1,20}$/", $lastName)){
        $_SESSION['error'] = 'Last name must be 1-20 letters only';
        header('Location: apply.php');
        exit; 
    }

    // Validate Date of Birth
    if (empty($dob)) {
        $_SESSION['error'] = 'Please enter your date of birth';
        header('Location: apply.php');
        exit;
    }

    if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/\d{4}$/", $dob)){
        $_SESSION['error'] = 'Please enter a valid date in DD/MM/YYYY format';
        header('Location: apply.php');
        exit;
    }

    // Validate Gender
    if (empty($gender)) {
        $_SESSION['error'] = 'Please select a gender';
        header('Location: apply.php');
        exit;
    }

    // Validate Address
    if (empty($address)) {
        $_SESSION['error'] = 'Please enter an address';
        header('Location: apply.php');
        exit;
    }

    if (strlen($address) > 40) {
        $_SESSION['error'] = 'Address must be 40 characters or less';
        header('Location: apply.php');
        exit;
    }

    // Validate Suburb
    if (empty($suburb)) {
        $_SESSION['error'] = 'Please enter a suburb';
        header('Location: apply.php');
        exit;
    }

    if (strlen($suburb) > 40) {
        $_SESSION['error'] = 'Suburb must be 40 characters or less';
        header('Location: apply.php');
        exit;
    }

    // Validate Postcode
    if (empty($postcode)) {
        $_SESSION['error'] = 'Please enter a postcode';
        header('Location: apply.php');
        exit;
    }

    if (!preg_match("/^\d{4}$/", $postcode)) {
        $_SESSION['error'] = 'Please enter a valid 4-digit postcode';
        header('Location: apply.php');
        exit;
    }

    // Validate State
    if (empty($state)) {
        $_SESSION['error'] = 'Please select a state';
        header('Location: apply.php');
        exit;
    }

    // Validate Email
    if (empty($email)) {
        $_SESSION['error'] = 'Please enter an email address';
        header('Location: apply.php');
        exit;
    }

    if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/", $email)) {
        $_SESSION['error'] = 'Please enter a valid email address';
        header('Location: apply.php');
        exit;
    }

    if (strlen($email) > 40) {
        $_SESSION['error'] = 'Email must be 40 characters or less';
        header('Location: apply.php');
        exit;
    }

    // Validate Phone
    if (empty($phone)) {
        $_SESSION['error'] = 'Please enter a phone number';
        header('Location: apply.php');
        exit;
    }

    if (!preg_match("/^\d{8,12}$/", $phone)) {
        $_SESSION['error'] = 'Please enter a valid phone number between 8 and 12 digits';
        header('Location: apply.php');
        exit;
    }

    // Validate Other Skills length
    if (strlen($otherSkills) > 1024) {
        $_SESSION['error'] = 'Other skills must be 1024 characters or less';
        header('Location: apply.php');
        exit;
    }


    // Connect to database
    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn) {
        echo "<p>Connection failed: " . mysqli_connect_error() . "</p>";
        exit;
    }

    // Create eoi table if it does not exist
    $sql_create_eoi = "
    CREATE TABLE IF NOT EXISTS `eoi` (
    EOIno INT NOT NULL AUTO_INCREMENT,
    RefNo VARCHAR(5) NOT NULL,
    ID INT NOT NULL,
    ApplyDate DATE NOT NULL DEFAULT CURDATE(),
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    DOB DATE NOT NULL,
    Gender ENUM('Male','Female','Other','Prefer not to say') NOT NULL,
    Address VARCHAR(40) NOT NULL,
    Suburb VARCHAR(40) NOT NULL,
    Postcode INT(11) NOT NULL,
    State ENUM('VIC','NSW','QLD','WA','SA','TAS','NT','ACT') NOT NULL,
    Email VARCHAR(40) NOT NULL,
    PhoneNo VARCHAR(12) NOT NULL,
    Skills VARCHAR(128) DEFAULT NULL,
    OtherSkills VARCHAR(1024) DEFAULT NULL,
    Status ENUM('New','Current','Final') DEFAULT 'New',
    PRIMARY KEY (`EOIno`),
    FOREIGN KEY (`RefNo`) REFERENCES `jobs`(`RefNo`) ON DELETE CASCADE,
    FOREIGN KEY (`ID`) REFERENCES `user`(`id`) ON DELETE CASCADE
    );
    ";

    if (!mysqli_query($conn, $sql_create_eoi)) {
        echo "<p>Error creating EOI table: " . mysqli_error($conn) . "</p>";
        exit;
    }

    // Escape all string variables for SQL safety
    $refNo = mysqli_real_escape_string($conn, $refNo);
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $gender = mysqli_real_escape_string($conn, $gender);
    $address = mysqli_real_escape_string($conn, $address);
    $suburb = mysqli_real_escape_string($conn, $suburb);
    $state = mysqli_real_escape_string($conn, $state);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $skills = mysqli_real_escape_string($conn, $skills);
    $otherSkills = mysqli_real_escape_string($conn, $otherSkills);
    // Convert postcode to integer
    $postcode = (int)$postcode;
    // Convert date to sql date format
    $dob = date('Y-m-d', strtotime($_POST['dob']));

    $sql = "INSERT INTO eoi(RefNo, ID, FirstName, LastName, DOB, Gender, Address, 
        Suburb, Postcode, State, Email, PhoneNo, Skills, OtherSkills, Status) 
        VALUES ('$refNo', $userId, '$firstName', '$lastName', '$dob', '$gender', 
        '$address', '$suburb', $postcode, '$state', '$email', '$phone', '$skills', '$otherSkills', 'New')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Get the auto-generated EOInumber
        $eoiNumber = mysqli_insert_id($conn);

        // Store EOInumber in session for confirmation page
        $_SESSION['last_eoi'] = $eoiNumber;

        // Clear form data and errors
        $_SESSION['form_data'] = array();
        $_SESSION['error'] = '';

        // Redirect to confirmation page
        header('Location: eoi_confirmation.php');
        exit;
    } else {
        // Database error
        $_SESSION['error'] = 'Unable to process your application. Please try again.';
    }

    mysqli_close($conn);


    $_SESSION['form_data'] = array();
    $_SESSION['error'] = '';

}
?>