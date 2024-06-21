    <?php
    session_start();

    if(isset($_POST['submit'])){
        // Create connection
        $conn = mysqli_connect("localhost","root","root","FML_DB");
        // Check connection
        if ($conn -> connect_errno)
        {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        }
        
            //user-form name of the database
        
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pass = $_POST['password'];
        
            $select = " SELECT * FROM Person WHERE email = '$email' && password = '$pass'";
        
            $result = mysqli_query($conn, $select);
        
            //Gain error message used for throwing the error option
        
            if(mysqli_num_rows($result) > 0){
        
                $row = mysqli_fetch_array($result);
        
                if($row['type'] == 'advisor'){
        
                    $_SESSION['adv'] = $row['email'];
                    header('location: /CalgaryHacks24/advisor/advisorHome.php');
        
                }elseif($row['type'] == 'user'){
        
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user'] = $row['email'];
                    header('Location: /CalgaryHacks24/user/userHome.php');
        
                }
             }else{
                $error[] = 'Incorrect email or password!';
             }

    } elseif (isset($_POST['register'])) {
        // Registration code
        // Create connection
        $conn1 = mysqli_connect("localhost", "root", "root", "FML_DB");
        // Check connection
        if ($conn1->connect_errno) {
            echo "Failed to connect to MySQL: " . $conn1->connect_error;
        }
    
        $Fname = mysqli_real_escape_string($conn1, $_POST['Advisor_Fname']);
        $UFname = mysqli_real_escape_string($conn1, $_POST['Fname']);
        $Lname = mysqli_real_escape_string($conn1, $_POST['Advisor_Lname']);
        $ULname = mysqli_real_escape_string($conn1, $_POST['Lname']);
        $email = mysqli_real_escape_string($conn1, $_POST['register_email']); // Use 'register_email' instead of 'TopicSelect'
        $phone = mysqli_real_escape_string($conn1, $_POST['Advisor_Phone']);
        $Uphone = mysqli_real_escape_string($conn1, $_POST['Phone']);
        $Company = mysqli_real_escape_string($conn1, $_POST['Advisor_Company']); // Use 'Advisor_Company' instead of 'Address'
        $pass = $_POST['register_password']; // Use 'register_password' instead of 'password'
        $user_type = $_POST["user_type"];
        $Income = $_POST["Income"];
        $Exp = $_POST["TopicSelect"];

        // user-form name of the database
        $select = "SELECT * FROM Person WHERE email = '{$email}'";
    
        $result = mysqli_query($conn1, $select);
    
        // Gain error message used for throwing the error option
    
        if (mysqli_num_rows($result) > 0) {
            $error[] = 'This user already exists';
        } else {
                // id name email password user_type (database attributes)
                if ($user_type == 'user') {
                    $insert = "INSERT INTO Person VALUES('{$email}','{$UFname}','{$ULname}', '{$pass}','{$user_type}','{$Uphone}')";
                    mysqli_query($conn1, $insert);
                    $insertE = "INSERT INTO user VALUES('{$email}', '{$Income}', '')";
                    mysqli_query($conn1, $insertE);
                } elseif ($user_type == 'advisor') {
                    $insert = "INSERT INTO Person VALUES('{$email}','{$Fname}','{$Lname}', '{$pass}','{$user_type}','{$phone}')";
                    mysqli_query($conn1, $insert);
                    $insertM = "INSERT INTO advisor VALUES('{$email}','{$Exp}' , '{$Company}')";
                    mysqli_query($conn1, $insertM);
                }
                header('Location: /CalgaryHacks24/login/loginForm.php');
            }
        }
    ?>
    
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login and Register Form</title>

        <!-- Custom CSS file link -->
        <link rel="stylesheet" href="/CalgaryHacks24/login/style.css">

        <style>
            .blob-container {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                border-radius: 50%;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                cursor: pointer;
                transition: transform 0.3s ease;
            }

            .blob-container:hover {
                transform: scale(1.2);
            }

            .popup-container {
        position: fixed;
        top: 10px;
        right: 20px;
        background: #ffffff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: none;
        max-width: 300px; /* Set your desired maximum width */
        width: 100%;
        box-sizing: border-box;
    }


            .popup-message {
                font-size: 16px;
                margin-bottom: 10px;
            }

            .user-fields,
            .advisor-fields {
                display: none;
            }

            .popup-btn {
                background-color: #4CAF50;
                color: white;
                padding: 8px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 10px;

            }
        </style>

