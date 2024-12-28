<?php
// include run the configeration
include '../../config.php';
//include database file
include '../../function.php';
extract($_POST);
$db = dbConn();
$sql = "SELECT * FROM tbl_list_divisions WHERE district_name ='$name_en'";
$result = $db->query($sql);
?>
<div class = "col-md-6">
    <label for = "name_en" class = "form-label"></label>

    <select class = "form-select" id = "idDivisionList" name="division_name" >
        <option value = "">Select Division<span style="color: red">*</span></option>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <option value="<?= $row['division_name'] ?>"><?= $row['division_name'] ?></option>
                <?php
            }
        }
        ?>           

    </select>
    <div class="text-danger"><?= @$messages['error_name_en'] ?></div>
</div>

