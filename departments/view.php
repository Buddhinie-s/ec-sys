<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Dashboard >> Departments</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="new_Department.php" class="btn btn-sm btn-outline-secondary">New Department</a>
            </div>
            <div class="btn-group me-2">
                <a href="new_position.php" class="btn btn-sm btn-outline-secondary">New Position</a>
            </div>
        </div>
    </div>

  
    <div class="table-responsive">

        <?php
        $db = dbConn();
        $sql = "SELECT d.DepartmentID,d.DptName,d.Location,d.Head,o.EmpID FROM tbl_department d INNER JOIN tbl_office o ON d.OfficeID = o.OfficeID";
        $result = $db->query($sql);
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Department Name</th>
                    <th>Location</th>
                    <th>Department Head</th>
                    <th>Dept.Members</th>
                    <th></th>
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
                            <td><?= $row['EmpID'] ?></td>
                            <td>
                                <form method="post" action="edit_department.php">
                                    <input type="hidden" name="DepartmentID" value="<?= $row['DepartmentID'] ?>">
                                    <button type="submit" name="operate_edit" value="edit" class="btn btn-warning btn-outline-dark btn-sm">Edit</button>
                                    <button type="submit" name="operate_delete" value="delete" class="btn btn-warning btn-outline-dark btn-sm">Delete</button>

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
</main>


<?php include '../footer.php';
?>  
