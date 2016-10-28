<?php
include_once("queries.inc.php");
function createStars($rating){
    if($rating < 0) {$rating = 0;}
    if($rating > 5) {$rating = 5;}
    $emptyStars = 5 - $rating;
    $stars = "";
    for($i = 0; $i < $rating; $i++){
        $stars .= "<i class='star icon'></i>";
    }
    for($i = 0; $i < $emptyStars; $i++){
        $stars .= "<i class='empty star icon'></i>";
    }
    return utf8_encode($stars);
}

function createPaintingReviews(){
    $reviews = "";
    if(isValid("paintingid")){
        $reviews = findReviewsByPaintingID($_GET["paintingid"]);
        $outputString = "";
        foreach($reviews as $review){
            $date = date_create($review["ReviewDate"]);
            $outputString .= "<div class='event'><div class='content'>";
            $outputString .= "<div class='date'>".date_format($date,'d-m-Y')."</div>";
            $outputString .= "<div class='meta'><a class='like'>";
            $outputString .= createStars($review["Rating"]);
            $outputString .= "</a></div>";
            $outputString .= "<div class='summary'>";
            $outputString .= $review["Comment"];
            $outputString .= "</div></div></div>";
            $outputString .= '<div class="ui divider"></div>';

        }

        return utf8_encode($outputString);
    }
}










?>