<?php
    // Sanitise script courtesy of Atie Kia (https://github.com/atieasadikia/COS10026-S2-2025/blob/main/lecture07/form.php)
    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        $skills = isset($_POST["skills"]) ? $_POST["skills"] : [];
        $otherSkills = sanitise_input($_POST['otherSkillsText']);

        if (empty($refNo)) {
            header('Location: apply.php?error=Reference Number is required');
            exit;
        }

        if (!preg_match("/^[A-Za-z0-9]{5}$/"), $refNo){
            header('Location: apply.php?error=Please enter a valid reference number');
            exit; 
        }

        if (empty($refNo)) {
            header('Location: apply.php?error=Reference Number is required');
            exit;
        }

        if (empty($firstName)) {
            header('Location: apply.php?error=Please enter your first name');
            exit;
        }
        
        // STILL NEED TO DO VALIDATION FOR FIRST AND LAST NAME MIN AND MAX LENGTH !!!!! //

        if (!preg_match("[A-Za-z]{1, 20}"), $firstName){
            header('Location: apply.php?error=First name is too long');
            exit; 
        }

        if (empty($lastName)) {
            header('Location: apply.php?error=Please enter your last name');
            exit;
        }

        if (!preg_match("[A-Za-z]{1, 20}"), $lastName){
            header('Location: apply.php?error=Last name is too long');
            exit; 
        }
        

        // regex taken from https://arziel1992.github.io/input-pattern-tester/
        if (!preg_match("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/\d{4}"), $dob){
            echo "Please enter a valid date";
        }

        if (empty($gender)) {
            header('Location: apply.php?error=Please select a gender')
        }

        if (empty($address)) {
            header('Location: apply.php?error=Please enter an address')
        }

        if (empty($suburb)) {
            header('Location: apply.php?error=Please enter a suburb')
        }

        if (empty($gender)) {
            header('Location: apply.php?error=Please select a gender')
        }


    }