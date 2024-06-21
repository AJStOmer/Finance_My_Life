
<!-- navigation bar -->
<?php include 'Navbar.php' ?> 

<div class="container">
    <div class="content">

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFFFF; /* Beige background */
            color: #556B2F; /* Olive text color */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #FFFFFF; /* Light beige background */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-box {
            display: flex;
        }

        .form-box .input-group {
            flex: 1;
            margin-right: 20px;
        }

        .form-box .output {
            flex: 1;
            padding: 10px;
            background-color: #E0E0E0; /* Light gray background for output box */
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Annuity Future Value</h2>
        <h4>Future Value of Annuity - Calculates how much money a series of payments into an annuity will be worth at a certain time in the future</h4>
        <div class="form-box">
            <div class="input-group">
                <form action="calculator.php?action=form4" method="post">
                    <div>
                        <label for="payment">Monthly Payment: </label>
                        <input type="text" id="payment" name="payment" required>
                    </div>
                    <div>
                        <label for="IR">Interest Rate:     </label>
                        <input id="IR" id="IR" name="IR" required>
                    </div>
                    <div>
                        <label for="numPeriods">Number of Periods:</label>
                        <input type="numPeriods" id="numPeriods" name="numPeriods" required>
                    </div>

                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="output">
                <?php
                // Check if form was submitted and perform calculations
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == "form4") {
                    AnnuityFV(); // Call the PHP function to calculate Annuity Future Value
                }

                // Define your PHP functions here
                function AnnuityFV(){
                    $payment = $_POST['payment'];
                    $IR = $_POST['IR'];
                    $numPeriods = $_POST['numPeriods'];
                
                    $payment = (float) $payment;
                    $intFV = (float) $FV;
                    $intIR = (float) $IR;
                
                    $intIR = $intIR/100;
                    $onePlusR = $intIR + 1;
                    $onePlusR = $onePlusR**$numPeriods;
                    $onePlusR = $onePlusR-1;
                    $onePlusR = $onePlusR/$intIR;
                
                    $Result = $onePlusR*$payment;
                    $Result = round($Result);
                    
                    echo "Future Value " . "$" . $Result . "<br>"; 
                
                }
                ?>
            </div>
        </div>
    </div>
</body>


<body>
    <div class="container">
        <h2>Interest Rate Calculator</h2>
        <h4>IR - Calculates the rate needed in order to achieve the future value from the present value in a certain period of time</h4>
        <div class="form-box">
            <div class="input-group">
                <form action="calculator.php?action=form1" method="post">
                    <div>
                        <label for="numPeriods">Number of Periods:</label>
                        <input type="numPeriods" id="numPeriods" name="numPeriods" required>
                    </div>
                    <div>
                        <label for="PV">Present Value:</label>
                        <input id="PV" id="PV" name="PV" required>
                    </div>
                    <div>
                        <label for="FV">Future Value:</label>
                        <input id="FV" id="FV" name="FV" required>
                    </div>

                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="output">
                <?php
                // Check if form was submitted and perform calculations
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == "form1") {
                    InterestRate(); // Call the PHP function to calculate Annuity Future Value
                }

                function InterestRate(){
                    $numPeriods = $_POST['numPeriods'];
                    $PV = $_POST['PV'];
                    $FV = $_POST['FV'];
                
                    $intNumPeriods = (float) $numPeriods;
                    $intPV = (float) $PV;
                    $intFV = (float) $FV;
                
                
                    $FVoverPV = $intFV/$intPV;
                    $oneOverT = 1/$intNumPeriods;
                    $FVoverPV = $FVoverPV**$oneOverT;
                    $FVoverPV = $FVoverPV-1;
                    $FVoverPV = $FVoverPV*100;
                    $FVoverPV = round($FVoverPV);
                
                
                
                    echo "Interest Rate " . $FVoverPV . "%". "<br>";
                }
                ?>
            </div>
        </div>
    </div>
</body>


<body>
    <div class="container">
        <h2>Future Value Calculator</h2>
        <h4>FV - Calculates the value of a lump sum investment made today at a certain time in the future</h4>
        <div class="form-box">
            <div class="input-group">
                <form action="calculator.php?action=form2" method="post">
                    <div>
                        <label for="Present Value">Present Value:</label>
                        <input type="PV" id="PV" name="PV" required>
                    </div>
                    <div>
                        <label for="IR">Interest Rate:</label>
                         <input id="IR" id="IR" name="IR" required>
                    </div>
                    <div>
                    <label for="numPeriods">Number of Periods:</label>
                    <input id="numPeriods" id="numPeriods" name="numPeriods" required>
                    </div>

                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="output">
                <?php
                // Check if form was submitted and perform calculations
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == "form2") {
                    FutureValue(); // Call the PHP function to calculate Annuity Future Value
                }

                function FutureValue(){
                    $PV = $_POST['PV'];
                    $IR = $_POST['IR'];
                    $numPeriods = $_POST['numPeriods'];
                
                    $intNumPeriods = (float) $numPeriods;
                    $intPV = (float) $PV;
                    $intIR = (float) $IR;
                
                    $intIR = $intIR/100;
                    $intIR = $intIR+1.0;
                    $Result = $intIR**$intNumPeriods;
                    $Result = $Result*$intPV;
                    $Result = round($Result);
                
                    echo "Future Value " . "$" . $Result . "<br>"; 
                
                
                }
                ?>
            </div>
        </div>
    </div>
</body>



<body>
    <div class="container">
        <h2>Present Value Calculator</h2>
        <h4>PV - Calculates the amount of money that must be invested today to achieve a certain amount of money in the future.<h4>
        <div class="form-box">
            <div class="input-group">
                <form action="calculator.php?action=form3" method="post">
                    <div>
                    <label for="Future Value">Future Value:</label>
                    <input type="FV" id="FV" name="FV" required>
                    </div>
                    <div>
                        <label for="IR">Interest Rate:</label>
                         <input id="IR" id="IR" name="IR" required>
                    </div>
                    <div>
                    <label for="numPeriods">Number of Periods:</label>
                    <input id="numPeriods" id="numPeriods" name="numPeriods" required>
                    </div>

                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="output">
                <?php
                // Check if form was submitted and perform calculations
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == "form3") {
                    PresentValue(); // Call the PHP function to calculate Annuity Future Value
                }

                function PresentValue(){
                    $FV = $_POST['FV'];
                    $IR = $_POST['IR'];
                    $numPeriods = $_POST['numPeriods'];
                
                    $intNumPeriods = (float) $numPeriods;
                    $intFV = (float) $FV;
                    $intIR = (float) $IR;
                
                    $intIR = $intIR/100;
                    $intIR = $intIR+1;
                    $intIR = $intIR**$numPeriods;
                    $Result = $FV/$intIR;
                    $Result = round($Result);
                
                
                    echo "Present Value " . "$" . $Result . "<br>"; 
                
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>


<?php
    session_start();
    if(empty($_SESSION['user']))
{
    die("Redirecting to login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User page</title>



</head>

</html>