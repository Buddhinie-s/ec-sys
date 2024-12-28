<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 
 <style>
    .resized-image {
      max-width: 40%;
      max-height: 40%;
    }
  </style>
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
</script>
