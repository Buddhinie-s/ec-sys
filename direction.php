

<?php
if (!empty($issued_from) && !empty($issued_to)) {
$where .= " issue_date BETWEEN '$issued_from' AND '$issued_to' AND";
}
$sql = "SELECT DISTINCT(Type) AS Type, CASE WHEN `Type` = 1 THEN 'Head Office' WHEN `Type` = 2 THEN 'District Office' WHEN `Type` = 3 THEN 'Division office' ELSE NULL END AS `TypeName` FROM `tbl_office`";
echo '<script type="text/javascript">alert("Invalid Credit Format..!!");</script>';

$sql = "SELECT COUNT(CASE WHEN OfficeID > 0 THEN 1 ELSE NULL END) AS AssignedComplaints, COUNT(CASE WHEN OfficeID = 0 THEN 1 ELSE NULL END) AS UnassignedComplaints FROM tbl_complaint";

$sql = "SELECT CASE WHEN amount BETWEEN 0 AND 1000 THEN '0-1000' WHEN amount BETWEEN 1001 AND 5000 THEN '1001-5000' ELSE 'other' END AS my_range, COUNT(*) AS count FROM TBL_TRANSFAMATION GROUP BY my_range";

$sql = "SELECT subquery.total_balance, subquery.item_id, i.item_name, ic.name FROM ( SELECT SUM(item_qty-issue_qty) AS total_balance, item_id FROM stock GROUP BY item_id ) AS subquery LEFT JOIN item i ON i.item_code = subquery.item_id LEFT JOIN item_category ic ON ic.category_id=i.category_id  WHERE subquery.total_balance<='5'";

if (!preg_match('/^[0-9  ]+$/i', $creditlimit)) {
                $messages['error_creditlimit'] = "Invalid Credit Format..!"; }

//oke enna 0-9 athara sankaya witharai decimal point one nm meka use me widiyata ganna
//
if (!preg_match('/^[0-9 . ]+$/i', $creditlimit)) {
                $messages['error_creditlimit'] = "Invalid Credit Format..!"; 
                
}

if (!empty($nic)) {
            if (!preg_match("/^[19|20]{2}[0-9]{10}$/", $nic) AND!preg_match("/^[0-9]{9}[x|X|v|V]$/", $nic)) {$message['error_nic'] = "Invalid NIC No...!";} } else {
            $db = dbConn();
            $sql = "SELECT * FROM tbl_farmer WHERE Farmer_NIC=$nic";
            $result = $db->query($sql);
            if ($result->num_rows >= 1) {
                $message['error_nic'] = "NIC already exist..!";
                }
                }
?>



<!--search on change--> 
<input type="text" name="apName"  class="form-control" value = "<?= @$apName; ?>" onchange="form.submit()" placeholder="Enter action plan.">


