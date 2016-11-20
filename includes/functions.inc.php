<?php
include_once("queries.inc.php");
include_once("paintingFunctions.inc.php");
include_once("reviewFunctions.inc.php");
include_once("artistFunctions.inc.php");
include_once("favoriteFunctions.inc.php");

function isValid($key){
    $key = strtolower($key);
    if(isset($_GET[$key]) && !empty($_GET[$key]) && is_numeric($_GET[$key])){
        return true;
    }
    return false;
}
//------Basic functions-----
function createAnchorTag($href, $text){
    return utf8_encode("<a href='".$href."'>".$text."</a>");
}

function createListItem($class, $content){
    return utf8_encode("<li class='".$class."'>".$content."</li>");
}
function createSelectList($id, $itemID, $class, $listItems, $searchString){
    $list = "<select name='".strtolower($itemID)."' id='".$id."' class='".$class."'>";

    foreach($listItems as $item){
        $list .= createOption($item[$itemID], $item[$searchString]);
    }
    $list .= "</select>";
    return $list;
}
function createSelectListWithPlaceholder($id, $itemID, $class, $listItems, $searchString){
    $list = "<select name='".strtolower($itemID)."' id='".$id."' class='".$class."'>";
    $list .= "<option value=''>".$id."</option>";

    foreach($listItems as $item){
        $list .= createOption($item[$itemID], $item[$searchString]);
    }
    $list .= "</select>";
    return $list;
}
function createArtistSelectList($id, $class, $listItems){
    $list = "<select name='".strtolower($id)."id' id='".$id."' class='".$class."'>";
    $list .= "<option value=''>".$id."</option>";
    foreach($listItems as $item){
        $list .= createOptionWithName($item["ArtistID"],$item["FirstName"], $item["LastName"]);
    }
    $list .= "</select>";
    return $list;
}
function createOptionWithName($id, $first, $last){
    $option =  "<option value='".$id."'>".$first. " " . $last. "</option>";
    return $option;
}
function createOption($id, $text){
    $option =  "<option value='".$id."'>".$text."</option>";
    if(!strcmp($text, "[None]")){
        $option = "<option selected='true'>None</option>";
    }
    return $option;
}


//-------------
//-DROPDOWN----
//-------------
function createFrameDropdownSelectList(){
    $frames = findAllOfType("Frames");
    return utf8_encode(createSelectList("frame", "FrameID", "ui search dropdown", $frames, "Title"));
}
function createGlassDropdownSelectList(){
    $glass = findAllOfType("Glass");
    return utf8_encode(createSelectList("glass", "GlassID", "ui search dropdown", $glass, "Title"));
}
function createMattDropdownSelectList(){
    $matts = findAllOfType("Matt");
    return utf8_encode(createSelectList("matt", "MattID", "ui search dropdown", $matts, "Title"));
}
function createArtistDropdownSelectList(){
    $artists = findAllFromTableOrderBy("Artists", "FirstName");
    return utf8_encode(createArtistSelectList("Artist", "ui fluid search dropdown", $artists));
}
function createMuseumDropdownSelectList(){
    $museums = findAllFromTableOrderBy("Galleries", "GalleryName");
    return utf8_encode(createSelectListWithPlaceHolder("Museum", "GalleryID", "ui fluid search dropdown", $museums, "GalleryName"));
}
function createShapeDropdownSelectList(){
    $shapes = findAllFromTableOrderBy("Shapes", "ShapeName");
    return utf8_encode(createSelectListWithPlaceHolder("Shape", "ShapeID", "ui fluid search dropdown", $shapes, "ShapeName"));
}

