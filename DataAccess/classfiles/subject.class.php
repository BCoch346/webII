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
    
    function createBrowseSubjectsCards(){
    	$allSubjects = findAllSubjectsOrderedBy("SubjectName");
    	$output = "";
    	foreach($allSubjects as $subject){
    		$output .= createSubjectCard($subject);
    	}
    	return utf8_encode($output);
    }
    
    function createSubjectCard($subject){
    	$id = $subject["SubjectID"];
    	$limit = 1;
    	$holder = findAllPaintingsBySubjectIDLimit($id, $limit);
    	$img = '';
    	foreach($holder as $row){
    		$img = $row["ImageFileName"];
    		break;
    	}
    	$card = "<div class='ui card'>";
    	$card .= "<div class='image'>".createImage("images/art/works/square-medium/".$img.".jpg", $subject["SubjectName"], $subject["SubjectName"], "", "")."</div>";
    	$card .= "<a class='ui text content' href='single-subject.php?subjectid=".$subject["SubjectID"]."'><div class='extra header'>".$subject["SubjectName"]."</div></a>";
    	$card .= "</div>";
    
    	return $card;
    }
}
?>
