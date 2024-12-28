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

                    $sql = "SELECT o.EmpID, o.Type FROM tbl_employee e INNER JOIN tbl_office o ON e.EmpID=o.EmpID WHERE e.EmpNo='$EmpNo'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $o_Type = $row['Type'];
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate == 'update') {
//                    print_r($_POST);

                    $e_DptName = inputClean($e_DptName);

                    $messages = array();

                    if (!empty($e_EmpID)) {
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_position WHERE EmpID='$e_EmpID'";
                        $result = $db->query($sql);
//                            echo $result->num_rows;
                        if ($result->num_rows > 0) {
                            $messages['error_EmpID'] = "The employee already exsist...!";
                        }
                    }
                    if (empty($messages)) {
                        $db = dbConn();
                        $sql = "SELECT DepartmentID FROM tbl_department WHERE DptName = '$e_DptName'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        $DepartmentID = $row['DepartmentID'];

                        $sql = "INSERT INTO `tbl_position`(`DepartmentID`, `EmpID`, `PositionaIName`) VALUES('$DepartmentID', '$e_EmpID', '$e_Designation') ";
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

                    <input type="hidden" name="e_EmpID" value="<?= @$e_EmpID; ?>" >
                    <input type="hidden" name="e_Designation" value="<?= @$e_Designation; ?>" >
                    <div class = "col-md-6">
                        <?php
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_department";
                        $result = $db->query($sql);
                        ?>
                        <select class = "form-select" id = "DptName" name="e_DptName" >
                            <option value = "">Select Department</option>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['DptName'] ?>"><?= $row['DptName'] ?></option>
                                    <?php
                                }
                            }
                            ?>           

                        </select>

                    </div>

            </div>

            <hr class = "my-4">     

            <div class="text-danger"><?= @$messages['error_EmpID'] ?></div>
            <button type="submit" class="btn btn-primary" name="operate" value="update">Update</button>
            </form>
        </div>


    </div>
</div>
</div>
</main>


<?php include '../../footer.php';
?>  

<?PHP ob_end_flush() ?>

