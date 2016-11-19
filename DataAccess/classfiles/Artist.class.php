<?php
class Artist extends DomainObject{
    private $ArtistID;
    private $FirstName;
    private $LastName;
    private $Nationality;
    private $Gender;
    private $YearOfBirth;
    private $YearOfDeath;
    private $Details;
    private $ArtistLink;
    private $works;

   protected static function getFieldNames(){
       return array("ArtistID", "FirstName", "LastName", "Nationality", "Gender", "YearOfBirth",
           "yearOfDeath", "Details", "ArtistLink");
   }
   public function __construct(array $data){
       parent::__construct($data);
   }
    public function getFullName($commaDelimited=bool){
        if($commaDelimited){
            return $this->lastName . ", " . $this->firstName;
        }
        else{
            return $this->firstName . " " . $this->lastName;
        }
    }

    public function getLifeSpan(){
        return $this->yearOfDeath - $this->yearOfBirth;
    }
    
    public function setWorks($data=array()){
    	if(!is_array($data)){
    		$data = array($data);
    	}
    	foreach($data as $painting){
    		$works[] = new Painting($painting);
    	}
    }
    
    public function getWorks(){
    	if(!is_array($this->works)){
    		$this->works = array($this->works);
    	}
    	return $this->works;
    }
    
    public function mediumImage(){
    	$name = getFullName(false);
    	$image = createImage("images/art/artists/medium/".$this->ArtistID.".jpg",$name,$name, "image", "");
    	return $image;
    }
    public function squareMediumImage(){
    	$name = getFullName(false);
    	 $image = createImage("images/art/artists/square-medium/".$this->ArtistID.".jpg",$name,$name, "image", "");
    	return $image;
    }
    public function squareThumbImage(){
    	$name = getFullName(false);
    	 $image = createImage("images/art/artists/square-thumb/".$this->ArtistID.".jpg",$name,$name, "image", "");
    	return $image;
    }
}
?>