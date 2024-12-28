<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Department >> New Department</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="new_Department.php" class="btn btn-sm btn-outline-secondary">New Department</a>
            </div>
            <div class="btn-group me-2">
                <a href="new_position.php" class="btn btn-sm btn-outline-secondary">New Position</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="row">

                <div class = "col-md-7 col-lg-10">


                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
//                        print_r($_POST);
//                        Convert array keeys to variable
                        extract($_POST);
                        $d_DptName = inputClean($d_DptName);
                        $d_Location = inputClean($d_Location);
                        $d_Head = inputClean($d_Head);

                        $messages = array();

                        if (empty($d_DptName)) {
                            $messages['error_DptName'] = "The Department Name should not be blank...!";
                        }
                        if (empty($d_Location)) {
                            $messages['error_Location'] = "The Location should not be blank...!";
                        }
                        if (empty($d_Head)) {
                            $messages['error_Head'] = "The department head should be selected...!";
                        }


                        // DB validation
                        if (!empty($d_DptName)) {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_department WHERE DptName='$d_DptName'";
                            $result = $db->query($sql);
//                            echo $result->num_rows;
                            if ($result->num_rows > 0) {
                                $messages['error_DptName'] = "This department is already exsist...!";
                            }
                        }


//                        insert data to database
//                        print_r($messages);
                        if (empty($messages)) {
                            extract($_POST);
                            $db = dbConn();
                            //get last item of the tbl office where   
                            $sql = "SELECT * FROM tbl_office WHERE Type = '1' ORDER BY OfficeID DESC LIMIT 1";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            $OFFICEID = $row['OfficeID'];

                            $sql = "INSERT INTO tbl_department(OfficeID, DptName, Location, Head) VALUES('$OFFICEID', '$d_DptName', '$d_Location', '$d_Head')";
                            $db->query($sql);
                        }
                        echo "<div class = 'alert  alert-success'>Data Saved...!</div>";
                        $d_DptName = $d_Location = $d_Head = null;
                    }
                    ?>

                    <!-- htmlspecialchars:  is often used to prevent security vulnerabilities, such as cross-site scripting attacks, by encoding special characters in user input.-->
                    <form method = "post" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class = "card p-2">

                        <div class = "row g-3">

                            <div class = "col-sm-12">
                                <label for = "DptName" class = "form-label">Department name</label>
                                <input type = "text" class = "form-control" id = "DptName" name = "d_DptName" >
                                <div class="text-danger"><?= @$messages['error_DptName'] ?></div>
                            </div>

                            <div class = "col-sm-12">
                                <label for = "location" class = "form-label">Location</label>
                                <input type = "text" class = "form-control" id = "Location" name="d_Location">
                                <div class="text-danger"><?= @$messages['error_Location'] ?></div>
                            </div> 

                            <div class = "col-md-4">
                                <label for = "location" class = "form-label">Head of the department</label>
                                <?php
                                $db = dbConn();
                                $sql = "SELECT `NameInitials`,`Designation` FROM `tbl_employee` WHERE LEFT(Designation , 3) <> 'dis'";
                                
                                $result = $db->query($sql);
                                ?>
                                <select class = "form-select" id = "Head" name="d_Head" >
                                    <option value = "">Choose...</option>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['NameInitials'] ?>" <?php
                                            if (@$d_Head == $row['NameInitials']) {
                                                echo "selected";
                                            }
                                            ?>><?= $row['NameInitials'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>  
                                </select>
                                <div class="text-danger"><?= @$messages['error_Head'] ?></div>
                            </div>  
                            <hr class = "my-1">

                            <button class = "w-50 btn btn-primary btn-lg" type = "submit" >Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include '../footer.php';
?>  