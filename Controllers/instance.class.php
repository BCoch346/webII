<?php
include("DataAccess/dataconnection/DatabaseAdapterFactory.class.php");
class Instance{
	protected $DBCONN = 'mysql:host=localhost;dbname=art';
	protected $DBUSER = 'testuser';
	protected $DBPASS = 'mypassword';
	protected $ADAPTERTYPE = "PDO";
	protected $dbAdapter;
	
	protected $DEFAULT_PAINTING_ID = 105;
	protected $DEFAULT_ARTIST_ID = 1;
	protected $DEFAULT_GENRE_ID = 1;
	protected $DEFAULT_GALLERY_ID = 2;
	protected $DEFAULT_SUBJECT_ID = 11;
	protected $BROWSE_PAINTING_LIMIT = 20;
	
	
	public function __construct(){
		$connectionValues = array($this->DBCONN, $this->DBUSER, $this->DBPASS);
		$this->dbAdapter = DataBaseAdapterFactory::create($this->ADAPTERTYPE, $connectionValues);
		
	}
	
	protected function getPDOConnection(){
		print_r("type: ".$this->ADAPTERTYPE);
		print_r(" --  uname: ".$this->DBUSER);
		print_r(" -- pass: ".$this->DBPASS);
		print_r(" -- dbconn: ".$this->DBCONN);
		
		$adapter = DatabaseAdapterFactory::create($this->ADAPTERTYPE, array($this->DBCONN, $this->DBUSER, $this->DBPASS));
		
	}
	
	public function isValid($key){
		$key = strtolower($key);
		if(isset($_GET[$key]) && !empty($_GET[$key]) && is_numeric($_GET[$key])){
			return true;
		}
		return false;
	}
}

?>