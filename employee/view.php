<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h3">Dashboard >> Employee</h3>
    </div>

    <?php
    $db = dbConn();
    $sql = "SELECT COUNT(*) AS row_count FROM tbl_employee";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $emp_count = $row['row_count'];
    ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <div class="row">
            <div class="col-md-5 p-2">
                <div class="card">
                    <div class="card-body bg-info bg-opacity-10">
                        <h5 class="card-title">NEW</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total of the Employee :</h6>
                        <p class="card-text display-4"><?= @$emp_count ?></p>
                        <h5 class="card-text">Add New Employee :
                            <a href="new_emp.php" class="card-link">Add</a></h5>
                    </div>
                </div>
            </div>


            <div class="card border-top justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                <?php
                $where = null;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    extract($_POST);
//                    print_r($_POST);
                    if (!empty($Type)) {
                        $where .= " o.Type='$Type' AND";
                    }
//            if (!empty($DptName)) {
//                $where .= " sa.ResponsibleUnit='$DptName' AND";
//            }
//        if (!empty($from) && !empty($to)) {
//            $where .= " RegisteredDate BETWEEN '$from' AND '$to' AND";
//        }

                    if (!empty($where)) {
                        $where = substr($where, 0, -3);
                        $where = " WHERE $where";
                    }
                }


                $db = dbConn();
                $sql = "SELECT t1.EmpID AS t1EmpID, t1.EmpNo, t1.Gender, t1.NameInitials, t1.Designation AS t1Designation, t1.ProfilePic, t2.EmpID, t2.District, t2.DivisionName, t2.Designation, o.Type, t1.Email FROM (SELECT `EmpID`, `EmpNo`, `Gender`, `NameInitials`, `Designation`, `ProfilePic`, `Email` FROM tbl_employee e) AS t1 LEFT JOIN (SELECT `EmpID`,`Name` AS District,'' as DivisionName, `Designation` FROM tbl_district_office dis UNION ALL SELECT `EmpID`, `District`,`Name` AS DivisionName, `Designation` FROM tbl_division_office dio) AS t2 ON t1.EmpID = t2.EmpID LEFT JOIN tbl_office O ON O.EmpID=t1.EmpID $where";
                $result = $db->query($sql);
                ?>
                <form method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <div class="row p-2">

                        <div class="col-lg-auto">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT DISTINCT(Type) AS Type, CASE WHEN `Type` = 1 THEN 'Head Office' WHEN `Type` = 2 THEN 'District Office' WHEN `Type` = 3 THEN 'Division office' ELSE NULL END AS `TypeName` FROM `tbl_office`";
                            $result3 = $db->query($sql);
                            ?>
                            <select name="Type" class="form-control">
                                <option value="">--Select office type--</option>
                                <?php
                                if ($result3->num_rows > 0) {
                                    while ($row3 = $result3->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row3['Type'] ?>"><?= $row3['TypeName'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm">
                            <button type="submit" class="btn btn-warning">Search</button>
                        </div>
                    </div>
                </form>
                <div class="border-top d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">


                    <div class = "col p-4">
                        <h4 class = "d-flex justify-content-between align-items-center mb-3">
                            <?php
                            $db = dbConn();
                            $sql5 = "SELECT COUNT(*) AS row_count FROM tbl_employee";
                            $result5 = $db->query($sql5);

                            $row5 = $result5->fetch_assoc();
                            $emp_count = $row5['row_count'];
                            ?>
                            <span class="text-primary">Total number of Employees</span>
                            <span class="badge bg-primary rounded-pill"><?= @$emp_count ?></span>
                        </h4>


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
                                        if (@$Designation == "ma_admin") {
                                            $Designation = 'Management Assistant : Admin & HR';
                                        }
                                        if (@$Designation == "ma_info") {
                                            $Designation = 'Management Assistant : Media & Information';
                                        }
                                        if (@$Designation == "ma_law") {
                                            $Designation = 'Management Assistant : Law Enforcement';
                                        }
                                        if (@$Designation == "ma_phyco") {
                                            $Designation = 'Management Assistant : Phycosocial';
                                        }
                                        if (@$Designation == "ma_legal") {
                                            $Designation = 'Management Assistant : Legal';
                                        }
                                        if (@$Designation == "ma_planning") {
                                            $Designation = 'Management Assistant : Monitoring & Planning';
                                        }
                                        if (@$Designation == "ma_programme") {
                                            $Designation = 'Management Assistant : Programme';
                                        }
                                        if (@$Designation == "m_e_officer") {
                                            $Designation = 'Monitoring and Evaluation Officer';
                                        }
                                        if (@$Designation == "law_officer") {
                                            $Designation = 'Law Enforcement Officer';
                                        }
                                        if (@$Designation == "dir_plan_info") {
                                            $Designation = 'Director Planning and Information';
                                        }
                                        if (@$Designation == "dir_prog") {
                                            $Designation = 'Director Programme';
                                        }
                                        if (@$Designation == "dir_admin") {
                                            $Designation = 'Director Administration';
                                        }
                                        if (@$Designation == "dir_finance") {
                                            $Designation = 'Director Finance';
                                        }
                                        if (@$Designation == "dir_lawenfoce") {
                                            $Designation = 'Director Law Enforcement';
                                        }
                                        if (@$Designation == "dir_legal") {
                                            $Designation = 'Director Legal';
                                        }
                                        if (@$Designation == "dir_phyco") {
                                            $Designation = 'Director Phycosocial';
                                        }
                                        if (@$Designation == "director_general") {
                                            $Designation = 'Director General';
                                        }
                                        ?>
                                        <tr>
                                            <td><?= @$Gender ?> <?= $row['NameInitials'] ?>, <b><?= @$Designation ?></b>: <?= $row['District'] ?>, <?= $row['DivisionName'] ?></td>
                                            <td><img class="resized-image" src="<?= SYSTEM_PATH ?>assets/profile_images/<?= $row['ProfilePic']; ?>" width="70" ></td>

                                            <td>
                                                <?= $row['Email'] ?>
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

            </div>
        </div>

    </div>
</main>
<?php include '../footer.php'; ?>