<script>
    console.log("Script loaded!");

    function showPopup() {
        var popupContainer = document.querySelector('.popup-container');
        var blobContainer = document.querySelector('.blob-container');

        if (popupContainer && blobContainer) {
            popupContainer.style.display = 'block';
            blobContainer.style.display = 'block';
        } else {
            console.error("Popup container not found!");
        }
    }

    function toggleFields() {
        var userTypeSelect = document.getElementById('user_type');
        var userFields = document.querySelector('.user-fields');
        var advisorFields = document.querySelector('.advisor-fields');

        var userType = userTypeSelect.value;

        // If user fields are displayed, hide them; otherwise, hide advisor fields
        if (userFields.style.display === 'block') {
            userFields.style.display = 'none';
        } else if (advisorFields.style.display === 'block') {
            advisorFields.style.display = 'none';
        }

        // Show the selected type of fields
        if (userType === 'user') {
            userFields.style.display = 'block';
        } else if (userType === 'advisor') {
            advisorFields.style.display = 'block';
        }

        console.log("User Type: ", userType);
        console.log("User Fields: ", userFields.style.display);
        console.log("Advisor Fields: ", advisorFields.style.display);
    }
</script>
    </head>

    <body class="lbody">
    <div class="logo-container">
        <img src="/CalgaryHacks24/images/FMLogo.png" alt="Logo" class="logo">
    </div>

    <header class="header"></header>

    <div class="form-container">
        <form action="" method="post">
            <h3>Login now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <!-- Login form fields -->
            <input type="email" name="email"  placeholder="enter your email">
            <input type="password" name="password"  placeholder="enter your password">
            <input type="submit" name="submit" value="login now" class="form-btn">

            <!-- Blob and popup for registration -->
            <div class="blob-container" onclick="showPopup()">Hey, don't have an account?</div>

            <div class="popup-container" id="registrationPopup">
                <p class="popup-message">Click the button below to register!</p>

                <!-- Registration form fields -->
                <select name="user_type" id="user_type" onchange="toggleFields()">
                    <option value="user">User</option>
                    <option value="advisor">Advisor</option>
                </select>

                <div class="user-fields">
                    <!-- User-specific fields -->
                    <input type="text" name="Fname"  placeholder="enter your first name">
                    <input type="text" name="Lname"  placeholder="enter your last name">
                    <input type="text" name="Income"  placeholder="enter your income">
                    <input type="text" name="Phone"  placeholder="enter the phone number">
                </div>

                <div class="advisor-fields">
                    <!-- Advisor-specific fields -->
                    <input type="text" name="Advisor_Fname"  placeholder="enter your first name">
                    <input type="text" name="Advisor_Lname"  placeholder="enter your last name">
                    <select  name="TopicSelect" class="topicSelections">
                        <option value='Mortgage'>Mortgage</option>
                        <option value='Insurance'>Insurance</option>
                        <option value='Investment'>Investment</option>
                    </select>
                    <input type="text" name="Advisor_Phone"  placeholder="enter the phone number">
                    <input type="text" name="Advisor_Company"  placeholder="enter your company">
                </div>

                <!-- Rest of the form -->
                <input type="email" name="register_email"  placeholder="enter your email">
                <input type="password" name="register_password"  placeholder="enter your password">
                <input type="submit" name="register" value="Register" class="popup-btn">

                <!-- Cancel registration link -->
<!-- Cancel registration link -->
<p>Cancel registration? <a href="#" onclick="hidePopup(); return false;">Cancel</a></p>
            </div>
        </form>
    
    </div>
    <script>
    function hidePopup() {
        var popupContainer = document.getElementById('registrationPopup');
        if (popupContainer) {
            popupContainer.style.display = 'none';
        } else {
            console.error("Popup container not found!");
        }
    }
</script>
</body>
</html>