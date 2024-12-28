
<?PHP ob_start() ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  
<link href="<?= SYSTEM_PATH ?>assets/css/chatBox.css" rel="stylesheet" type="text/css"/>
<link href="<?= SYSTEM_PATH ?>assets/css/notificationButton.css" rel="stylesheet" type="text/css"/>


<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Popup Chat Window</h4>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="row g-3">

                <div >

                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$operate2 == 'chatSend') {
                        printf($_POST);
                    }
                    ?>

                    <div class = "col-md-12 col-lg-12 order-md-last">
                        <h4 class = "d-flex justify-content-between align-items-center mb-3">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(*) AS row_count FROM tbl_employee";
                            $result = $db->query($sql);

                            $row = $result->fetch_assoc();
                            $emp_count = $row['row_count'];
                            ?>
                            <span class="text-primary">Number of Employees</span>
                            <span class="badge bg-primary rounded-pill"><?= @$emp_count ?></span>
                        </h4>

<!--                        <div class = "input-group">
                            <input type = "text" class = "form-control" >
                            <button type = "submit" class = "btn btn-secondary">Search</button>
                        </div>-->
                        <?php
                        $EMPID = $_SESSION['EMPID'];
                        $db = dbConn();
                        $sql = "SELECT t1.EmpID AS t1EmpID, t1.EmpNo, t1.Gender, t1.NameInitials, t1.Designation AS t1Designation, t1.ProfilePic, t2.EmpID, t2.District, t2.DivisionName, t2.Designation FROM (SELECT `EmpID`, `EmpNo`, `Gender`, `NameInitials`, `Designation`, `ProfilePic` FROM tbl_employee e) AS t1 LEFT JOIN (SELECT `EmpID`,`Name` AS District,'' as DivisionName, `Designation` FROM tbl_district_office dis UNION ALL SELECT `EmpID`, `District`,`Name` AS DivisionName, `Designation` FROM tbl_division_office dio) AS t2 ON t1.EmpID = t2.EmpID ";
                        $result = $db->query($sql);
                        ?>
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

                                            <td colspan="8">
                                                <?php
                                                $empid = $_SESSION['EMPID'];
                                                $db = dbConn();
                                                $sql2 = "SELECT ChatID AS ChatID, EmpID, c.DateTime AS cDateTime , c.From AS cFrom, c.To AS cEmpId, Message, c.Status AS cStatus FROM tbl_live_chat c WHERE c.Status ='1' AND c.To = '$empid' AND EmpID='$t1EmpID' ";
                                                $result2 = $db->query($sql2);
                                                if ($result2->num_rows > 0) {
                                                    $j = 1;
                                                    while ($row2 = $result2->fetch_assoc()) {
                                                        $ChatID = $row2['ChatID'];
                                                        ?>

                                                        <input type="hidden" name="ChatID" id="ChatID" value="<?= $ChatID ?>" >
                                                        <div class = "alert alert-info" role = "alert"><?= $row2['cDateTime']; ?> <b> >> </b> <?= $row2['Message']; ?> <a type="button" value="<?= $t1EmpID ?>" href = "received_chat.php?ChatID=<?= $ChatID ?>" class = "btn btn-sm btn-outline-primary "><b>OK, Got it.</b></a> </div>

                                                        <?php
                                                        $j++;
                                                    }
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                ?>
                                                <button class="open-button" value="<?= $t1EmpID ?>" type="submit" name="operate1" onclick="openForm('<?= $t1EmpID ?>')">Chat</button>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="chat-popup" id="myForm">
                            <form action="received_chat.php" class="form-container" method="post">
                                <h1>Chat</h1>
                                <label for="msg"><b>Message</b></label>
                                <textarea placeholder="Type message.." name="msg" required></textarea>
                                <input type="hidden" name="t1EmpID" id="t1EmpID" >
                                <input type="hidden" name="EMPID" id="EMPID" value="<?= $EMPID ?>">
                                <button type="submit" name="operate2" value="chatSend" class="btn btn-warning">Send</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                            </form>
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
<script>
    function openForm(value) {
        document.getElementById('t1EmpID').value = value;
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }


</script>
