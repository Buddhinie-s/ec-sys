
<?php
//Session is starting
//Session variable can store multiple pages values from starting to distroying the session
session_start();

include 'config.php';
include 'function.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E&C System Login</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/login_style.css" rel="stylesheet">
    </head>
    <body class="text-center bg-primary bg-gradient bg-opacity-75">

        <main class="form-signin w-100 m-auto border border-1 border-dark bg-light">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                extract($_POST);
                $UserName = inputClean($UserName);
                $messages = array();
                if (empty($UserName)) {
                    $messages['error_UserName'] = "The Username should not be blank...!";
                }
                if (empty($Password)) {
                    $messages['error_Password'] = "The Password should not be blank...!";
                }

                if (empty($messages)) {
                    $db = dbConn();
//                    Encript the password
                    $Password = sha1($Password);
                    //Get user login from user table
//                    $sql = "SELECT * FROM tbl_user WHERE UserName='$UserName' AND Password='$Password'";
                    $sql = "SELECT * FROM tbl_user INNER JOIN tbl_employee ON tbl_user.EmpID = tbl_employee.EmpID WHERE UserName='$UserName' AND Password='$Password'"; 
                    $result = $db->query($sql);
                    if ($result->num_rows == 1) {
                        // FETCH ASSOCIATIVE ARRA VALUES IN TO $row VARIABLE 
                        $row = $result->fetch_assoc();
                        print_r($row);
                        $_SESSION['USERID'] = $row['UserID'];                        
                        $_SESSION['EMPID'] = $row['EmpID'];  
                        $_SESSION['USERROLE'] = $row['Designation'];                        
                        $_SESSION['NAMEINITIALS'] = $row['NameInitials'];
//                        //if their a one record use above
                        print_r($row);                        
//                        Validations are true and direct to index page
                        header("Location:index.php");
        } else {
                        $messages['error_invalid'] = "The Username or Password is wrong...!";
                    }
                }
            }
            ?>
            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <img class="mb-2 img-fluid" src="assets/images/logo.png" alt="BIT LOGO" width="130">
                <h1 class="h3 mb-3 fw-normal">Please sign in to</h1>
                <h1 class="h3 mb-3 fw-normal">M&C System</h1>
                <div class="text-danger"><?= @$messages['error_UserName'] ?></div>
                <div class="text-danger"><?= @$messages['error_Password'] ?></div>
                <div class="text-danger"><?= @$messages['error_invalid'] ?></div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Enter User Name">  

                    <label for="UserName">User Name</label>
                </div>
                <br>
                <div class="form-floating">
                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                    <label for="Password">Password</label>
                </div>

                <div class="checkbox mb-3">
<!--                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>-->
                </div>
                <button class="w-50 btn btn-lg btn-outline-success" type="submit">Sign in</button>
                <p class="mt-3 mb-1 text-muted">&copy; BAS</p>
            </form>
        </main>



    </body>
</html>
