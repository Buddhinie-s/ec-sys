<?PHP ob_start() ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Add Employee appointment location</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>employee/new_emp.php" class="btn btn-sm btn-outline-secondary">New Employee</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="row g-5">


                <?php
                extract($_POST);
                extract($_GET);
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_employee WHERE EmpNO = '$EmpNo'";
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

                    $sql = "SELECT o.OfficeID, o.EmpID, o.Type FROM tbl_employee e INNER JOIN tbl_office o ON e.EmpID=o.EmpID WHERE e.EmpNo='$EmpNo'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $o_OfficeID = $row['OfficeID'];
                    $o_Type = $row['Type'];
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate == 'update') {

                    $e_Location = inputClean($e_Location);
                    $e_DistrictSecretariName = inputClean($e_DistrictSecretariName);
                    $name_en = inputClean($name_en);
                    $e_Contact1 = inputClean($e_Contact1);

                    $messages = array();

                    if (empty($e_Location)) {
                        $messages['error_Location'] = " Location should be add...!";
                    }
                    if (empty($e_DistrictSecretariName)) {
                        $messages['error_DistrictSecretariName'] = " District Secretari Name...!";
                    }
                    if (empty($name_en)) {
                        $messages['error_name_en'] = "District Should Select!";
                    }

                    if (!empty($e_EmpID)) {
                        $db = dbConn();
                        $sql = "SELECT * FROM  tbl_district_office WHERE EmpID='$e_EmpID'";
                        $result = $db->query($sql);
//                            echo $result->num_rows;
                        if ($result->num_rows > 0) {
                            $messages['error_EmpID'] = "The employee already exsist...!";
                        }
                    }
                    if (empty($messages)) {
                        $db = dbConn();
                        echo $sql = "INSERT INTO `tbl_district_office`(`OfficeID`, `EmpID`, `Location`, `Designation`, `DistrictSecretariName`, `Name`) VALUES ('$o_OfficeID','$e_EmpID','$e_Location','$e_Designation','$e_DistrictSecretariName','$name_en') ";
                        $db->query($sql);
                        $DistrictID = $db->insert_id;
                        $sql = "INSERT INTO `tbl_district_office_contact`(`DistrictID`, `Contact`) VALUES('$DistrictID', '$e_Contact1')";
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
                        header("Location: ../../employee/new_emp.php");
                    }
                }
                ?>  



                <form method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2"  enctype="multipart/form-data">

                    <div class = "row g-3">
                        <div class = "col-sm-6">
                            <label for = "firstName" class = "form-label">Employee number :  <b><?php echo@$e_EmpNo; ?> </b></label>                     
                        </div>

                        <div class = "col-sm-12">
                            <label for = "nameInitials" class = "form-label">Name with Initials :  <b><?php echo@$e_NameInitials; ?> </b></label>
                        </div>  


                    <div class = "col-sm-6">
                        <label class = "form-label">Appointment location : <b><?php
                                if (@$o_Type == "1") {
                                    echo "Head Office";
                                }
                                if (@$o_Type == "2") {
                                    echo "District Office";
                                }
                                if (@$o_Type == "3") {
                                    echo "Divisional Office";
                                }
                                ?> </b></label>

                    </div> 
                    </br><!-- comment -->

                    <div class = "col-md-6">
                        <label for = "name_en" class = "form-label"></label>
                        <?php
                        $db = dbConn();
                        $sql = "SELECT `id`, `province_id`, `name_en` FROM `tbl_list_districts`";
                        $result = $db->query($sql);
                        ?>
                        <select class = "form-select" id = "name_en" name="name_en" >
                            <option value = "">Select District</option>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['name_en'] ?>"><?= $row['name_en'] ?></option>
                                    <?php
                                }
                            }
                            ?>           

                        </select>
                        <div class="text-danger"><?= @$messages['error_name_en'] ?></div>
                    </div>

                    <div class = "col-sm-12">
                        <label for = "Address" class = "form-label">Office Location/Address: <span style="color: red">*</span></label>
                        <input type = "text" class = "form-control" id = "Location" name="e_Location"  placeholder = "35, Upper Circuler Way, Rathnapura Town" value="<?php echo@$e_Location; ?>">
                        <div class="text-danger"><?= @$messages['error_Location'] ?></div>
                    </div>
                    <div class = "col-sm-12">
                        <label for = "DistrictSecretariName" class = "form-label">District Secretariat Name with addressing title:<span style="color: red">*</span></label>
                        <input type = "text" class = "form-control" id = "DistrictSecretariName" name="e_DistrictSecretariName"  placeholder = "Mr.Gunathilaka Gamhewage" value="<?php echo@$e_DistrictSecretariName; ?>">
                        <div class="text-danger"><?= @$messages['error_DistrictSecretariName'] ?></div>
                    </div>

                    <div class = "col-6">
                        <label for = "contact1" class = "form-label">Contact <span class = "text-body-secondary">(Office)</span></label>
                        <input type = "text" class = "form-control" id = "Contact1" name="e_Contact1" placeholder = "ex - 0718624932" value="<?php echo@$e_Contact1; ?>">

                    </div>

                    <input type="hidden" name="o_OfficeID" value="<?= @$o_OfficeID; ?>" >
                    <input type="hidden" name="e_EmpID" value="<?= @$e_EmpID; ?>" >
                    <input type="hidden" name="e_Designation" value="<?= @$e_Designation; ?>" >

                    </div>
                    <hr class = "my-4">     

                    <button type="submit" class="btn btn-primary" name="operate" value="update">Update</button>
                
                    </div> 
                </form>
            </div>


        </div>
    </div>
</div>
</main>


<?php include '../../footer.php';
?>  

<?PHP ob_end_flush() ?>

