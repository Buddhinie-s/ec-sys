<?php
// include run the configeration
include '../config.php';
//include database file
include '../function.php';
 extract($_POST);
$db = dbConn();

$sql2 = "SELECT `id`, `gnd_id`, `division_name`, `gnd_name` FROM `tbl_list_gnd` WHERE division_name ='$division_name'";
$result2 = $db->query($sql2);
?>



    <label for = "name_en" class = "form-label" style="color: red">*</label>

    <select class = "form-select" id = "idGNDivisionList" name="gndivision_name" >
        <option value = "">Select Grama Niladari Division</option>
        <?php
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                ?>
                <option value="<?= $row2['gnd_name'] ?>"><?= $row2['gnd_name'] ?></option>
                <?php
            }
        }
        ?>           

    </select>
    <div class="text-danger"><?= @$messages['error_gnd_name'] ?></div>

