<?php
$msg = '';
$arrCustomerType = getCustomerType($strRootP);
$_SESSION['userInfo']['userID'] = 1;

if(isset($_POST['btnSubmit']) && isset($_SESSION['userInfo'])){
    extract($_POST);
    $currentDateTime = date("Y-m-d H:i:s");
    $name = $cmbTitle.' '.$txtFirstname.' '.$txtLastname;

    $strSQL = "insert into queue(qu_type, qu_name, srv_id, qu_time, qu_usr_id)";
    $strSQL .= " values(:qu_type, :qu_name, :srv_id, :qu_time, :qu_usr_id)";
    $arrDBParam[] = array(':qu_type', $rdbtnType, 'i');
    $arrDBParam[] = array(':qu_name', $name, 's');
    $arrDBParam[] = array(':srv_id', $rdbtnService, 'i');
    $arrDBParam[] = array(':qu_time', $currentDateTime, 's');
    $arrDBParam[] = array(':qu_usr_id', $_SESSION['userInfo']['userID'], 'i');
    $db->query($strSQL);
    $db->bindArray($arrDBParam);
    $db->execute();
    $msg = 'Record created successfully';
    unset($_SESSION['userInfo']['userID']);
}