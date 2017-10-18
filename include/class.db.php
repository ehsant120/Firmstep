<?php
// http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/
// Custom Database wrapper for PDO

class Database{
	private $host = DB_HOST;
	private $port = DB_PORT;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;
	private $charset = DB_CHARSET;
	
	private $dbh;
	private $error;
	
	private $stmt;	
	
	public function __construct(){
		$dsn = 'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname.';charset='.$this->charset;

		$errorReporting = PDO::ERRMODE_SILENT;

		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => $errorReporting,
			PDO::MYSQL_ATTR_INIT_COMMAND => "set names ".$this->charset,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);

		try{
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		}
		catch(PDOException $e){
			$this->error = $e->getMessage();
			echo $this->error;
			die();
		}
	}
	
	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}	

	public function bind($param, $value, $type = null){
		if(is_null($type)){
			switch(true){
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		else{
			switch($type){
				case 'i':
					$type = PDO::PARAM_INT;
					break;
				case 'b':
					$type = PDO::PARAM_BOOL;
					break;
				case 'n':
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}
	
	public function bindArray(&$array, $clearArray = true){
		foreach($array as $v)
			$this->bind($v[0], $v[1], $v[2]);
			
		if($clearArray)
			$array = $this->clearParamArray();
	}

	public function prepareList(&$array, $list, $listName, $type){
		$arrValue = explode(",", $list);
		$strSQL = "";
		
		for($valueCount = count($arrValue), $iCnt = 1; $iCnt <= $valueCount; $iCnt++){
			if($iCnt > 1)
				$strSQL .= ", ";
			$strSQL .= $listName.$iCnt;	
			$array[] = array($listName.$iCnt, $arrValue[$iCnt - 1], $type);
		}
		
		return $strSQL;
	}

	public function execute(){
		return $this->stmt->execute();
	}

	public function row(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function rowLoop(){
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function simpleQuery($query){
		$this->dbh->query($query);
	}

	public function simpleRow($query){
		$this->stmt = $this->dbh->query($query);
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function simpleResultset($query){
		$this->stmt = $this->dbh->query($query);
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function rowCount(){
		return $this->stmt->rowCount();
	}

	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}	
	
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}

	public function endTransaction(){
		return $this->dbh->commit();
	}

	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}

	public function debugDumpParams(){
		return $this->stmt->debugDumpParams();
	}

	public function clearParamArray(){
		return array();
	}

	public function close(){
		$this->dbh = null;
		return true;
	}	
}

$db = new Database();
$arrDBParam = $db->clearParamArray();
?>