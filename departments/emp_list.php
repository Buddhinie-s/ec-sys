<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Employee Personal Contacts</h4>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">

            <div class="container">
                <h4>Head of the Officials </h4>


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name Initials</th>                        
                            <th scope="col"></th>
                            <th scope="col">Designation</th>                          
                            <th scope="col">Contacts</th>                     
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $db = dbConn();
                        $sql = "SELECT e.EmpID, e.NameInitials, e.Designation, e.Email, e.ProfilePic, GROUP_CONCAT(ec.Contact SEPARATOR ', ') AS Contacts FROM tbl_employee e INNER JOIN tbl_employee_contact ec ON ec.EmpID = e.EmpID WHERE e.Designation = 'director_general' GROUP BY e.EmpID";
                        $result = $db->query($sql);

                        $row = $result->fetch_assoc();

                        if ($row) {
                            if ($row['Designation'] == 'director_general') {
                                $Designation = 'Director General';
                            }
                        }
                        ?>
                        <tr> 
                            <td><?= $row['NameInitials'] ?></td>
                            <td><img class="resized-image" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $row['ProfilePic']; ?>" width="70" ></td>
                            <td><?= @$Designation; ?></td>
                            <td><?= $row['Contacts'] ?></td>
                            <td><?= $row['Email'] ?></td>
                        </tr>  
                    </tbody>
                </table>
            </div>
            <div class="container">
                <h4>Department contacts</h4>
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_department d INNER JOIN tbl_office o ON d.OfficeID = o.OfficeID INNER JOIN tbl_employee e ON e.EmpID = o.EmpID INNER JOIN tbl_employee_contact ec ON ec.EmpID =e.EmpID GROUP BY e.EmpID";
                $result = $db->query($sql);
                ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Department Name</th>
                            <th scope="col">Location</th>                        
                            <th scope="col">Head</th>

                            <th scope="col"></th>
                            <th scope="col">Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['DptName'] ?></td>
                                    <td><?= $row['Location'] ?></td>
                                    <td><?= $row['Head'] ?></td>
                                    <td><img class="resized-image" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $row['ProfilePic']; ?>" width="70" ></td>
                                    <td><?= $row['Contact'] ?></td>
                                </tr>

                                <?php
                                $i++;
                            }
                        } else {
                            echo "NO records!";
                        }
                        ?>
                    </tbody>
                </table>



            </div>


            <div class="container">
                <h4>Head Office </h4>


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name Initials</th>                        
                            <th scope="col"></th>
                            <th scope="col">Designation</th>                          
                            <th scope="col">Contacts</th>                     
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $db = dbConn();
                        $sql = "SELECT e.EmpID, e.NameInitials, e.Designation, e.Email, e.ProfilePic, GROUP_CONCAT(ec.Contact SEPARATOR ', ') AS Contacts FROM tbl_employee e INNER JOIN tbl_employee_contact ec ON ec.EmpID = e.EmpID WHERE e.Designation NOT LIKE 'dir%' AND e.Designation NOT LIKE 'dis%' AND e.Designation NOT LIKE 'div%' GROUP BY e.EmpID";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>


                                <tr> 
                                    <td><?= $row['NameInitials'] ?></td>
                                    <td><img class="resized-image" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $row['ProfilePic']; ?>" width="70" ></td>
                                    <td><?= $row['Designation'] ?></td>
                                    <td><?= $row['Contacts'] ?></td>
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


            <div class="container">
                <h4>Head Office Staff</h4>

                <div>
                    <div id="district" class="tabcontent bg-danger bg-opacity-25 pb-4">

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

                    <div id="division" class="tabcontent bg-success bg-opacity-25 pb-4">

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


            </div>

        </div>
</main>


<?php include '../footer.php';
?>  
