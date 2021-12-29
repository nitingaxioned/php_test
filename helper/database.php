<?php

class Database {
	private $host;
	private $dbusername;
	private $dbpassword;
	private $dbname;
	private $dbms;
	private $dbmsStr;
	
	protected function connect(){
		$this->dbms = 'mysql';
		$this->host = 'localhost';
		$this->dbusername = 'root';
		$this->dbpassword = '';
		$this->dbname = 'chit_chat';
		$this->dbmsStr=$this->dbms.':host='.$this->host.';dbname='.$this->dbname;
		try {
			return new PDO($this->dbmsStr, $this->dbusername, $this->dbpassword);
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
}