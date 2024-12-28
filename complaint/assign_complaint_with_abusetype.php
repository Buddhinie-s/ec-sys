<?PHP ob_start() ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

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
            <div class="row">
                <div class = "col-md-12 col-lg-12">
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate == 'assign_officer') {
//                        print_r($_POST);
                        $db = dbConn();

                        $sql = "SELECT * FROM tbl_complaint c RIGHT JOIN tbl_complaint_contact cc ON c.ComplaintID = cc.ComplaintID WHERE c.ComplaintID = '$ComplaintID'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();

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

                        $ofcEmpID = $t1EmpID;

                        $db = dbConn();
                        $sql = "SELECT t1.EmpID AS t1EmpID, t1.EmpNo, t1.Gender, t1.NameInitials, t1.Designation AS t1Designation, t1.ProfilePic, t1.StatusType, t2.EmpID, t2.District, t2.DivisionName, t2.Designation FROM (SELECT `EmpID`, `EmpNo`, `Gender`, `NameInitials`, `Designation`, `ProfilePic`, `StatusType` FROM tbl_employee e) AS t1 LEFT JOIN (SELECT `EmpID`, `Name` AS District, '' as DivisionName, `Designation` FROM tbl_district_office dis UNION ALL SELECT `EmpID`, `District`, `Name` AS DivisionName, `Designation` FROM tbl_division_office dio) AS t2 ON t1.EmpID = t2.EmpID WHERE t1.EmpID = '$ofcEmpID'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        $ofcEmpID = $row['t1EmpID'];
                        $ofcEmpNo = $row['EmpNo'];
                        $ofcGender = $row['Gender'];
                        $ofcNameInitials = $row['NameInitials'];
                        $ofcDesignation = $row['t1Designation'];
                        $ofcProfilePic = $row['ProfilePic'];
                        $ofcStatusType = $row['StatusType'];
                        $ofcDistrict = $row['District'];
                        $ofcDivisionName = $row['DivisionName'];
                        $ofcDesignation = $row['Designation'];

                        $sql = "SELECT `OfficeID`, `EmpID`, `Type` FROM `tbl_office` WHERE EmpID = '$t1EmpID'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        $OfficeID = $row['OfficeID'];

                        $today_assign = date("Y-m-d");

                        $sql = "INSERT INTO `tbl_complaint_assign_to`( `ComplaintID`, `OfficeID`, `ComplaintForwardDate`) VALUES ('$ComplaintID','$OfficeID','$today_assign')";
                        $result = $db->query($sql);
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate == 'assign_officer_insert') {
                        $db = dbConn();

                        $sql = "UPDATE `tbl_complaint_assign_to` SET `AbuseType`='$AbuseType',`MaxResponceTime`='$Response_Time' WHERE ComplaintID = '$ComplaintID' ";
                        $db->query($sql);

                        $sql = "UPDATE `tbl_complaint` SET `OfficeID`='$OfficeID' WHERE ComplaintID = '$ComplaintID' ";
                        $db->query($sql);

                        header("Location: assign_complaint.php");
                    }
                    ?>
                    <h4 class = "mb-8">Assign  Complaint : <?php echo@$c_ComplaintNo; ?></h4>
                    <?php
                    if (@$ofcGender == "1") {
                        $Gender = 'Mr.';
                    }
                    if (@$ofcGender == "0") {
                        $Gender = 'Ms.';
                    }


                    if (@$ofcDesignation == "dis_officer") {
                        $Designation = 'District Officer';
                    }
                    if (@$ofcDesignation == "div_officer") {
                        $Designation = 'Divisional Officer';
                    }
                    ?>
                    <h4 class = "mb-3">To <?= @$Gender ?> <?= @$ofcNameInitials; ?>, <b><?= @$Designation ?></b>  of  <?= @$ofcDistrict; ?>, <?= @$ofcDivisionName; ?></h4>
                    <img class="resized-image border-4" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $ofcProfilePic; ?>" width="100" >
                    <div class="p-4" >
                        <form  method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2"  enctype="multipart/form-data" style="border: 2px solid red;">

                            <div class = "col-lg-11">
                                <label class = "form-label"><span style="color: red">Please select abuse type according to legal measures.</span></label>
                                <select  class = "form-select" id="AbuseType" name="AbuseType" >                                
                                    <option value="">--------</option>
                                    <option value="Compulsory education 1290">Compulsory education 1290</option>
                                    <option value="Child abuse 337">Child abuse 337</option>
                                    <option value="Domestic violence 79">Domestic violence 79</option>
                                    <option value="Child domestic workers 265">Child domestic workers 265</option>
                                    <option value="308A. Cruelty to children">308A. Cruelty to children</option>
                                    <option value="27A. ACO - Unlawful Custody">27A. ACO - Unlawful Custody</option>
                                    <option value="286A. Pornographic publications and exhibitions relevant to children">286A. Pornographic publications and exhibitions relevant to children</option>
                                    <option value="288. Causing or procuring children to beg.">288. Causing or procuring children to beg.</option>
                                    <option value="288B. Hiring or employing children to traffic in restricted articles">288B. Hiring or employing children to traffic in restricted articles</option>
                                    <option value="Sexual harassment 594">Sexual harassment 594</option>
                                    <option value="CYPO – Children and youth in need of care and protection">CYPO – Children and youth in need of care and protection.</option>
                                    <option value="Abduction from legal custody 109">Abduction from legal custody 109</option>
                                    <option value="352. Kidnapping">352. Kidnapping</option>
                                    <option value="360B Sexual exploitation of children">360B Sexual exploitation of children</option>
                                    <option value="360C Trafficking">360C Trafficking</option>
                                    <option value="360E Soliciting a child">360E Soliciting a child</option>
                                    <option value="363. Rape">363. Rape</option>
                                    <option value="364A Incest">364A Incest</option>
                                    <option value="365. Unnatural offences">365. Unnatural offences</option>
                                    <option value="365A. Acts of gross indecency between persons 1">365A. Acts of gross indecency between persons 1</option>
                                    <option value="365B. Grave sexual abuse 288">365B. Grave sexual abuse 288</option>
                                    <option value="71.CYPO – Neglect 906">71.CYPO – Neglect 906</option>
                                    <option value="76. CYPO –Selling tobacco 1">76. CYPO –Selling tobacco 1</option>
                                    <!-- Add more options here -->
                                </select>
                            </div>
                            <?php
                            $db = dbConn();
                            $sql2 = "SELECT `ComplaintAssignID`, `ComplaintForwardDate` FROM `tbl_complaint_assign_to` WHERE ComplaintID = '$ComplaintID'";
                            $result2 = $db->query($sql2);
                            $row2 = $result2->fetch_assoc();

                            $ComplaintForwardDate = $row2['ComplaintForwardDate'];
                            ?>

                            <div class = "col-lg-12">
                                <label class = "form-label">Complaint assign date is : <b><?= @$ComplaintForwardDate; ?></b></label>

                            </div>
                            <div class = "col-sm-4">
                                <label class = "form-label">Select Max. Response Time<span style="color: red">*</span></label>
                                <input type = "date" class = "form-control" id = "Response_Time" name="Response_Time">
                                <div class="text-danger"><?= @$messages['error_Response_Time'] ?></div>
                            </div>

                            <div class = "col-4 p-4">
                                <input type="hidden" name="ComplaintID" value="<?= $ComplaintID; ?>">
                                <input type="hidden" name="OfficeID" value="<?= $OfficeID; ?>">
                                <button type="submit" name="operate" value="assign_officer_insert" class="btn btn-primary btn-lg">Assign</button>

                            </div>

                        </form>
                    </div>

                    <div class = "col-md-12">
                        <table class="table table-striped ">
                            <tr> <td>Complaint forward from : </td><td><b><?php echo@$c_ComplaintForwardFrom; ?></b></td></tr>
                            <tr> <td>Complaint Date : </td><td><b><?php echo@$c_ComplaintDate; ?></b></td></tr>
                            <tr> <td>Complaint received from : </td><td><b><?php echo@$district; ?> , <?php echo@$division_name; ?> , <?php echo@$gndivision_name; ?></b></td></tr>
                            <tr> <td>Child name : </td><td><b><?php echo@$c_NameFull; ?></b></td></tr>
                            <tr> <td>Gender : </td><td><b><?php echo@$c_Gender; ?></b></td></tr>
                            <tr> <td>Age of a victimed child :</td><td><b><?php echo@$c_age; ?></b></td></tr>
                            <tr> <td>Child Contact :</td><td><b><?php echo@$c_Contact; ?></b></td></tr>
                            <tr> <td>Child living location :</td><td><b><?php echo@$c_Address; ?></b></td></tr>
                            <tr> <td>Child School :</td><td><b><?php echo@$c_school; ?></b></td></tr>
                            <tr> <td>Abuse info :</td><td><b><?php echo@$c_abuse; ?></b></td></tr>
                            <tr> <td>Complaint person :</td><td><b><?php echo@$c_person; ?></b></td></tr>
                            <tr> <td>Note :</td><td><b><?php echo@$c_note; ?></b></td></tr>
                        </table>
                    </div>
                </div>    

            </div>

        </div>


    </div>
</div>
</div>
</main>


<?php include '../footer.php';
?>  

<?PHP ob_end_flush() ?>
