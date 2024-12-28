<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>  
<script src="../../assets/js/chart.js" type="text/javascript"></script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Departments List</h4>
        
    </div>

    <div class="card">
        <div class="card-body">
            <form class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Department Name</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
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
                    <!--<th>Dept.Members</th>-->
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
                            
                            <!--<td><?= $row['EmpID'] ?></td>-->
                            
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
                </table>

    </div>
     <div>
            <?php
            // Sample data points for X and Y axes
            $labels = ['January', 'February', 'March', 'April', 'May', 'June'];
            $data = [50, 60, 70, 65, 80, 75];
            ?>
            <!-- Add the canvas element for the line chart -->
            <canvas id="lineChart"></canvas>
        </div>
</main>


<?php include '../footer.php';
?>  

<script>
    // Convert PHP data to JavaScript variables
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($data); ?>;

    // JavaScript code to create the line chart
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels, // X-axis labels
            datasets: [{
                label: 'Sample Data',
                data: data, // Y-axis data points
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>