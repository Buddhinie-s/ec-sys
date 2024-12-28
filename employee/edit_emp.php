<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Edit Employee</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="new_emp.php" class="btn btn-sm btn-outline-secondary">New Employee</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="row g-5">


                <?php
                extract($_POST);
//                print_r($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate == 'edit') {
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_employee WHERE EmpID = '$EmpID'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();

                    $e_EmpID = $row['EmpID'];
                    $e_EmpNo = $row['EmpNo'];
                    $e_NameFull = $row['NameFull'];
                    $e_Gender = $row['Gender'];
                    $e_NameInitials = $row['NameInitials'];
                    $e_DOB = $row['DOB'];
                    $e_NIC = $row['NIC'];
                    $e_StatusCivil = $row['StatusCivil'];
                    $e_StatusType = $row['StatusType'];
                    $e_StatusDate = $row['StatusDate'];
                    $e_StatusReason = $row['StatusReason'];
                    $e_Email = $row['Email'];
                    $e_PmanentAddressNo = $row['PmanentAddressNo'];
                    $e_PmanentAddLane = $row['PmanentAddLane'];
                    $e_PmanentAddStreet = $row['PmanentAddStreet'];
                    $e_PmanentAddTown = $row['PmanentAddTown'];
                    $e_CurrentAddNo = $row['CurrentAddNo'];
                    $e_Designation = $row['Designation'];
                    $e_CurrentAddLane = $row['CurrentAddLane'];
                    $e_CurrentAddStreet = $row['CurrentAddStreet'];
                    $e_CurrentAddTown = $row['CurrentAddTown'];
                    $e_ProfilePic = $row['ProfilePic'];

                    $sql = "SELECT c.Contact FROM tbl_employee e INNER JOIN tbl_employee_contact c ON e.EmpID=c.EmpID WHERE e.EmpID = '$EmpID'";
                    $result_contact = $db->query($sql);
                    $e_Contact = array();
                    if ($result_contact->num_rows > 0) {
                        while ($row = $result_contact->fetch_assoc()) {
                            $e_Contact[] = $row['Contact'];
                        }
                    }
