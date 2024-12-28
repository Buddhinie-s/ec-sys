<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Department >> New Position</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="new_Department.php" class="btn btn-sm btn-outline-secondary">New Department</a>
            </div>
            <div class="btn-group me-2">
                <a href="new_position.php" class="btn btn-sm btn-outline-secondary">New Position</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="row g-5">

                <div class = "col-md-7 col-lg-8">


                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
//                        print_r($_POST);
//                        Convert array keeys to variable
                        extract($_POST);
                        $e_EmpNo = inputClean($e_EmpNo);
                        $e_NameFull = inputClean($e_NameFull);
                        $e_NameInitials = inputClean($e_NameInitials);
//                        $e_DOB = inputClean($e_DOB);
                        $e_NIC = inputClean($e_NIC);
                        $e_StatusCivil = inputClean($e_StatusCivil);
                        $e_Contact1 = inputClean($e_Contact1);
                        $e_Contact2 = inputClean($e_Contact2);
                        $e_email1 = inputClean($e_email1);
                        $e_email2 = inputClean($e_email2);
                        $e_PmanentAddressNo = inputClean($e_PmanentAddressNo);
                        $e_PmanentAddLane = inputClean($e_PmanentAddLane);
                        $e_PmanentAddStreet = inputClean($e_PmanentAddStreet);
                        $e_PmanentAddTown = inputClean($e_PmanentAddTown);
                        $e_CurrentAddNo = inputClean($e_CurrentAddNo);
                        $e_CurrentAddLane = inputClean($e_CurrentAddLane);
                        $e_CurrentAddStreet = inputClean($e_CurrentAddStreet);
                        $e_CurrentAddTown = inputClean($e_CurrentAddTown);
                        $e_Designation = inputClean($e_Designation);

                        $messages = array();

                        if (empty($e_EmpNo)) {
                            $messages['error_EmpNo'] = "The employee number should not be blank...!";
                        }
                        if (empty($e_NameFull)) {
                            $messages['error_NameFull'] = "The full name should not be blank...!";
                        }
                        if (empty($e_NameInitials)) {
                            $messages['error_NameInitials'] = "The name with initials should not be blank...!";
                        }
                        if (!isset($e_Gender)) {
                            $messages['error_gender'] = "The gender should be select...!";
                        }
                        if (empty($e_DOB)) {
                            $messages['error_DOB'] = "DOB should not be blank...!";
                        }
                        if (empty($e_NIC)) {
                            $messages['error_NIC'] = "The National I dentity Card Number should not be blank...!";
                        }
                        if (!isset($e_StatusCivil)) {
                            $messages['error_StatusCivil'] = "Civil status should be selected";
                        }
                        if (empty($e_Contact1)) {
                            $messages['error_Contact1'] = "The mobile number should not be blank...!";
                        }
                        if (empty($e_email1)) {
                            $messages['error_email1'] = "contact email 1 should not be blank...!";
                        }
                        if (empty($e_PmanentAddLane)) {
                            $messages['error_PmanentAddLane'] = "The Lane should not be blank...!";
                        }
                        if (empty($e_PmanentAddStreet)) {
                            $messages['error_PmanentAddStreet'] = "The street should not be blank...!";
                        }
                        if (empty($e_PmanentAddTown)) {
                            $messages['error_PmanentAddTown'] = "The Town not be blank...!";
                        }
                        if (empty($e_Designation)) {
                            $messages['error_Designation'] = "The Designation should not be blank...!";
                        }
                        if (!isset($o_Type)) {
                            $messages['error_Type'] = "Appointment to should be selected";
                        }

                        //Date of birth should not be future date
                        $today_is = date("Y-m-d");
                        if ($today_is < $e_DOB) {
                            $messages['error_DOB'] = "Date of birth should not be a future date";
                        } else {
                            //Employe age should be 18+
                            $birth_year = date('Y', strtotime($e_DOB));
                            $current_year = date('Y');
                            $age = $current_year - $birth_year;
                            if ($age < 18) {
                                $messages['error_DOB'] = "Age should not be less than 18 years";
                            }
                        }

                        // DB validation
                        if (!empty($e_EmpNo)) {
                            $db = dbConn();
                            $sql = "SELECT * FROM  tbl_employee WHERE EmpNo='$e_EmpNo'";
                            $result = $db->query($sql);
//                            echo $result->num_rows;
                            if ($result->num_rows > 0) {
                                $messages['error_EmpNo'] = "The employee number already exsist...!";
                            }
                        }