//--------------------
//----CREATE IMAGES---
//--------------------
function createImage($src, $alt, $title, $class, $id){
    return utf8_encode('<img class="'.$class.'" id="'.$id.'" src="'.$src.'" alt="'.$alt.'" title="'.$title.'"/>');
}
////----GENRE----------
function createGenreSquareMediumImage($genre){
    return utf8_encode(createImage("images/art/genres/square-medium/".$genre["GenreID"].".jpg",$genre["GenreName"],$genre["GenreName"], "image", ""));
}
////----WORKS----------
function createWorksMediumImage($class, $htmlID){

    $painting = getPainting();
    return utf8_encode(createImage("images/art/works/medium/".$painting["ImageFileName"].".jpg",$painting["Title"],$painting["Title"], $class, $htmlID));
}
function createWorksSquareMediumImage($class, $painting){
    return utf8_encode(createImage("images/art/works/square-medium/".$painting["ImageFileName"].".jpg",$painting["Title"],$painting["Title"], $class, ""));
}
function createWorksLargeImage($class, $htmlID){
    $painting = getPainting();
    return utf8_encode(createImage("images/art/works/large/".$painting["ImageFileName"].".jpg",$painting["Title"],$painting["Title"], $class, $htmlID));
}
function createWorksSquareMediumImageWithLink($painting){
    $image = createImage("images/art/works/square-medium/".$painting["ImageFileName"].".jpg",$painting["Title"],$painting["Title"], "image", "");
    $link = createAnchorTag("single-painting.php?paintingid=".$painting["PaintingID"], $image);
    return $link;
}

////----ARTIST----------
function createArtistMediumImage($artist){
    $name = name_format($artist["FirstName"], $artist["LastName"]);
    $image = createImage("images/art/artists/medium/".$artist["ArtistID"].".jpg",$name,$name, "image", "");
    return $image;
}
function createArtistSquareMediumImage($artist){
    $name = name_format($artist["FirstName"], $artist["LastName"]);
    $image = createImage("images/art/artists/square-medium/".$artist["ArtistID"].".jpg",$name,$name, "image", "");
    return $image;
}
function createArtistSquareThumbImage($artist){
    $name = name_format($artist["FirstName"], $artist["LastName"]);
    $image = createImage("images/art/artists/square-thumb/".$artist["ArtistID"].".jpg",$name,$name, "image", "");
    return $image;
}
//----------------
//----MODALS------
//----------------
function createFullScreenPaintingModal($class){
    $painting = getPainting();
    $modal = "<div class='ui fullscreen modal'>";
    $modal .= "<div class='header'>".$painting["Title"]."</div>";
    $modal .= '<div class="image content">'. createWorksLargeImage($class, " ");
    $modal .= getPaintingDescription($painting);
    $modal .= "</div></div>";


    return utf8_encode($modal);
}
//----------------
//BROWSE PAINTING-
//----------------




function createBrowsePaintingItem($painting){
    $image = createWorksSquareMediumImage("ui rounded image", $painting);
    //$artist = findArtistByID($painting["ArtistID"]);

    $item = "<div class='item'>";
    $item .= "<div class='ui image'>";
    $item .= createAnchorTag("single-painting.php?paintingid=".$painting["PaintingID"], $image);
    $item .= "</div><div class='middle aligned content'>";
    $item .= "<h3 class='ui header'>" . $painting["Title"] . "<em class='sub header'>". $painting["FirstName"] . " " . $painting["LastName"] ."</em></h3>";
    $item .= "<br />" . $painting["Description"] . "<br />";
    $item .= "<div class='ui divider'></div><strong>" . "$ ". number_format($painting["Cost"] , 2). "</strong><br />";
    $item .= '<button type="submit" name="addtocart" class="ui orange button" value='. createButtonValue().'><i class="cart icon"></i></button>';
    $item .= '<button type="submit" name="addFavP" class="ui button" value='. $painting["PaintingID"].'><i class="favorite icon"></i></button>';
    $item .="</div></div>";

    return $item;
}


function createCurrentFilterString(){
    $string = "All Paintings [Top 20]";

    if(isValid("artistid")){
        $artist = findSingleFromTableByID("Artists", "ArtistID", $_GET["artistid"]);
        $string = "Artist = " . $artist["FirstName"] . " " . $artist["LastName"];
    }
    else if(isValid("galleryid")){
        $gallery = findSingleFromTableByID("Galleries", "GalleryID", $_GET["galleryid"]);
        $string = "Museum = " . $gallery["GalleryName"];
    }
    else if(isValid("shapeid")){
        $shape = findSingleFromTableByID("Shapes", "ShapeID", $_GET["shapeid"]);
        $string = "Shape = " . $shape["ShapeName"];
    }

    return utf8_encode($string);
}

