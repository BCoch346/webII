<?php
class PaintingSubject extends DomainObject{
    private $PaintingSubjectID;
    private $PaintingID;
    private $SubjectID;

    protected static function getFieldNames(){
        return array("PaintingSubjectID", "PaintingID", "SubjectID");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }
}
?>
