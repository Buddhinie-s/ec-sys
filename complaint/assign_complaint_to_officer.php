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
                <div class = "col-md-7 col-lg-8">
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate == 'assign') {
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
                    }

                    ?>

                    <h4 class = "mb-3">Assign  Complaint : <?php echo@$c_ComplaintNo; ?></h4>

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

                <form  method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2"  enctype="multipart/form-data">
                    <h4 class="text-bg-info row-cols-2">Select the officer to work on assign complaint.</h4>
                    <?php
                    $db = dbConn();
                    $sql = "SELECT t1.EmpID AS t1EmpID, t1.EmpNo, t1.Gender, t1.NameInitials, t1.Designation AS t1Designation, t1.ProfilePic, t1.StatusType, t2.EmpID, t2.District, t2.DivisionName, t2.Designation FROM (SELECT `EmpID`, `EmpNo`, `Gender`, `NameInitials`, `Designation`, `ProfilePic`, `StatusType` FROM tbl_employee e) AS t1 LEFT JOIN (SELECT `EmpID`, `Name` AS District, '' as DivisionName, `Designation` FROM tbl_district_office dis UNION ALL SELECT `EmpID`, `District`, `Name` AS DivisionName, `Designation` FROM tbl_division_office dio) AS t2 ON t1.EmpID = t2.EmpID WHERE (t1.Designation = 'dis_officer' OR t1.Designation = 'div_officer') AND StatusType = 1";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    ?>

                    <div class = "col-sm-12">
                        <table class="table table-striped">
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $t1EmpID = $row['t1EmpID'];
                                        $Gender = $row['Gender'];
                                        if (@$Gender == "1") {
                                            $Gender = 'Mr.';
                                        }
                                        if (@$Gender == "0") {
                                            $Gender = 'Ms.';
                                        }

                                        $Designation = $row['t1Designation'];
                                        if (@$Designation == "dis_officer") {
                                            $Designation = 'District Officer';
                                        }
                                        if (@$Designation == "div_officer") {
                                            $Designation = 'Divisional Officer';
                                        }

                                        $emp_District = $row['District'];
                                        $emp_DivisionName = $row['DivisionName'];
                                        ?>
                                        <tr>
                                            <td><?= @$Gender ?> <?= $row['NameInitials'] ?>, <b><?= @$Designation ?></b>: <?= $row['District'] ?>, <?= $row['DivisionName'] ?></td>
                                            <td><img class="resized-image" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $row['ProfilePic']; ?>" width="70" ></td>

                                            <td scope="row"><?php
                                                if ($emp_DivisionName == $division_name) {
                                                    echo '<span style="color: blue;">Child lives in this division!</span>'
                                                    . '<span style="color: green;"><b> So the best person to assign this job!</b></span>';
                                                } elseif ($emp_District == $district && $Designation == 'District Officer') {
                                                    echo '<span style="color: Salmon ;">Child lives in this District!</span>';
                                                }
                                                ?>
                                            </td>   

                                            <td> 
                                                <form action="assign_complaint_with_abusetype.php" method="post">
                                                    <input type="hidden" name="ComplaintID" value="<?= $ComplaintID; ?>">
                                                    <input type="hidden" name="t1EmpID" value="<?= $t1EmpID; ?>">
                                                    <button type="submit" name="operate" value="assign_officer" class="btn btn-outline-success btn-sm">Assign</button>
                                                </form>
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
            </div>

            </form>
        </div>


    </div>
</div>
</div>
</main>


<?php include '../footer.php';
?>  

<?PHP ob_end_flush() ?>
