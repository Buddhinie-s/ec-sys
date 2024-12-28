<?PHP ob_start() ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">District Division officers workstation data</h4>
    </div>
    <?php
    //Get session variable
    $empid = $_SESSION['EMPID'];

    $db = dbConn();
    $sql = "SELECT d.DepartmentID, d.DptName, d.Location, d.Head, o.OfficeID, o.Type, e.EmpID, e.NameInitials, dp.DeptProgID, dp.DepartmentID, dp.DiaryDate, dp.SubActivityID, dp.HeldDate, dp.ActivityName, dp.Location, dp.BeniChildMale, dp.BeniChildFemale, dp.BeniAdultMale, dp.BeniAdultFemale, dp.FinancialPogress, dp.ResponsiblePerson, dp.Comment, dp.Proposals, dp.Approved,sast.SubActivityAssignID, sast.DeadLine, sast.AllocatedAmount, sast.AssignBy, sast.AssignTo, asa.KeyActivityID, asa.SubActivityNo, asa.SubActivityDescription, asa.OutputIndicator, asa.CommencementDate, asa.CompletionDate FROM tbl_department d INNER JOIN tbl_office o ON d.OfficeID = o.OfficeID INNER JOIN tbl_employee e ON o.EmpID = e.EmpID INNER JOIN tbl_department_progress dp on dp.DepartmentID = d.DepartmentID LEFT JOIN tbl_ap_sub_activity_assign_to sast ON sast.SubActivityID = dp.SubActivityID INNER JOIN tbl_ap_sub_activity asa ON asa.SubActivityID = sast.SubActivityID WHERE e.EmpID = '$empid' ORDER BY dp.DiaryDate ASC";
    $result = $db->query($sql);
    ?>

    <div class="row p-3">
        <button type="button" class="btn btn-outline-success col-sm-1 mb-2" onclick="printReport('report')">Print</button>
        <button type="button" class="btn btn-outline-warning col-sm-1 mb-2" onclick="exportReport('report', 'Budget Summary')">Export PDF</button>
        <!--        <button type="button" class="btn btn-outline-info col-sm-1 mb-2" onclick="emailReport()">Email</button>-->

    </div>

<link href="<?= SYSTEM_PATH ?>assets/css/tab.css" rel="stylesheet">


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Field Officer availability </h4>
    </div>
    <div>
        <button class="tablink" onclick="openPage('district', this, 'LightPink')">DISTRICT</button>
        <button class="tablink" onclick="openPage('division', this, 'DarkSeaGreen')" id="defaultOpen">DIVISION</button>

        <div id="district" class="tabcontent">

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">District</th>
                            <th scope="col">Name</th>
                            <th scope="col">Profile Pic</th>
                            <th scope="col">Ofc.Contact</th> 
                            <th scope="col">Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $db = dbConn();
                        $sql = "SELECT o.DistrictID, o.OfficeID, o.EmpID, o.Location, o.Designation, o.DistrictSecretariName, o.Name, oc.DistrictID, oc.Contact, e.EmpID, e.EmpNo, e.NameFull, e.Email, e.Designation, e.ProfilePic FROM tbl_district_office o JOIN tbl_district_office_contact oc on o.DistrictID = oc.DistrictID INNER JOIN tbl_employee e ON e.EmpID = o.EmpID";
                        $result = $db->query($sql);                   

                        if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {  
                                            
                        ?>

                        <tr>                              

                            <td><?= $i ?></td>
                            <td><?= $row['Name']; ?></td>
                            <td><?= $row['NameFull']; ?></td>
                            <td><img class="resized-image" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $row['ProfilePic']; ?>" width="100" ></td>
                            <td>0<?= $row['Contact'] ?></td>
                            <td><?= $row['Email'] ?></td>
                           
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

        <div id="division" class="tabcontent">
           
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">District</th>
                            <th scope="col">Division</th>
                            <th scope="col">Name</th>
                            <th scope="col">Profile Pic</th>
                            <th scope="col">Ofc.Contact</th> 
                            <th scope="col">Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $db = dbConn();
                        $sql = "SELECT o.DivisionID, o.OfficeID, o.EmpID, o.District, o.Location, o.Designation, o.DivisionSecretariName, o.Name AS Division, oc.DivisionID, oc.Contact, e.EmpID, e.EmpNo, e.NameFull, e.Email, e.Designation, e.ProfilePic FROM tbl_division_office o JOIN tbl_division_office_contact oc on o.DivisionID = oc.DivisionID INNER JOIN tbl_employee e ON e.EmpID = o.EmpID";
                        $result = $db->query($sql);                   

                        if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                           
                                        
                        ?>

                        <tr>                              

                            <td><?= $i ?></td>                            
                            <td><?= $row['District']; ?></td>
                            <td><?= $row['Division']; ?></td>
                            <td><?= $row['NameFull']; ?></td>
                            <td><img class="resized-image" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $row['ProfilePic']; ?>" width="100"></td>
                            <td>0<?= $row['Contact']; ?></td>
                            <td><?= $row['Email'] ?></td>
                           
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
    </div>


</main>


<?php include '../footer.php';
?>  
<?PHP ob_end_flush() ?>
<script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }

// Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    //function to print report
    function printReport(divid) {
        var divToPrint = document.getElementById(divid);
//      var divToPrint = document.getElementById('report');
////    allert(divToPrint);

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);
    }

//CREATE NEW VARIABLE 'doc' FROM jsPDF
// Document of 700mm wide and 1500mm high
    var doc = new jsPDF('p', 'mm', [800, 700]);
    function exportReport(divId, title) {
        doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
        doc.save('Report.pdf');
        }


</script>