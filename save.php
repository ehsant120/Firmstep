<?php
require 'dirset.php';
include $strRootP.'\include\page-top.php';

$msg = '';
$arrCustomerType = getCustomerType($strRootP);
$_SESSION['userInfo']['userID'] = 1;

if(isset($_SESSION['userInfo'])){
    extract($_POST);
    $currentDateTime = date("Y-m-d H:i:s");
    $name = '';
    if($rdbtnType == '1')
        $name = $cmbTitle.' '.$txtFirstname.' '.$txtLastname;
    elseif($rdbtnType == '2')
        $name = $txtOrganisationName;
    elseif($rdbtnType == '3')
        $name = array_search($rdbtnType, $arrCustomerType);

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

    $customerType = array_search($rdbtnType, $arrCustomerType);
    $serviceName = getServiceName($rdbtnService);
    $queueTime = date('H:i', strtotime($currentDateTime));
    $string = '<tr>';
    $string .= '<th>{{rowNumber}}</th>';
    $string .= '<th>'.$customerType.'</th>';
    $string .= '<th>'.$name.'</th>';
    $string .= '<th>'.$serviceName.'</th>';
    $string .= '<th>'.$queueTime.'</th>';
    $string .= '</tr>';
    echo $string;
}
