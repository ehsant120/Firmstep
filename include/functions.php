<?php
function getServicesList(){
	global $db;
	
	$strSQL = "select srv_id, srv_name";
	$strSQL .= " from services";
	$strSQL .= " where srv_visible = 1";
	$strSQL .= " order by srv_name";
	$result = $db->simpleResultset($strSQL);
	
	return $result;
}
//=====================================

function getQueueList(){
	global $db;
	
	$strSQL = "select q.qu_type, q.qu_name, q.qu_time, s.srv_name";
    $strSQL .= " from queue as q";
    $strSQL .= " left join services as s";
    $strSQL .= " on q.srv_id = s.srv_id";
	$strSQL .= " where s.srv_visible = 1";
	$strSQL .= " order by q.qu_time";
	$result = $db->simpleResultset($strSQL);
	
	return $result;
}
//=====================================

function getServiceName($service){
	global $db;
	
	$arrDBParamLocal = array();
	
	$strSQL = "select srv_name";
	$strSQL .= " from services";
	$strSQL .= " where srv_id = :srv_id";
	$arrDBParamLocal[] = array(':srv_id', $service, 'i');
	$db->query($strSQL);
	$db->bindArray($arrDBParamLocal);
	$row = $db->row();
	return $row['srv_name'];
}
//=====================================

function getCustomerType($path){
	return json_decode(file_get_contents($path.'\data\customer-type.json'), true);
}
//=====================================
