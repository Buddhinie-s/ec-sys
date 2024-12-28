<?PHP ob_start() ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Assign Complaint</h4>
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
                <div class = "col-md-7 col-lg-7 order-md-last bg-info bg-opacity-25">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <?php
                        $db = dbConn();
                        $sql = "SELECT COUNT(*) AS row_count FROM tbl_complaint WHERE OfficeID = '0'";
                        $result = $db->query($sql);

                        $row = $result->fetch_assoc();
                        $emp_count = $row['row_count'];
                        ?>
                        <span class="text-primary">Number of complaints to be assign >></span>
                        <span class="badge bg-primary rounded-pill"><?= @$emp_count ?></span>
                    </h4>

                    <div class = "input-group">
                        <input type = "text" class = "form-control" placeholder = "Complaint No.">
                        <button type = "submit" class = "btn btn-secondary">Search</button>
                    </div>
                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_complaint WHERE OfficeID = '0'";
                    $result = $db->query($sql);
                    ?>
                    <div class = "input-group">
                        <table class="table table-striped">

                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $j = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>

                                            <td><?= $row['ComplaintNo'] ?></td>
                                            <td><?= $row['District'] ?>:<?= $row['Division'] ?>:<?= $row['GaramasewaDivision'] ?></td>
                                    <form action="edit_complaint.php" method="post">
                                        <td>
                                            <input type="hidden" name="ComplaintID" value="<?= $row['ComplaintID'] ?>">
                                            <button type="submit" name="operate" value="edit" class="btn btn-outline-warning btn-sm">Edit</button>
                                        </td>                                        
                                    </form>

                                    <form action="assign_complaint_to_officer.php" method="post">
                                        <td> <input type="hidden" name="ComplaintID" value="<?= $row['ComplaintID'] ?>">
                                            <button type="submit" name="operate" value="assign" class="btn btn-outline-success btn-sm">Assign</button>
                                        </td>                                     
                                    </form>

                                    </tr>
                                    <?php
                                    $j++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>


                <div class = "col-md-5 col-lg-5 order-md-last bg-success bg-opacity-10">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <?php
                        $db = dbConn();
                        $sql = "SELECT COUNT(*) AS row_count FROM tbl_complaint WHERE OfficeID != '0' ";
                        $result = $db->query($sql);

                        $row = $result->fetch_assoc();
                        $emp_count = $row['row_count'];
                        ?>
                        <span class="text-success">Number assigned Complaints</span>
                        <span class="badge bg-primary rounded-pill"><?= @$emp_count ?></span>
                    </h4>

                    <div class = "input-group">
                        <input type = "text" class = "form-control" placeholder = "Complaint No.">
                        <button type = "submit" class = "btn btn-secondary">Search</button>
                    </div>
                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_complaint WHERE OfficeID != '0'";
                    $result = $db->query($sql);
                    ?>
                    <div class = "input-group">
                        <table class="table table-striped">

                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $j = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?= $row['ComplaintNo'] ?></td>
                                            <td><?= $row['District'] ?>:<?= $row['Division'] ?>:<?= $row['GaramasewaDivision'] ?></td>

                                            <td>
                                                <form action="view_assign_complaint.php" method="post">
                                                    <input type="hidden" name="ComplaintID" value="<?= $row['ComplaintID'] ?>">
                                                    <button type="submit" name="operate" value="view" class="btn btn-outline-primary btn-sm">view</button>
                                                </form>
                                            </td>

                                        </tr>
                                        <?php
                                        $j++;
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
