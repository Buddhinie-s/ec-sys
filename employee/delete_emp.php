<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
       
        <div>
             <h4 class="h4 bg-danger">Delete Employee</h4>
                <h6 class="text-danger">Are you sure to delete bellow employee from the System ????</h6>
            </div>
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
               //print_r($_POST);
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate == 'delete') {
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_employee WHERE EmpID = '$EmpID'";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $e_EmpID = $row['EmpID'];
                    $e_EmpNo = $row['EmpNo'];
                    $e_NameFull = $row['NameFull'];
                    $e_NameInitials = $row['NameInitials'];
                    $e_NIC = $row['NIC'];
                    $e_Designation = $row['Designation'];

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
                        ?>
                
                      <?php
        
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate == 'delete') {
            $db = dbConn();

       // Delete records from the `tbl_ap_sub_activity` table
           $sql = "DELETE FROM tbl_employee WHERE EmpID='$EmpID'";
            // $sql = "DELETE FROM tbl_ap_sub_activity WHERE SubActivityID = '$SubActivityID'";
            $db->query($sql);

        }

        ?>


                <form method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2"  enctype="multipart/form-data">


                    <div class = "row g-3">
                        <div class = "col-sm-6">
                            <label for = "firstName" class = "form-label">Employee number</label>
                            <input type = "text" class = "form-control" id = "EmpNo" name = "e_EmpNo" value="<?php echo@$e_EmpNo; ?>">
                        </div>
                        <div class = "col-sm-12">
                            <label for = "firstName" class = "form-label">Full name</label>
                            <input type = "text" class = "form-control" id = "NameFull" name = "e_NameFull" value="<?php echo@$e_NameFull; ?>">
                        </div>

                        <div class = "col-sm-12">
                            <label for = "nameInitials" class = "form-label">Name with Initials</label>
                            <input type = "text" class = "form-control" id = "NameInitials" name="e_NameInitials" value="<?php echo@$e_NameInitials; ?>">
                        </div>                        
  
                        <div class = "col-sm-4">
                            <label for = "nic" class = "form-label">National identity card number</label>
                            <input type = "text" class = "form-control" id = "NIC" name="e_NIC" value="<?php echo@$e_NIC; ?>">
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
                    </div>


                    <hr class = "my-4">
                    <div class = "col-sm-4">
                    <!--<input type="text" name="EmpID" value="<?= $EmpID ?>"> -->

                    <input type="hidden" name="EmpID" value="<?= $EmpID ?>">
                    <a href="new_emp.php" type="submit" class="btn btn-danger" name="operete" value="delete">DELETE</a>
                            </div>
                </form>
            </div>


        </div>
    </div>
</div>
</main>


<?php include '../footer.php';
?>  
