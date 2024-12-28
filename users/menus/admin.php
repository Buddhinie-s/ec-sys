<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-navigator-ncpa bg-opacity-75 sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item bg-opacity-100 border-bottom border-2">
                <a class="nav-link active" aria-current="page" href="<?= SYSTEM_PATH ?>index.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard Administrator
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>employee/view.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Employee
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>departments/display.php">
                    <span data-feather="server" class="align-text-bottom"></span>
                    Department
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>chat/view_received_chat.php">
                    <span data-feather="message-square" class="align-text-bottom"></span>
                    Chat
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Saved reports</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle" class="align-text-bottom"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="<?= SYSTEM_PATH ?>reports/view_system_users.php">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    View system Users
                </a>
            </li>
        </ul>
    </div>
</nav>
