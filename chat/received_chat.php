<?PHP ob_start() ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">chat receiving page</h4>
    </div>

    <?php
    extract($_GET);
    $ChatID = isset($ChatID) ? intval($ChatID) : null;

    if ($ChatID !== null) {
        $db = dbConn();

        $sql = "UPDATE `tbl_live_chat` SET `Status`='0' WHERE ChatID = '$ChatID'";
        $db->query($sql);
    }
  
    extract($_POST);
    $operate2 = isset($_POST['operate2']) ? $_POST['operate2'] : null;
//    echo $operate2 = isset($operate2) ? intval($operate2) : null;
    $DateTime = date('Y-m-d H:i:s', strtotime('now'));
    if ($operate2 == 'chatSend') {
        $db = dbConn();
        $sql = "INSERT INTO `tbl_live_chat`(`EmpID`, `DateTime`, `From`, `To`, `Message`, `Status`) VALUES ('$EMPID','$DateTime','$EMPID','$t1EmpID','$msg','1')";
        $db->query($sql);
    }
    ?>
    <script >
//        Swal.fire({
//            position: 'top-end',
//            icon: 'success',
//            title: 'Your chat sent',
//            showConfirmButton: false,
//            timer: 1500
//        })

    </script>
    <?php
    header("Location: view_received_chat.php");
    ?>
    <?php include '../footer.php'; ?>
    <?PHP ob_end_flush() ?>

