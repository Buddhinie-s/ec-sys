<?PHP ob_start() ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">View Complaint</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="new_complaint.php" class="btn btn-sm btn-outline-secondary">New Complaint</a>
            </div>
            <div class="btn-group me-2">
                <a href="assign_complaint.php" class="btn btn-sm btn-outline-secondary">Assign Complaint</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="row g-5">
                <div class = "col-md-12 col-lg-12">


                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_complaint c RIGHT JOIN tbl_complaint_contact cc ON c.ComplaintID = cc.ComplaintID WHERE c.ComplaintID = '$ComplaintID'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
//                        print_r($row);

                        $ComplaintID = $row['ComplaintID'];
                        $OfficeID = $row['OfficeID'];
                        $c_ComplaintNo = $row['ComplaintNo'];
                        $c_ComplaintForwardFrom = $row['ComplaintForwardFrom'];
                        $c_ComplaintDate = $row['ComplaintDate'];
                        $district = $row['District'];
                        $division_name = $row['Division'];
                        $gndivision_name = $row['GaramasewaDivision'];
                        $c_NameFull = $row['ChildName'];
                        $c_Address = $row['Address'];
                        $c_school = $row['School'];
                        $c_abuse = $row['Description'];
                        $c_person = $row['ComplainedPerson'];
                        $c_note = $row['Remarks'];
                        $c_Gender = $row['Gender'];
                        $c_age = $row['age'];
                        $assign = $row['assign'];
                        $c_Contact = $row['Contact'];
                    }
                    ?>
                    <form id="form_division"  method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2"  enctype="multipart/form-data">

                        <div class = "row g-3">
                            <div class = "required-field col-sm-6">
                                <label for = "ComplaintNo" class = "form-label">Complaint number <span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "ComplaintNo" name = "c_ComplaintNo" value="<?php echo@$c_ComplaintNo; ?>">
                                <div class="text-danger"><?= @$messages['error_ComplaintNo'] ?></div>                             
                            </div>

                            <div class = "col-md-8">
                                <label for = "designation" class = "form-label">Complaint forward from<span style="color: red">*</span></label>
                                <select class = "form-select" id = "ComplaintForwardFrom" name="c_ComplaintForwardFrom" >
                                    <option value = "">Choose...</option>  
                                    <option value="Department of Legal"<?php
                                    if (@$c_ComplaintForwardFrom == "Department of Legal") {
                                        echo "Selected";
                                    }
                                    ?>>Dept. of Legal</option>
                                    <option value="Investigation Unit"<?php
                                    if (@$c_ComplaintForwardFrom == "Investigation Unit") {
                                        echo "Selected";
                                    }
                                    ?>>Investigation Unit (Dept. Law Enforcement)</option>
                                    <option value="1929 Unit"<?php
                                    if (@$c_ComplaintForwardFrom == "1929 Unit") {
                                        echo "Selected";
                                    }
                                    ?>>1929 Unit (Dept. Law Enforcement</option>
                                    <option value="Police Unit" <?php
                                    if (@$c_ComplaintForwardFrom == "Police Unit") {
                                        echo "Selected";
                                    }
                                    ?>>Police Unit (Dept. Law Enforcement</option>
                                    <option value="Department of Phycosocial"<?php
                                    if (@$c_ComplaintForwardFrom == "Department of Phycosocial") {
                                        echo "Selected";
                                    }
                                    ?>>Department of Phycosocial</option>

                                </select>

                                </select>
                                <div class="text-danger"><?= @$messages['error_ComplaintForwardFrom'] ?></div>
                            </div>

                            <div class = "col-sm-4">
                                <label for = "ComplaintDate" class = "form-label">Complaint Date<span style="color: red">*</span></label>
                                <input type = "date" class = "form-control" id = "ComplaintDate" name="c_ComplaintDate" value="<?php echo@$c_ComplaintDate; ?>">
                                <div class="text-danger"><?= @$messages['error_ComplaintDate'] ?></div>
                            </div>

                            <div class = "col-sm-4">
                                <label for = "name_en" class = "form-label" style="color: red">*</label>
                                <?php
                                $db = dbConn();
                                $sql = "SELECT id AS disID, province_id, name_en FROM `tbl_list_districts`";
                                $result = $db->query($sql);
                                ?>
                                <select class = "form-select" id = "name_en" name="name_en" onchange="loadDivision()">
                                    <option value = "">Select District</option>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['name_en'] ?>"<?php
                                            if (@$district == $row['name_en']) {
                                                echo 'selected';
                                            }
                                            ?>><?= $row['name_en'] ?></option>

                                            <?php
                                        }
                                    }
                                    ?>           

                                </select>
                                <div class="text-danger"><?= @$messages['error_name_en'] ?></div>
                            </div>

                            <div class = "col-sm-4" id="idDivisionList">
                                <?php
                                $db = dbConn();
                                $sql = "SELECT * FROM tbl_list_divisions WHERE district_name ='$district'";
                                $result = $db->query($sql);
                                ?>
                                <label for = "name_en" class = "form-label" style="color: red">*</label>

                                <select class = "form-select" id = "division_name" name="division_name"  onchange="loadGNDivision()">
                                    <option value = "">Select Division</option>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['division_name'] ?>" <?php
                                            if ($row['division_name'] == $division_name) {
                                                echo "selected";
                                            }
                                            ?>><?= $row['division_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>           

                                </select>
                                <!--Set ajex to load divisionLiat.php  -->
                            </div>
                            <div class = "col-sm-4" id="idGNDivisionList">
                                <?php
                                $db = dbConn();
                                $sql2 = "SELECT id, gnd_id, division_name, gnd_name AS gndivision_name FROM `tbl_list_gnd` WHERE division_name ='$division_name'";
                                $result2 = $db->query($sql2);
                                ?>
                                <label for = "name_en" class = "form-label" style="color: red">*</label>

                                <select class = "form-select" id = "gndivision_name" name="gndivision_name" >
                                    <option value = "">Select Grama Niladari Division</option>
                                    <?php
                                    if ($result2->num_rows > 0) {
                                        while ($row2 = $result2->fetch_assoc()) {
                                            ?>

                                            <option value="<?= $row2['gndivision_name'] ?>"<?php
                                            if ($row2['gndivision_name'] == $gndivision_name) {
                                                echo "selected";
                                            }
                                            ?>><?= $row2['gndivision_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>           

                                </select>
                                <!--Set ajex to load gnDivisionList.php  -->
                            </div>
                            <div class = "col-sm-12">
                                <label for = "firstName" class = "form-label" >Child name<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "NameFull" name = "c_NameFull" value="<?php echo@$c_NameFull; ?>">
                                <div class="text-danger"><?= @$messages['error_NameFull'] ?></div>
                            </div>                      



                            <div class = "col-sm-12">
                                <label for = "gender" class = "form-label">Gender<span style="color: red">*</span></label>
                                <div class = "form-check">
                                    <input class = "form-check-input" type = "radio" id = "M" name = "c_Gender" value="1" <?php
                                    if (isset($c_Gender) && $c_Gender == '1') {
                                        echo "checked";
                                    }
                                    ?>>
                                    <label class = "fcreditorm-check-label" for = "male">Male</span></label>
                                </div>
                                <div class = "form-check">
                                    <input class = "form-check-input" type = "radio" id = "F" name = "c_Gender" value="0" <?php
                                    if (isset($c_Gender) && $c_Gender == '0') {
                                        echo "checked";
                                    }
                                    ?>>
                                    <label class = "fcreditorm-check-label" for = "female">Female</label>
                                </div>

                                <div class="text-danger"><?= @$messages['error_Gender'] ?></div>
                            </div>


                            <div class = "col-sm-4">
                                <label for = "nic" class = "form-label">Child Age<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "age" name="c_age" value="<?php echo@$c_age; ?>">
                                <div class="text-danger"><?= @$messages['error_age'] ?></div>
                            </div>

                            <div class = "col-6">
                                <label for = "contact1" class = "form-label">Child Contact (If any..)</label>
                                <input type = "text" class = "form-control" id = "Contact" name="c_Contact" placeholder = "ex - 0718624932" value="<?php echo@$c_Contact; ?>">
                                <div class="text-danger"><?= @$messages['error_contact'] ?></div>
                            </div>
                            <div class = "col-sm-12">
                                <label  class = "form-label">Child living location<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "Address" name="c_Address" value="<?php echo@$c_Address; ?>">
                                <div class="text-danger"><?= @$messages['error_Address'] ?></div>
                            </div>
                            <div class = "col-sm-12">
                                <label  class = "form-label">School (No school : mention no)<span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "school" name="c_school" value="<?php echo@$c_school; ?>">
                                <div class="text-danger"><?= @$messages['error_school'] ?></div>
                            </div>
                            <div class = "col-12">
                                <label class = "form-label">Abuse information or Description <span style="color: red">*</span></label>
                                <input type = "text" class = "form-control" id = "abuse" name="c_abuse"  value="<?php echo@$c_abuse; ?>">
                                <div class="text-danger"><?= @$messages['error_abuse'] ?></div>

                            </div>
                            <div class = "col-sm-12">
                                <label class = "form-label">Complaint person details</label>
                                <input type = "text" class = "form-control" id = "person" name="c_person" value="<?php echo@$c_person; ?>">

                            </div>

                            <div class = "col-sm-12">
                                <label class = "form-label">Note :</label>
                                <input type = "text" class = "form-control" id = "note" name="c_note"  value="<?php echo@$c_note; ?>">
                            </div>                        
                        </div>
                        <hr class = "my-4">
                        <input type = "hidden" class = "form-control" id = "ComplaintID" name="ComplaintID"  value="<?php echo@$ComplaintID; ?>">

                        <form action="assign_complaint.php" method="post">
                            <td> 
                                <a href="assign_complaint.php" class = "w-50 btn btn-primary btn-lg" name="operate" value="update" type = "submit"> CLOSE </a>
                                <!--<button class = "w-50 btn btn-primary btn-lg" name="operate" value="update" type = "submit">CLOSE</button>-->
                            </td>                                     
                        </form>

                    </form>
                </div>


            </div>
        </div>
    </div>
</main>


<?php include '../footer.php';
?>  

<script>
    function loadDivision() {
        //get form data "formData" variable
        var formData = $('#form_division').serialize();
//        alert(formData);
        // call ajax function
        $.ajax({
            type: 'POST',
            // where is the location to wish get the data
            url: 'divisionList.php',
            // send 'formData to abive url
            data: formData,
            success: function (response) {
//                alert(response);
                $('#idDivisionList').html(response);

            },
            error: function () {
                alert('Error submitting the form!');
            }

        });
    }


    function loadGNDivision() {
        //get form data "formData" variable
        var formData = $('#form_division').serialize();
//        alert(formData);
        // call ajax function
        $.ajax({
            type: 'POST',
            // where is the location to wish get the data
            url: 'gnDivisionList.php',
            // send 'formData to abive url
            data: formData,
            success: function (response) {
                $('#idGNDivisionList').html(response);

            },
            error: function () {
                alert('Error submitting the form!');
            }

        });
    }



</script>
<?PHP ob_end_flush() ?>
