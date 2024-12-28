
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Dashboard >> <?= $_SESSION['NAMEINITIALS'] ?></h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <?php
                $empid = $_SESSION['EMPID'];
                $db = dbConn();
                $sql = "SELECT COUNT(*) AS count FROM tbl_live_chat c WHERE c.Status ='1'AND c.To = '$empid'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $msg_count = $row['count'];
                ?>
                <a type="button" class="btn btn-sm notification" href="<?= SYSTEM_PATH ?>chat/view_received_chat.php" >Messages<span class="badge"><?= $msg_count ?></span></a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Sys.Msg</button>

            </div>
        </div>
    </div>
    <div class="row pb-2">
        <div class="col">
            <div class="card bg-warning bg-opacity-50">
                <div class="card-body">
                    <h5 class="card-title">Emp. Availability</h5>
                    <?php
                    $db = dbConn();
                    $sql = "SELECT COUNT(*) AS count_rows_district_emp FROM `tbl_employee` WHERE `Designation` LIKE 'dis%'";
                    $result2 = $db->query($sql);
                    $row2 = $result2->fetch_assoc();
                    $count_rows_district_emp = $row2['count_rows_district_emp'];

                    $sql = "SELECT COUNT(*) AS count_rows_divi_emp FROM `tbl_employee` WHERE `Designation` LIKE 'div%'";
                    $result3 = $db->query($sql);
                    $row3 = $result3->fetch_assoc();
                    $count_rows_divi_emp = $row3['count_rows_divi_emp'];
                    ?>
                    <h6 class="card-subtitle mb-2 text-muted">District, Division employee availability</h6>
                    <p class="card-text">Number of District Officers : <?= @$count_rows_district_emp; ?></p>
                    <p class="card-text">Number of Division Officers : <?= @$count_rows_divi_emp; ?></p>
                    <a href="districts_divisions/dis_div_emp_list.php" class="card-link">View All</a>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-success bg-opacity-25">
                <div class="card-body">
                    <h5 class="card-title">Employees Personal</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Over Strength</h6>
                    <?php
                    $sql = "SELECT COUNT(*) AS TotHeadEmp FROM tbl_employee e INNER JOIN tbl_employee_contact ec ON ec.EmpID =e.EmpID INNER JOIN tbl_office o ON o.EmpID =e.EmpID WHERE O.Type ='1' OR O.Type ='2' OR O.Type ='3'";
                    $result4 = $db->query($sql);
                    $row4 = $result4->fetch_assoc();
                    $TotHeadEmp = $row4['TotHeadEmp'];
                    ?>
                    <p class="card-text display-1"><?= @$TotHeadEmp; ?></p>
                    <a href="departments/emp_list.php" class="card-link">View</a>

                </div>
            </div>
        </div>
        <!--        <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Leave</h5>
                            <p class="card-text">To be develop.</p>
                            <a href="#" class="card-link">Click</a>
                        </div>
                    </div>
                </div>-->
    </div>

    <div class="row pb-2">

        <div class="col">
            <div class="card">
                <div class="col-md-9">                    
                    <h5 class="card-title">Head office , District and Division employee availability</h5>
                    <canvas id="myChartBar"></canvas>
                </div>
            </div>
        </div>
    </div>

    <?php
    $db = DBconn();

    $sql = "SELECT `OfficeID`, COUNT(`EmpID`) AS `empCount`, `Type`, CASE WHEN `Type` = 1 THEN 'Head Office' WHEN `Type` = 2 THEN 'District Office' WHEN `Type` = 3 THEN 'Division office' ELSE NULL END AS `TypeName` FROM `tbl_office` GROUP BY `Type`; ";

    $result = $db->query($sql);

// Initialize arrays for labels and data
    $labels = array();
    $empCount = array();
    $empType = array();

    foreach ($result as $data) {
        $labels[] = $data['TypeName']; // Store the custom names in the labels array
        $empCount[] = $data['empCount'];
        $empType[] = $data['Type'];
    }
    ?>



</main>

<script>
    const labels = <?= json_encode($labels) ?>;
    const data = {
        labels: labels,
        datasets: [{
                label: 'Employee Availability',
                data: <?= json_encode($empCount) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };


    var myChart = new Chart(
            document.getElementById('myChartBar'),
            config
            );
</script>
