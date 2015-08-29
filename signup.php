<!DOCTYPE html>
<html>
<head>
  <title>Magiclabs Assessment</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

  <!-- Custome Styles -->
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <?php 
        require("libs/sendgrid-php/sendgrid-php.php");
        require_once('libs/DataProvider.php');

        $accountType = $_POST['accountType'];
        $email = $_POST['txtEmail']; 
        $phone = $_POST['txtPhone'];

        $password = $_POST['txtPassword'];
        $password = md5("magiclabs".$password."assessment");

        //Check if this email exist
        $sql = "SELECT id FROM `Account` WHERE email = '".$email."'";
        $result = DataProvider::ExecuteQuery($sql);
        $row = mysql_fetch_array($result);
        if($row) {
          ?>
            <div class="panel panel-danger">
              <div class="panel-heading">Cannot create your account!</div>
              <div class="panel-body">
                This email address has been used!
              </div>
            </div>
          <?php
        }
        else {
          //Insert new Account
          $sql = "INSERT INTO `Account` (email, password, type) VALUES ('".$email."','".$password."',".$accountType.")";
          $res = DataProvider::ExecuteQuery($sql);

          //Select that Account
          $sql = "SELECT id FROM `Account` WHERE email = '".$email."'";
          $result = DataProvider::ExecuteQuery($sql);
          $row = mysql_fetch_array($result);

          if($result) {
            if($accountType == 1) { //This is Company
              $name = $_POST['txtName'];
              $address = $_POST['txtAddress'];

              //Insert info of that Account into UserProfile
              $sql = "INSERT INTO `CompanyProfile` (accountId, name, address, phone) VALUES (".$row['id'].", '".$name."','".$address."', '".$phone."')";
              $result = DataProvider::ExecuteQuery($sql);        
            }
            else if($accountType == 2) { //This is User
              $firstName = $_POST['txtFirstname'];
              $lastName = $_POST['txtLastname'];
              $gender = isset($_POST['gender']) ? $_POST['gender'] : 3;

              //Insert info of that Account into UserProfile
              $sql = "INSERT INTO `UserProfile` (accountId, firstName, lastName, gender, phone) VALUES (".$row['id'].", '".$firstName."','".$lastName."', ".$gender.", '".$phone."')";
              $resuls = DataProvider::ExecuteQuery($sql);
            }

            if(!$result) {
              ?>
                <div class="panel panel-danger">
                  <div class="panel-heading">Cannot create your account!</div>
                  <div class="panel-body">
                    Please <a href="index.html">Sign up</a> again!
                  </div>
                </div>
              <?php
            }
            else {
                $sendgrid = new SendGrid('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');

                switch ($accountType) {
                  case 1:
                    $fullName = $name;
                    break;
                  
                  case 2:
                    $fullName = $firstName." ".$lastName;
                    break;

                  default:
                    $fullName = "";
                    break;
                }

                $sendgridEmail = new SendGrid\Email();
                $sendgridEmail
                    ->addTo($email)
                    ->setFrom('hung@mail.vn-sg.com')
                    ->setSubject('Email account has been created successfully!')
                    ->setHtml('<div>Hi '.$fullName.'</div><br><div>Your account has been created successfully!</div><br><div>Best regards</div>')
                ;
                $sendgrid->send($sendgridEmail);
              ?>
                <div class="panel panel-success">
                  <div class="panel-heading">Your account has been created successfully!</div>
                  <div class="panel-body">
                    Please check your email.
                  </div>
                </div>
              <?php
            }
          }
          else {
            ?>
              <div class="panel panel-danger">
                <div class="panel-heading">Cannot create your account!</div>
                <div class="panel-body">
                  Please <a href="index.html">Sign up</a> again!
                </div>
              </div>
            <?php
          }
        }
      ?>
    </div>
  </div>

  <!-- JQuery -->
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <!-- Custom script -->
  <!-- JQuery -->
  <script src="js/app.js"></script>
</body>
</html>