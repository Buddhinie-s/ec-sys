<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Complaint</h4>
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

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body bg-info bg-opacity-10">
                        <h5 class="card-title">New Complaint</h5>
                        <p class="card-text display-5">
                            <a href="new_complaint.php" class="card-link">Add New</a></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success bg-opacity-50">
                        <h5 class="card-title">Assign Complaint</h5>
                        <p class="card-text display-5">
                            <a href="assign_complaint.php" class="card-link">Assign</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <form class="row row-cols-lg-auto g-3 align-items-center">
<!--                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Add New Comer</label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Enter Product code</label>
                    </div>

                </div>

                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected>List </option>
                            <option value="1">Head Office</option>
                            <option value="2">District Office</option>
                            <option value="3">Divisional Office</option>
                        </select>
                        <label for="floatingSelect">Our Strength</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>-->
                
                
                <div class = "col-md-12 col-lg-12 order-md-last bg-success bg-opacity-10">

                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_complaint";
                    $result = $db->query($sql);
                    ?>
                    <div >
                        <table class="table table-striped table-sm">
                            <thead  class="thead-dark">
                            <td scope="col"><b>Complaint No </b></td>
                            <td scope="col"><b>Location Data </b></td>
                            <td scope="col"><b>Assign to </b></td>
                           </thead>

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
                                                 <form action="view_complaint.php" method="post">
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


            </form>
        </div>
    </div>
</main>
<?php include '../footer.php'; ?>