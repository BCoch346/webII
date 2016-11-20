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
function createBrowseGenreCards(){
    $allGenres = findAllGenresOrderedBy("EraID, GenreName");
    $output = "";
    foreach($allGenres as $genre){
        $output .= createGenreCard($genre);
    }
    return utf8_encode($output);
}
function createGenreCard($genre){
    $card = "<div class='ui card'>";
    $card .= "<div class='image'>".createImage("images/art/genres/square-medium/".$genre["GenreID"].".jpg", $genre["GenreName"], $genre["GenreName"], "", "")."</div>";
    $card .= "<a class='ui text content' href='single-genre.php?genreid=".$genre["GenreID"]."'><div class='extra header'>".$genre["GenreName"]."</div></a>";
    $card .= "</div>";

    return $card;
}
function createSingleGenrePictureGrid(){
    $genreID = DEFAULT_GENRE_ID;
    if(isValid("genreid")){
        $genreID = $_GET["genreid"];
    }
    $cards = "";
    $allPaintings = findPaintingsByGenreID($genreID);
    foreach($allPaintings as $painting){
        $cards .= "<div class='ui column link'>";
        $cards .= createWorksSquareMediumImageWithLink($painting);
        $cards .= "</div>";
    }

    return utf8_encode($cards);
}

function createSingleGenreHeader(){
    $genreID = 1;
    if(isValid("genreid")){
        $genreID = $_GET["genreid"];
    }
    $genre = findGenreByID($genreID);
    $header = "<div class='item'><div class='image'>";
    $header .= createGenreSquareMediumImage($genre) . "</div>";
    $header .= '<div class="content"><h2 class="ui header">'.$genre["GenreName"].'</h2>';
    $header .= '<div class="ui divider"></div>';
    $header .= '<div class="description"><p>'.$genre["Description"].'</p>';
    $header .= '</div></div></div>';

    return utf8_encode($header);
}

//----------------
//BROWSE MUSEUM---
//----------------
function createBrowseMuseumCards(){   
    $allGalleries = findAllGalleriesOrderedBy("GalleryName");
    $output = "";
    foreach($allGalleries as $gallery){
        $output .= createGalleriesCard($gallery);
    }
    return utf8_encode($output);
}
function createGalleriesCard($gallery){
    $card = "<div class='ui grey card'>";
    $card .= "<div class='ui top attached button' tabindex='0'><strong><h3 class='header'><a href='single-gallery.php?galleryid=".$gallery["GalleryID"]."'>". $gallery["GalleryName"]."</a><h3></strong></div>";
    $card .= "<div class='ui text content'><h5>".$gallery["GalleryCity"].", ".$gallery["GalleryCountry"]."</h5></div>";
    $card .= "</div>";

    return $card;
}

function gallerySegment(){
	$output = '<a href="single-gallery?galleryid='.$this->GalleryID.'">'.
			'<div class="ui segment gallery">'.
			'<h3 class="ui header">'.$this->GalleryName.'</h3>'.
			'<div class="ui divider"></div>'.
			'<p>'.$this->GalleryCity.', '.$this->GalleryCountry.'</p></div></a>';
	return $output;
}

function createSingleGalleryPictureGrid(){
    $galleryID = DEFAULT_GALLERY_ID;
    if(isValid("galleryid")){
        $galleryID = $_GET["galleryid"];
    }
    $limit = 20;
    $orderBy = 'Title';
    $cards = "";
    $allPaintings = findAllPaintingsByGalleryIDLimit($galleryID, $limit, $orderBy);
    foreach($allPaintings as $painting){
        $cards .= "<div class='ui column link'>";
        $cards .= createWorksSquareMediumImageWithLink($painting);
        $cards .= "</div>";
    }

    return utf8_encode($cards);
}
function createSingleGalleryHeader(){
    if(isValid("galleryid")){
        $galleryID = $_GET["galleryid"];
    }
    $gallery = findGalleryByID($galleryID);
    $header = "<div class='item'>";
    $header .= '<div class="content"><h2 class="ui header">'.$gallery["GalleryName"].'</h2>';
    $header .= '<div class="meta"><span>'.$gallery["GalleryCity"].', '.$gallery["GalleryCountry"].'</span></div>';
    $header .= '<div class="ui divider"></div>';
    $header .= '<div class="description"><h4>Website: </h4><a href="'.$gallery["GalleryWebSite"].'">'.$gallery["GalleryWebSite"].'
    </a></div>';
    $header .= '<h4>Location:</h4>'.createMuseumMap();
    $header .= '</div></div>';

    return utf8_encode($header);
}
function createMuseumMap(){
	if(isValid("galleryid")){
		$galleryID = $_GET["galleryid"];
	}
	$gallery = findGalleryByID($galleryID);
    $output = '<div id="map"></div><script> function createMap() {
        var uluru = {lat:'.$gallery["Latitude"].', lng:'.$gallery["Longitude"].'};
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      };</script>
      <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABLWIe4bJ_hsZvhr1DfJ8GDTnme_0BDiY&callback=createMap">
    </script>';
    return $output;
}

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

function createSingleSubjectPictureGrid(){
    $subjectID = DEFAULT_SUBJECT_ID;
    if(isValid("subjectid")){
        $subjectID = $_GET["subjectid"];
    }
    $limit = 20;
    $orderBy = 'Title';
    $cards = "";
    $allPaintings = findAllPaintingsBySubjectIDLimit($subjectID, $limit);
    foreach($allPaintings as $painting){
        $cards .= "<div class='ui column link'>";
        $cards .= createWorksSquareMediumImageWithLink($painting);
        $cards .= "</div>";
    }
    return utf8_encode($cards);
}
function createSingleSubjectHeader(){
    $subjectID = DEFAULT_SUBJECT_ID;
    if(isValid("subjectid")){
        $subjectID = $_GET["subjectid"];
    }
    $subject = findSubjectByID($subjectID);
    $header = "<div class='item'>";
    $header .= '<div class="content"><h2 class="ui header">'.$subject["SubjectName"].'</h2>';
    $header .= '<div class="ui divider"></div>';
    $header .= '</div></div>';

    return utf8_encode($header);
}




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

























