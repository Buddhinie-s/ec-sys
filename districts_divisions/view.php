<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Dashboard >> District & Divisional </h4>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body bg-info bg-opacity-50">
                        <h5 class="card-title">Districts</h5>
                        <p class="card-text ">Add New District :
                            <a href="new_district.php" class="card-link">Add</a></p>

                        <p class="card-text ">View Districts :
                            <a href="view_district.php" class="card-link">View</a></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body bg-warning bg-opacity-50">
                        <h5 class="card-title">Divisions</h5>
                        <p class="card-text ">Add New Division :
                            <a href="new_division.php" class="card-link">Add</a></p>

                        <p class="card-text ">View Divisions :
                            <a href="view_division.php" class="card-link">View</a></p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-secondary bg-opacity-50">
                    <div class="card-body">
                        <h5 class="card-title">Progress</h5>
                        <div class="card text-center">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="true" href="#">District</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Division</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="col-md-11">
                                    <select class="form-select" id="floatingSelect1" aria-label="Floating label select example">
                                        <option selected>Select District </option>
                                        <option value="1">District 1</option>
                                        <option value="2">District 2</option>
                                        <option value="3">District 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" id="floatingSelect2" aria-label="Floating label select example">
                                        <option selected>Select year </option>
                                        <option value="1">2023</option>
                                        <option value="2">2024</option>
                                        <option value="3">2025</option>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-select" id="floatingSelect3" aria-label="Floating label select example">
                                        <option selected>Select Month </option>
                                        <option value="1">Jan</option>
                                        <option value="2">feb</option>
                                        <option value="3">march</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-success bg-opacity-50">
                    <div class="card-body">
                        <h5 class="card-title">Calender</h5>
                        <label for="birthday">Select to view all progress:</label>
                        <input type="date" id="birthday" name="birthday"> 
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <form class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-12">
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
                </div>
            </form>
        </div>
    </div>
    
    <div id="calendar"></div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                    <td><a href="" class="btn btn-danger">Edit</a> <a href="" class="btn btn-success">Delete</a> <a href="" class="btn btn-info">More</a></td>
                </tr>
                <tr>
                    <td>1,002</td>
                    <td>placeholder</td>
                    <td>irrelevant</td>
                    <td>visual</td>
                    <td>layout</td>
                    <td><a href="" class="btn btn-danger">Edit</a> <a href="" class="btn btn-success">Delete</a> <a href="" class="btn btn-info">More</a></td>

                </tr>
                <tr>
                    <td>1,003</td>
                    <td>data</td>
                    <td>rich</td>
                    <td>dashboard</td>
                    <td>tabular</td>
                    <td><a href="" class="btn btn-danger">Edit</a> <a href="" class="btn btn-success">Delete</a> <a href="" class="btn btn-info">More</a></td>

                </tr>
                <tr>
                    <td>1,003</td>
                    <td>information</td>
                    <td>placeholder</td>
                    <td>illustrative</td>
                    <td>data</td>
                </tr>

            </tbody>
        </table>
    </div>
</main>
<?php include '../footer.php'; ?>
<script>
function('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
    },
    defaultDate: '2018-11-16',
    navLinks: true,
    eventLimit: true,
    events: [{
            title: 'Front-End Conference',
            start: '2018-11-16',
            end: '2018-11-18'
        },
        {
            title: 'Hair stylist with Mike',
            start: '2018-11-20',
            allDay: true
        },
        {
            title: 'Car mechanic',
            start: '2018-11-14T09:00:00',
            end: '2018-11-14T11:00:00'
        },
        {
            title: 'Dinner with Mike',
            start: '2018-11-21T19:00:00',
            end: '2018-11-21T22:00:00'
        },
        {
            title: 'Chillout',
            start: '2018-11-15',
            allDay: true
        },
        {
            title: 'Vacation',
            start: '2018-11-23',
            end: '2018-11-29'
        },
    ]
});
</script>