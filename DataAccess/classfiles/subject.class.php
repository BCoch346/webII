<?php
class Subject extends DomainObject{
    private $SubjectID;
    private $SubjectName;

    protected static function getFieldNames(){
        return array("SubjectID", "SubjectName");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }
}
?>