//                        if (!empty($e_NIC)) {
//                            $db = dbConn();
//                            $sql = "SELECT * FROM  tbl_employee WHERE NIC'$e_NIC'";
//                            $result = $db->query($sql);
////                            echo $result->num_rows;
//                            if ($result->num_rows > 0) {
//                                $messages['error_EmpNo'] = "This National Identity Card Number already exsist...!";
//                            }
//                        }
//                        insert data to database
//                        print_r($messages);
                        if (empty($messages)) {
                            $db = dbConn();
                            $sql = "INSERT INTO tbl_employee(EmpNo, NameFull, Gender, NameInitials, DOB, NIC, StatusCivil, StatusType, StatusDate, StatusReason, PmanentAddressNo, PmanentAddLane, PmanentAddStreet, PmanentAddTown, CurrentAddNo, Designation, CurrentAddLane, CurrentAddStreet, CurrentAddTown) VALUES('$e_EmpNo', '$e_NameFull', '$e_Gender', '$e_NameInitials', '$e_DOB', '$e_NIC', '$e_StatusCivil', '$e_StatusType', '$e_StatusDate', '$e_StatusReason', '$e_PmanentAddressNo', '$e_PmanentAddLane', '$e_PmanentAddStreet', '$e_PmanentAddTown', '$e_CurrentAddNo', '$e_Designation', '$e_CurrentAddLane', '$e_CurrentAddStreet', '$e_CurrentAddTown')";
                            $db->query($sql);
//                            last insert id
//                            echo $db->insert_id;
                            $EmpID = $db->insert_id;
                            $sql = "INSERT INTO tbl_employee_contact(EmpID, Contact) VALUES('$EmpID', '$e_Contact1')";
                            $db->query($sql);
                            $sql = "INSERT INTO tbl_employee_email(EmpID, Email) VALUES('$EmpID', '$e_email1')";
                            $db->query($sql);
                            $sql = "INSERT INTO tbl_office(EmpID, Type) VALUES('$EmpID', '$o_Type')";
//                            print_r($sql);
                            $db->query($sql);
                            $Password = sha1($e_NIC);
                            $sql = "INSERT INTO tbl_user(EmpID, UserName, Password) VALUES('$EmpID', '$e_EmpNo', '$Password')";
                            $db->query($sql);

//                            foreach ($o_Type as $value) {
//                                $sql = "INSERT INTO tbl_office(EmpID, Type) VALUES('$EmpID', '$o_Type')";
//                                $db->query($sql);
//                            }
                        }

                        echo "<div class = 'alert  alert-success'>Data Saved...!</div>";
                        $e_EmpNo = $e_NameFull = $e_NameInitials = $e_Gender = $e_DOB = $e_NIC = $e_StatusCivil = $e_StatusType = $e_StatusDate = $e_StatusReason = $e_Contact1 = $e_Contact2 = $e_email1 = $e_email2 = $e_PmanentAddressNo = $e_PmanentAddLane = $e_PmanentAddStreet = $e_PmanentAddTown = $e_CurrentAddNo = $e_CurrentAddLane = $e_CurrentAddStreet = $e_CurrentAddTown = $e_Designation = $e_ProfilePic = $o_Type = null;
                    }
                    ?>
<!--                    <script >
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>-->

                    <!-- htmlspecialchars:  is often used to prevent security vulnerabilities, such as cross-site scripting attacks, by encoding special characters in user input.-->
                    <form method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2">

                        <div class = "row g-3">
                            
                            <div class = "col-md-8">
                                <label for = "dptName" class = "form-label">Department Name</label>
                                <select class = "form-select" id = "DptName" name="d_DptName" >
                                    <option value = "">Choose...</option>                                     

                                    <option value = "dis_officer" <?php
                                            if (@$e_Designation == "dis_officer") {
                                                echo "Selected";
                                            }
                                            ?>>District Officer</option>                                      

                                </select>
                                <div class="text-danger"><?= @$messages['error_Designation'] ?></div>
                            </div>

                            <div class = "col-sm-12">
                                <label for = "firstName" class = "form-label">Full name</label>
                                <input type = "text" class = "form-control" id = "NameFull" name = "e_NameFull" placeholder = "Kurulu Kumari Megahawattha" value="<?php echo@$e_NameFull; ?>">
                                <div class="text-danger"><?= @$messages['error_NameFull'] ?></div>
                            </div>

                            <div class = "col-sm-6">
                                <label for = "firstName" class = "form-label">Employee number</label>
                                <input type = "text" class = "form-control" id = "EmpNo" name = "e_EmpNo" value="<?php echo@$e_EmpNo; ?>">
                                <div class="text-danger"><?= @$messages['error_EmpNo'] ?></div>                             
                            </div>
                            <div class = "col-sm-12">
                                <label for = "nameInitials" class = "form-label">Position</label>
                                <input type = "text" class = "form-control" id = "NameInitials" name="e_NameInitials" placeholder = "Megahawattha K K" value="<?php echo@$e_NameInitials; ?>">
                                <div class="text-danger"><?= @$messages['error_NameInitials'] ?></div>
                            </div>  

                            <div class = "col-6">
                                <label for = "contact1" class = "form-label">Office Contact </label>
                                <input type = "text" class = "form-control" id = "Contact1" name="e_Contact1" placeholder = "ex - 0718624932" value="<?php echo@$e_Contact1; ?>">
                                <div class="text-danger"><?= @$messages['error_Contact1'] ?></div>
                            </div>
                        <hr class = "my-4">

                        <button class = "w-50 btn btn-primary btn-lg" type = "submit">   Submit   </button>

                    </form>
                </div>


            </div>
        </div>
    </div>
</main>


<?php include '../footer.php';
?>  
