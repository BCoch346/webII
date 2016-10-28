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
}
?>