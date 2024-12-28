<?PHP ob_start() ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Employee > New</h4>
        
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <?php
                        $db = dbConn();
                        $sql = "SELECT COUNT(*) AS row_count FROM tbl_employee";
                        $result = $db->query($sql);

                        $row = $result->fetch_assoc();
                        $emp_count = $row['row_count'];
                        ?>
                        <span class="text-primary">Number of Employees</span>
                        <span class="badge bg-primary rounded-pill"><?= @$emp_count ?></span>
                    </h4>
<!--
                    <div class = "input-group">
                        <input type = "text" class = "form-control" placeholder = "District or Division">
                        <button type = "submit" class = "btn btn-secondary">Search</button>
                    </div>-->
                    </form>
                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_employee";
                    $result = $db->query($sql);
                    ?>
                    <table class="table table-striped">

                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $Designation = $row['Designation'];

                                    if (@$Designation == "dis_officer") {
                                        $Designation = 'District Officer';
                                    }
                                    if (@$Designation == "div_officer") {
                                        $Designation = 'Divisional Officer';
                                    }
                                    if (@$Designation == "ma_admin") {
                                        $Designation = 'Management Assistant : Admin & HR';
                                    }
                                    if (@$Designation == "ma_info") {
                                        $Designation = 'Management Assistant : Media & Information';
                                    }
                                    if (@$Designation == "ma_law") {
                                        $Designation = 'Management Assistant : Law Enforcement';
                                    }
                                    if (@$Designation == "ma_legal") {
                                        $Designation = 'Management Assistant : Legal';
                                    }
                                    if (@$Designation == "ma_planning") {
                                        $Designation = 'Management Assistant : Monitoring & Planning';
                                    }
                                    if (@$Designation == "ma_phyco") {
                                        $Designation = 'Management Assistant : Phycosocial';
                                    }
                                    if (@$Designation == "ma_programme") {
                                        $Designation = 'Management Assistant : Programme';
                                    }
                                    if (@$Designation == "m_e_officer") {
                                        $Designation = 'Monitoring and Evaluation Officer';
                                    }
                                    if (@$Designation == "law_officer") {
                                        $Designation = 'Law Enforcement Officer';
                                    }
                                    if (@$Designation == "dir_plan_info") {
                                        $Designation = 'Director Planning and Information';
                                    }
                                    if (@$Designation == "dir_prog") {
                                        $Designation = 'Director Programme';
                                    }
                                    if (@$Designation == "dir_admin") {
                                        $Designation = 'Director Administration';
                                    }
                                    if (@$Designation == "dir_finance") {
                                        $Designation = 'Director Finance';
                                    }
                                    if (@$Designation == "dir_lawenfoce") {
                                        $Designation = 'Director Law Enforcement';
                                    }
                                    if (@$Designation == "dir_legal") {
                                        $Designation = 'Director Legal';
                                    }
                                    if (@$Designation == "dir_phyco") {
                                        $Designation = 'Director Phycosocial';
                                    }
                                    if (@$Designation == "director_general") {
                                        $Designation = 'Director General';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $row['NameInitials'] ?></td>
                                        <td><?= @$Designation ?></td>

                                        <td>
                                            <form action="edit_emp.php" method="post">
                                                <input type="hidden" name="EmpID" value="<?= $row['EmpID'] ?>">
                                                <button type="submit" name="operate" value="edit" class="btn btn-warning">Edit</button>
                                            </form>
                                            
                                             <form action="delete_emp.php" method="post">
                                                <input type="hidden" name="EmpID" value="<?= $row['EmpID'] ?>">
                                               
                                                <button type="submit" name="operate" value="delete" class="btn btn-danger">Delete</button>
                                            </form>
                                            <!--                                            <button onclick="redirectToNewPage()">Edit</button>-->
                                        </td>

                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

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
                        $e_Email = inputClean($e_Email);
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
                        if (empty($e_Contact2)) {
                            $messages['error_Contact2'] = "The mobile number should not be blank...!";
                        }
                        if (empty($e_Email)) {
                            $messages['error_Email'] = "contact email should not be blank...!";
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

                        // validate contact number
                        if (!is_numeric($e_Contact1)) {
                            $messages['error_Contact1'] = "Please enter contact correctly";
                        } elseif (substr($e_Contact1, 0, 1) != 0) {
                            $messages['error_Contact1'] = "Please enter contact format correctly first should be 0";
                        } elseif (strlen($e_Contact1) != 10) {
                            $messages['error_Contact1'] = "Contact should be 10 numbers";
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

                        if (!empty($e_NIC)) {
                            if (!preg_match("/^[19|20]{2}[0-9]{10}$/", $e_NIC) AND!preg_match("/^[0-9]{9}[x|X|v|V]$/", $e_NIC)) {
                                $message['error_NIC'] = "Invalid NIC No...!";
                            }
                        } else {
                            $db = dbConn();
                            $sql = "SELECT * FROM  tbl_employee WHERE NIC='$e_NIC'";
                            $result = $db->query($sql);
                            if ($result->num_rows >= 1) {
                                $message['error_NIC'] = "NIC already exist..!";
                            }
                        }

//                        
                        if (empty($messages)) {
                            $file = $_FILES['e_ProfilePic'];
//                            print_r($file);
                            $file_name = $file['name'];
                            $file_tmp = $file['tmp_name'];
                            $file_size = $file['size'];
                            $file_error = $file['error'];

                            $file_ext = explode(".", $file_name);
                            $file_ext = strtolower(end($file_ext));

                            $allowed = array('png', 'jpg', 'jpeg', 'gif');

                            if (in_array($file_ext, $allowed)) {
                                if ($file_error === 0) {
                                    if ($file_size <= 180254) {
                                        $file_new_name = uniqid('', true) . "." . $file_ext;
                                        $file_destination = '../assets/profile_images/' . $file_new_name;
                                        if (move_uploaded_file($file_tmp, $file_destination)) {
                                            $message['error_image'] = "The file was uploaded successfully.";
                                        } else {
                                            $message['error_image'] = "There was an error uploading the file.";
                                        }
                                    } else {
                                        $messages['error_image'] = "File size invalid";
                                    }
                                } else {
                                    $messages['error_image'] = "File has error";
                                }
                            } else {
                                $messages['error_image'] = "Invalid file type";
                            }
                        }


                        if (empty($messages)) {
                            $db = dbConn();
//get today date
                            $e_StatusDate = date("Y-m-d");
                            $sql = "INSERT INTO tbl_employee(EmpNo, NameFull, Gender, NameInitials, DOB, NIC, StatusCivil, Email, StatusType, StatusDate, StatusReason, PmanentAddressNo, PmanentAddLane, PmanentAddStreet, PmanentAddTown, CurrentAddNo, CurrentAddLane, CurrentAddStreet, CurrentAddTown, Designation, ProfilePic) VALUES('$e_EmpNo', '$e_NameFull', '$e_Gender', '$e_NameInitials', '$e_DOB', '$e_NIC', '$e_StatusCivil', '$e_Email', '$e_StatusType', '$e_StatusDate', '$e_StatusReason', '$e_PmanentAddressNo', '$e_PmanentAddLane', '$e_PmanentAddStreet', '$e_PmanentAddTown', '$e_CurrentAddNo', '$e_CurrentAddLane', '$e_CurrentAddStreet', '$e_CurrentAddTown', '$e_Designation', '$file_new_name')";
                            $db->query($sql);
//                            last insert id
//                            echo $SQL;
                            $EmpID = $db->insert_id;
                            $sql = "INSERT INTO tbl_employee_contact(EmpID, Contact) VALUES('$EmpID', '$e_Contact1')";
                            $db->query($sql);
                            $sql = "INSERT INTO tbl_employee_contact(EmpID, Contact) VALUES('$EmpID', '$e_Contact2')";
                            $db->query($sql);
                            $sql = "INSERT INTO tbl_office(EmpID, Type) VALUES('$EmpID', '$o_Type')";
                            $db->query($sql);

                            switch ($o_Type) {
                                case "1":
                                    header("Location: ../office/departments/add_emp_ofc.php?EmpNo=$e_EmpNo");

                                    break;
                                case "2":
                                    header("Location: ../office/districts/add_emp_ofc.php?EmpNo=$e_EmpNo");
                                    break;
                                case "3":
                                    header("Location: ../office/divisions/add_emp_ofc.php?EmpNo=$e_EmpNo");
                                    break;
                                default:
                                    alert("Please select a page to redirect to.");
                                    break;
                            }



                            $Password = sha1($e_NIC);
                            $sql = "INSERT INTO tbl_user(EmpID, UserName, Password) VALUES('$EmpID', '$e_EmpNo', '$Password')";
                            $db->query($sql);
                            ?>
                            <script >
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            </script>

                            <?php
                        }

                        $e_EmpNo = $e_NameFull = $e_NameInitials = $e_Gender = $e_DOB = $e_NIC = $e_StatusCivil = $e_StatusType = $e_StatusDate = $e_StatusReason = $e_Contact1 = $e_Contact2 = $e_Email = $e_PmanentAddressNo = $e_PmanentAddLane = $e_PmanentAddStreet = $e_PmanentAddTown = $e_CurrentAddNo = $e_CurrentAddLane = $e_CurrentAddStreet = $e_CurrentAddTown = $e_Designation = $ProductImage = $o_Type = null;
                    }
                    ?>


                    <!-- htmlspecialchars:  is often used to prevent security vulnerabilities, such as cross-site scripting attacks, by encoding special characters in user input.-->
                    <form method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2"  enctype="multipart/form-data">

                        <h4 class = "mb-3">Add New</h4>

                        <div class = "row g-3">
                            <div class = "required-field col-sm-6">
                                <label for = "firstName" class = "form-label">Employee number <span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "EmpNo" name = "e_EmpNo" value="<?= @$e_EmpNo; ?>">
                                <div class="text-danger"><?= @$messages['error_EmpNo'] ?></div>                             
                            </div>
                            <div class = "col-sm-12">
                                <label for = "firstName" class = "form-label" >Full name<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "NameFull" name = "e_NameFull" placeholder = "Kurulu Kumari Megahawattha" value="<?= @$e_NameFull; ?>">
                                <div class="text-danger"><?= @$messages['error_NameFull'] ?></div>
                            </div>

                            <div class = "col-sm-12">
                                <label for = "nameInitials" class = "form-label">Name with Initials<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "NameInitials" name="e_NameInitials" placeholder = "Megahawattha K K" value="<?= @$e_NameInitials; ?>">
                                <div class="text-danger"><?= @$messages['error_NameInitials'] ?></div>
                            </div>                        
                            <div class = "col-sm-12">
                                <label for = "gender" class = "form-label">Gender<span style="color: red">*</span></label>
                                <div class = "form-check">
                                    <input class = "form-check-input" type = "radio" id = "M" name = "e_Gender" value="1" <?php
                                    if (isset($e_Gender) && $e_Gender == '1') {
                                        echo "checked";
                                    }
                                    ?>>
                                    <label class = "fcreditorm-check-label" for = "male">Male</span></label>
                                </div>
                                <div class = "form-check">
                                    <input class = "form-check-input" type = "radio" id = "F" name = "e_Gender" value="0" <?php
                                    if (isset($e_Gender) && $e_Gender == '0') {
                                        echo "checked";
                                    }
                                    ?>>
                                    <label class = "fcreditorm-check-label" for = "female">Female</label>
                                </div>

                                <div class="text-danger"><?= @$messages['error_gender'] ?></div>
                            </div>


                            <div class = "col-sm-4">
                                <label for = "dob" class = "form-label">Date of birth<span style="color: red">*</span></label>
                                <input type = "date" class = "form-control" id = "DOB" name="e_DOB">
                                <div class="text-danger"><?= @$messages['error_DOB'] ?></div>
                            </div>
                            <div class = "col-sm-4">
                                <label for = "nic" class = "form-label">National identity card number<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "NIC" name="e_NIC" value="<?= @$e_NIC; ?>">
                                <div class="text-danger"><?= @$messages['error_NIC'] ?></div>
                            </div>

                            <div class = "col-md-4">
                                <label for = "statusCivil" class = "form-label">Civil status<span style="color: red">*</span></label>
                                <select class = "form-select" id = "StatusCivil" name="e_StatusCivil" >
                                    <option value = "">Choose...</option>
                                    <option value = "M" <?php
                                    if (@$e_StatusCivil == "M") {
                                        echo "Selected";
                                    }
                                    ?>>Married</option>
                                    <option value = "U" <?php
                                    if (@$e_StatusCivil == "U") {
                                        echo "Selected";
                                    }
                                    ?>>UnMarried</option>
                                    <option value = "O" <?php
                                    if (@$e_StatusCivil == "O") {
                                        echo "Selected";
                                    }
                                    ?>>Other</option>
                                </select>
                                <div class="text-danger"><?= @$messages['error_StatusCivil'] ?></div>
                            </div>

                            <div class = "col-sm-4">
                                <label for = "statusType" style="color:white" class = "form-label">Employee Status</label>
                                <input type="hidden" id="StatusType" name="e_StatusType" value="1">
                            </div>
                            <div class = "col-sm-4">
                                <label for = "statusDate" style="color:white" class = "form-label">Status Date</label>
                                <input type="hidden" id="StatusDate" name="e_StatusDate" >
                            </div>
                            <div class = "col-sm-4">
                                <label for = "statusReason" style="color:white" class = "form-label">Status Reason</label>
                                <input type="hidden" id="StatusReason" name="e_StatusReason" value="New Apointment">
                            </div>

                            <div class = "col-6">
                                <label for = "contact1" class = "form-label">Contact <span style="color: red">*</span><span class = "text-body-secondary">(Mobile)</span></label>
                                <input type = "text" class = "form-control" id = "Contact1" name="e_Contact1" placeholder = "ex - 0718624932" value="<?= @$e_Contact1; ?>">
                                <div class="text-danger"><?= @$messages['error_Contact1'] ?></div>
                            </div>
                            <div class = "col-6">
                                <label for = "contact1" class = "form-label">Contact <span class = "text-body-secondary">2 (Home)</span></label>
                                <input type = "text" class = "form-control" id = "Contact2" name="e_Contact2" placeholder = "ex - 011xxxxxxx" value="<?= @$e_Contact2; ?>">
                            </div>

                            <div class = "col-8">
                                <label for = "email" class = "form-label">Email<span style="color: red">*</span></label>
                                <input type = "email" class = "form-control" id = "Email" name="e_Email" placeholder = "you@example.com"  value="<?= @$e_Email; ?>">
                                <div class="text-danger"><?= @$messages['error_Email'] ?></div>
                            </div>


                            <h6>Permanent Address</h6>
                            <div class = "col-sm-2">
                                <label for = "pmanentAddressNo" class = "form-label">No:</label>
                                <input type = "text" class = "form-control" id = "PmanentAddressNo" name="e_PmanentAddressNo"  placeholder = "35" value="<?php echo@$e_PmanentAddressNo; ?>">

                            </div>
                            <div class = "col-sm-4">
                                <label for = "pmanentAddLane" class = "form-label">Lane<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "PmanentAddLane" name="e_PmanentAddLane" placeholder = "Jayagath" value="<?php echo@$e_PmanentAddLane; ?>">
                                <div class="text-danger"><?= @$messages['error_PmanentAddLane'] ?></div>
                            </div>
                            <div class = "col-3">
                                <label for = "pmanentAddStreet" class = "form-label">Street <span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "PmanentAddStreet" name="e_PmanentAddStreet" placeholder = "Old Kottawa Road" value="<?php echo@$e_PmanentAddStreet; ?>">
                                <div class="text-danger"><?= @$messages['error_PmanentAddStreet'] ?></div>

                            </div>
                            <div class = "col-sm-3">
                                <label for = "PmanentAddTown" class = "form-label">Town<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "PmanentAddTown" name="e_PmanentAddTown" placeholder = "Kottawa" value="<?= @$e_PmanentAddTown; ?>">
                                <div class="text-danger"><?= @$messages['error_PmanentAddTown'] ?></div>
                            </div>

                            <h6>Current Address</h6>
                            <div class = "col-sm-2">
                                <label for = "currentAddNo" class = "form-label">No:</label>
                                <input type = "text" class = "form-control" id = "CurrentAddNo" name="e_CurrentAddNo" placeholder = "35" value="<?= @$e_CurrentAddNo ?>">
                            </div>
                            <div class = "col-sm-4">
                                <label for = "currentAddLane" class = "form-label">Lane</label>
                                <input type = "text" class = "form-control" id = "CurrentAddLane" name="e_CurrentAddLane" placeholder = "Jayagath " value="<?= @$e_CurrentAddLane; ?>">

                            </div>
                            <div class = "col-3">
                                <label for = "currentAddStreet" class = "form-label">Street </label>
                                <input type = "text" class = "form-control" id = "CurrentAddStreet" name="e_CurrentAddStreet" placeholder = "Old Kottawa Road" value="<?= @$e_CurrentAddStreet; ?>">

                            </div>
                            <div class = "col-sm-3">
                                <label for = "currentAddTown" class = "form-label">Town</label>
                                <input type = "text" class = "form-control" id = "CurrentAddTown" name="e_CurrentAddTown" placeholder = "Kottawa" value="<?= @$e_CurrentAddTown; ?>">

                            </div>

                            <div class = "col-md-8">
                                <label for = "designation" class = "form-label">Designation<span style="color: red">*</span></label>
                                <select class = "form-select" id = "Designation" name="e_Designation" >
                                    <option value = "">Choose...</option>                                     

                                    <option value = "dis_officer" <?php
                                    if (@$e_Designation == "dis_officer") {
                                        echo "Selected";
                                    }
                                    ?>>District Officer</option>                                      

                                    <option value = "div_officer" <?php
                                    if (@$e_Designation == "div_officer") {
                                        echo "Selected";
                                    }
                                    ?>>Divisional Officer</option>                                    

                                    <option value = "ma_admin" <?php
                                    if (@$e_Designation == "ma_admin") {
                                        echo "Selected";
                                    }
                                    ?>>Management Assistant : Admin & HR</option>                                           

                                    <option value = "ma_info" <?php
                                    if (@$e_Designation == "ma_info") {
                                        echo "Selected";
                                    }
                                    ?>>Management Assistant : Media & Information</option>                                             

                                    <option value = "ma_law" <?php
                                    if (@$e_Designation == "ma_law") {
                                        echo "Selected";
                                    }
                                    ?>>Management Assistant : Law Enforcement</option>                                             

                                    <option value = "ma_legal" <?php
                                    if (@$e_Designation == "ma_legal") {
                                        echo "Selected";
                                    }
                                    ?>>Management Assistant : Legal</option>                                             

                                    <option value = "ma_planning" <?php
                                    if (@$e_Designation == "ma_planning") {
                                        echo "Selected";
                                    }
                                    ?>>Management Assistant : Monitoring & Planning</option>                                             

                                    <option value = "ma_programme" <?php
                                    if (@$e_Designation == "ma_programme") {
                                        echo "Selected";
                                    }
                                    ?>>Management Assistant : Programme</option>                                                    

                                    <option value = "m_e_officer" <?php
                                    if (@$e_Designation == "m_e_officer") {
                                        echo "Selected";
                                    }
                                    ?>>Monitoring and Evaluation Officer</option>                                           

                                    <option value = "law_officer" <?php
                                    if (@$e_Designation == "law_officer") {
                                        echo "Selected";
                                    }
                                    ?>>Law Enforcement Officer</option> 

                                    <option value = "dir_plan_info" <?php
                                    if (@$e_Designation == "dir_plan_info") {
                                        echo "Selected";
                                    }
                                    ?>>Director Planning and Information</option>                                    

                                    <option value = "dir_prog" <?php
                                    if (@$e_Designation == "dir_prog") {
                                        echo "Selected";
                                    }
                                    ?>>Director Programme</option>

                                    <option value = "dir_admin" <?php
                                    if (@$e_Designation == "dir_admin") {
                                        echo "Selected";
                                    }
                                    ?>>Director Administration</option>

                                    <option value = "dir_finance" <?php
                                    if (@$e_Designation == "dir_finance") {
                                        echo "Selected";
                                    }
                                    ?>>Director Finance</option>

                                    <option value = "dir_lawenfoce" <?php
                                    if (@$e_Designation == "dir_lawenfoce") {
                                        echo "Selected";
                                    }
                                    ?>>Director Law Enforcement</option>

                                    <option value = "dir_legal" <?php
                                    if (@$e_Designation == "dir_legal") {
                                        echo "Selected";
                                    }
                                    ?>>Director Legal</option>

                                    <option value = "dir_phyco" <?php
                                    if (@$e_Designation == "dir_phyco") {
                                        echo "Selected";
                                    }
                                    ?>>Director Phycosocial</option>

                                    <option value = "director_general" <?php
                                    if (@$e_Designation == "director_general") {
                                        echo "Selected";
                                    }
                                    ?>>Director General</option>

                                </select>
                                <div class="text-danger"><?= @$messages['error_Designation'] ?></div>
                            </div>

                            <div class = "col-12">
                                <label for = "pofile" class = "form-label">Upload Profile Picture <span style="color: red">*</span></label>
                                <input type = "file" id = "ProfilePic" name="e_ProfilePic" class = "form-control" value="<?= @$e_ProfilePic; ?>">
                                <div class="myerror"><?= @$messages['error_image'] ?></div>

                            </div>
                        </div>


                        <hr class = "my-4">

                        <h5 class = "mb-3">Appointment location <span style="color: red">*</span></h5>

                        <div class = "col-md-4">
                            <select class = "form-select" id = "Type" name="o_Type" >
                                <option value = "">Choose...</option>
                                <option value = "1" <?php
                                if (@$o_Type == "1") {
                                    echo "Selected";
                                }
                                ?>>Head Office</option>
                                <option value = "2" <?php
                                if (@$o_Type == "2") {
                                    echo "Selected";
                                }
                                ?>>District Office</option>
                                <option value = "3" <?php
                                if (@$o_Type == "3") {
                                    echo "Selected";
                                }
                                ?>>Divisional Office</option>
                            </select>
                            <div class="text-danger"><?= @$messages['error_Type'] ?></div>
                        </div>

                        <hr class = "my-4">

                        <button class = "w-100 btn btn-primary btn-lg" type = "submit" value="submit">Continue to Appointment Location</button>

                    </form>
                </div>


            </div>
        </div>
    </div>
</main>


<?php include '../footer.php';
?>  
<?PHP ob_end_flush() ?>