function createSinglePaintingRating(){
    $paintingID = DEFAULT_PAINTING_ID;
    $stars='';
    if(isValid('paintingid')){
        $paintingID = $_GET['paintingid'];
    }
    $aveRating = findAverageRating($paintingID);
    if($aveRating==null){
        $stars .= "Not Rated";
    }
    else{
    foreach($aveRating as $rating){
    $rating = ceil($rating);
    for($i = 0; $i < $rating; $i++){
        $stars .= '<i class="orange star icon"></i>';
    }
    if($rating<5){
        $greyNo = 5-$rating;
        for($i = 0; $i < $greyNo; $i++){
           $stars .= '<i class="empty star icon"></i>';
        }
    }
            break;
    }
    }
    return utf8_encode($stars);
}

function createButtonValue(){
    $value = DEFAULT_PAINTING_ID;
    if(isValid("paintingid")){
        $value = $_GET["paintingid"];
    }
    $output= '"'.$value.'"';
    return $value;
}

//----------------
//BROWSE GENRE----
//----------------




//----------------
//BROWSE MUSEUM---
//----------------


//----------------
//BROWSE Artists--
//----------------
function createBrowseArtistCards(){
    $allArtists = findAllArtistsOrderedBy("LastName");
    $output = "";
    foreach($allArtists as $artist){
        $output .= createArtistCard($artist);
    }
    return utf8_encode($output);
}

function createArtistCard($artist){
    $card = "<div class='ui card'>";
    $card .= "<div class='image'>".createImage("images/art/artists/square-thumb/".$artist["ArtistID"].".jpg", $artist["FirstName"].$artist["LastName"], $artist["FirstName"].$artist["LastName"], "", "")."</div>";
    $card .= "<a class='ui text content' href='single-artist.php?artistid=".$artist["ArtistID"]."'><div class='extra header'>".$artist["FirstName"]." ".$artist["LastName"]."</div></a>";
    $card .= "</div>";

    return $card;
}
//----------------
//BROWSE Subjects-
//----------------





/////////////////////////////////////////////////////


function createIndividualFrameDropdownSelectList($paintingID){
    $frames = findAllOfType("Frames");
    return utf8_encode(createIndividualSelectList("frame", "FrameID", "ui search dropdown", $frames, "Title",'"'. $paintingID . 'FrameID"'));
}
function createIndividualGlassDropdownSelectList($paintingID){
    $glass = findAllOfType("Glass");
    return utf8_encode(createIndividualSelectList("glass", "GlassID", "ui search dropdown", $glass, "Title",'"'. $paintingID . 'FrameID"'));
}
function createIndividualMattDropdownSelectList($paintingID){
    $matts = findAllOfType("Matt");
    return utf8_encode(createIndividualSelectList("matt", "MattID", "ui search dropdown", $matts, "Title",'"'. $paintingID . 'FrameID"'));
}






function createIndividualSelectList($id, $itemID, $class, $listItems, $searchString, $name){
    $list = "<select name='".strtolower($name)."' id='".$id."' class='".$class."'>";

    foreach($listItems as $item){
        $list .= createOption($item[$itemID], $item[$searchString]);
    }
    $list .= "</select>";
    return $list;
}


//HEADER SESSION COUNTERS

function countFavorites(){
	$count = 0;
	if(isset($_SESSION['favorite_paintings'])&& !empty($_SESSION['favorite_paintings'])){
		$count += count($_SESSION['favorite_paintings']);
	}
	if(isset($_SESSION['favorite_artists'])&& !empty($_SESSION['favorite_artists'])){
		$count += count($_SESSION['favorite_artists']);
	}
	return $count;
}

function countCart(){
	if(isset($_SESSION['painting'])&& !empty($_SESSION['painting'])){
		return count($_SESSION['Painting']);
	}
	else{
		return 0;
	}
}



?>

