//                    print_r($e_Contact);
                    $sql = "SELECT o.EmpID, o.Type FROM tbl_employee e INNER JOIN tbl_office o ON e.EmpID=o.EmpID WHERE e.EmpID='$EmpID'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $o_Type = $row['Type'];
                }



                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operete == 'update') {
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
                    // DB validation
//                        if (!empty($e_EmpNo)) {
//                            $db = dbConn();
//                            
//                            $sql = "SELECT * FROM  tbl_employee WHERE EmpNo <> '$e_EmpNo'";
//                            $result = $db->query($sql);
////                            echo $result->num_rows;
//                            if ($result->num_rows > 0) {
//                                $messages['error_EmpNo'] = "The employee number updated...!";
//                            }
//                        }

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

//                    print_r($_POST);
                    if (empty($messages)) {
                        $db = dbConn();
                        $sql = "UPDATE tbl_employee SET  EmpNo = '$e_EmpNo', NameFull = '$e_NameFull', Gender = '$e_Gender', NameInitials= '$e_NameInitials', DOB= '$e_DOB', NIC= '$e_NIC', StatusCivil= '$e_StatusCivil', Email= '$e_Email', PmanentAddressNo= '$e_PmanentAddressNo', PmanentAddLane= '$e_PmanentAddLane', PmanentAddStreet= '$e_PmanentAddStreet', PmanentAddTown= '$e_PmanentAddTown', CurrentAddNo= '$e_CurrentAddNo', CurrentAddLane= '$e_CurrentAddLane', CurrentAddStreet= '$e_CurrentAddStreet', CurrentAddTown= '$e_CurrentAddTown', Designation= '$e_Designation', ProfilePic= '$file_new_name' WHERE EmpID='$EmpID'";
                        $db->query($sql);
                        $sql = "UPDATE tbl_employee_contact SET Contact = '$e_Contact1' WHERE EmpID='$EmpID'";
                        $db->query($sql);
                        $sql = "UPDATE tbl_employee_contact SET Contact = '$e_Contact2' WHERE EmpID='$EmpID'";
                        $db->query($sql);
                        $sql = "UPDATE tbl_office SET Type = '$o_Type' WHERE EmpID='$EmpID'";
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
                }
                ?>


                <!-- htmlspecialchars:  is often used to prevent security vulnerabilities, such as cross-site scripting attacks, by encoding special characters in user input.-->
                <form method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2"  enctype="multipart/form-data">


                    <div class = "row g-3">
                        <div class = "col-sm-6">
                            <label for = "firstName" class = "form-label">Employee number</label>
                            <input type = "text" class = "form-control" id = "EmpNo" name = "e_EmpNo" value="<?php echo@$e_EmpNo; ?>">
                            <div class="text-danger"><?= @$messages['error_EmpNo'] ?></div>                             
                        </div>
                        <div class = "col-sm-12">
                            <label for = "firstName" class = "form-label">Full name</label>
                            <input type = "text" class = "form-control" id = "NameFull" name = "e_NameFull" value="<?php echo@$e_NameFull; ?>">
                            <div class="text-danger"><?= @$messages['error_NameFull'] ?></div>
                        </div>

                        <div class = "col-sm-12">
                            <label for = "nameInitials" class = "form-label">Name with Initials</label>
                            <input type = "text" class = "form-control" id = "NameInitials" name="e_NameInitials" value="<?php echo@$e_NameInitials; ?>">
                            <div class="text-danger"><?= @$messages['error_NameInitials'] ?></div>
                        </div>                        
                        <div class = "col-sm-12">
                            <label for = "gender" class = "form-label">Gender</label>
                            <div class = "form-check">
                                <input class = "form-check-input" type = "radio" id = "M" name = "e_Gender" value="1" <?php
                                if (isset($e_Gender) && $e_Gender == '1') {
                                    echo "checked";
                                }
                                ?>>
                                <label class = "fcreditorm-check-label" for = "male">Male</label>
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
                            <label for = "dob" class = "form-label">Date of birth</label>
                            <input type = "date" class = "form-control" id = "DOB" name="e_DOB" value="<?php echo@$e_DOB; ?>">
                            <div class="text-danger"><?= @$messages['error_DOB'] ?></div>
                        </div>
                        <div class = "col-sm-4">
                            <label for = "nic" class = "form-label">National identity card number</label>
                            <input type = "text" class = "form-control" id = "NIC" name="e_NIC" value="<?php echo@$e_NIC; ?>">
                            <div class="text-danger"><?= @$messages['error_NIC'] ?></div>
                        </div>

                        <div class = "col-md-4">
                            <label for = "statusCivil" class = "form-label">Civil status</label>
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



                        <div class = "col-6">
                            <label for = "contact1" class = "form-label">Contact <span class = "text-body-secondary">(Mobile)</span></label>
                            <input type = "text" class = "form-control" id = "Contact1" name="e_Contact1" value="<?php echo@$e_Contact[0]; ?>">
                            <div class="text-danger"><?= @$messages['error_Contact1'] ?></div>
                        </div>
                        <div class = "col-6">
                            <label for = "contact1" class = "form-label">Contact <span class = "text-body-secondary">2 (Home)</span></label>
                            <input type = "text" class = "form-control" id = "Contact2" name="e_Contact2" value="<?php echo@$e_Contact[1]; ?>">
                        </div>

                        <div class = "col-8">
                            <label for = "email" class = "form-label">Email</label>
                            <input type = "email" class = "form-control" id = "Email" name="e_Email" value="<?= @$e_Email ?>">
                            <div class="text-danger"><?= @$messages['error_Email'] ?></div>
                        </div>


                        <h6>Permanent Address</h6>
                        <div class = "col-sm-2">
                            <label for = "pmanentAddressNo" class = "form-label">No:</label>
                            <input type = "text" class = "form-control" id = "PmanentAddressNo" name="e_PmanentAddressNo"  value="<?php echo@$e_PmanentAddressNo; ?>">

                        </div>
                        <div class = "col-sm-4">
                            <label for = "pmanentAddLane" class = "form-label">Lane</label>
                            <input type = "text" class = "form-control" id = "PmanentAddLane" name="e_PmanentAddLane" value="<?php echo@$e_PmanentAddLane; ?>">
                            <div class="text-danger"><?= @$messages['error_PmanentAddLane'] ?></div>
                        </div>
                        <div class = "col-3">
                            <label for = "pmanentAddStreet" class = "form-label">Street </label>
                            <input type = "text" class = "form-control" id = "PmanentAddStreet" name="e_PmanentAddStreet" value="<?php echo@$e_PmanentAddStreet; ?>">
                            <div class="text-danger"><?= @$messages['error_PmanentAddStreet'] ?></div>

                        </div>
                        <div class = "col-sm-3">
                            <label for = "PmanentAddTown" class = "form-label">Town</label>
                            <input type = "text" class = "form-control" id = "PmanentAddTown" name="e_PmanentAddTown" value="<?php echo@$e_PmanentAddTown; ?>">
                            <div class="text-danger"><?= @$messages['error_PmanentAddTown'] ?></div>
                        </div>

                        <h6>Current Address</h6>
                        <div class = "col-sm-2">
                            <label for = "currentAddNo" class = "form-label">No:</label>
                            <input type = "text" class = "form-control" id = "CurrentAddNo" name="e_CurrentAddNo" value="<?php echo@$e_CurrentAddNo; ?>">
                        </div>
                        <div class = "col-sm-4">
                            <label for = "currentAddLane" class = "form-label">Lane</label>
                            <input type = "text" class = "form-control" id = "CurrentAddLane" name="e_CurrentAddLane" value="<?= @$e_CurrentAddLane ?>" >

                        </div>
                        <div class = "col-3">
                            <label for = "currentAddStreet" class = "form-label">Street </label>
                            <input type = "text" class = "form-control" id = "CurrentAddStreet" name="e_CurrentAddStreet" value="<?= @$e_CurrentAddStreet ?>">

                        </div>
                        <div class = "col-sm-3">
                            <label for = "currentAddTown" class = "form-label">Town</label>
                            <input type = "text" class = "form-control" id = "CurrentAddTown" name="e_CurrentAddTown" value="<?= @$e_CurrentAddTown ?>" >

                        </div>

                        <div class = "col-md-8">
                            <label for = "designation" class = "form-label">Designation</label>
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
                            <label for = "pofile" class = "form-label">Upload Profile Picture</label>
                            <input type = "file" id = "ProfilePic" name="e_ProfilePic" class = "form-control">
                            <div class="myerror"><?= @$messages['error_image'] ?></div>

                        </div>
                    </div>


                    <hr class = "my-4">

                    <h5 class = "mb-3">Appointment location</h5>

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

                    <input type="text" name="EmpID" value="<?= $EmpID ?>">
                    <button type="submit" class="btn btn-primary" name="operete" value="update">Update</button>
                </form>
            </div>


        </div>
    </div>
</div>
</main>


<?php include '../footer.php';
?>  
