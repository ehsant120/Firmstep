<?php
if(isset($_POST['btnSubmit'])){
    extract($_POST);

	$arrDBParam = array();
	
	$strSQL = "select *";
	$strSQL .= " from users";
	$strSQL .= " where usr_username = :usr_username";
	$arrDBParamLocal[] = array(':usr_username', $txtUsername, 's');
	$db->query($strSQL);
	$db->bindArray($arrDBParamLocal);
    $row = $db->row();
    if($db->rowCount() > 0){
        if(password_verify($txtPassword, $row['usr_password'])){
            $_SESSION['userInfo']['userID'] = $row['usr_id'];
            $_SESSION['userInfo']['userName'] = $row['usr_username'];
            header('Location: index.php');
            die();
        }
        else{
            $msg = 'Invalid username or password';
        }
    }
    else{
        $msg = 'Invalid username or password';
    }
}
