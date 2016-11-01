<?php
define("DBCONN", 'mysql:host=localhost;dbname=art');
define("DBUSER", 'testuser');
define("DBPASS", 'mypassword');
define("DEFAULT_PAINTING_ID", 105);
define("DEFAULT_ARTIST_ID", 1);
define("DEFAULT_GENRE_ID", 1);
define("BROWSE_PAINTING_LIMIT", 20);
define("ADAPTERTYPE", "PDO");

include_once("queries.inc.php");
include_once("paintingFunctions.inc.php");
include_once("reviewFunctions.inc.php");
include_once("artistFunctions.inc.php");


function truncateString($string, $length){
    return utf8_encode(substr($string, 0, strpos(wordwrap($string, $length), "\n")));
}
function name_format($first, $last){
    return $first . " " . $last;
}
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

function getPaintingByFilter(){
    $orderBy = "YearOfWork";
    $paintings = findAllPaintingSortByLimit($orderBy, BROWSE_PAINTING_LIMIT);
    if(isValid("artistid")){
        $paintings = findAllPaintingsByArtistIDLimit($_GET["artistid"], BROWSE_PAINTING_LIMIT, $orderBy);
    }
    else if(isValid("galleryid")){
        $paintings = findAllPaintingsByGalleryIDLimit($_GET["galleryid"], BROWSE_PAINTING_LIMIT, $orderBy);
    }
    else if(isValid("shapeid")){
        $paintings = findAllPaintingsByShapeIDLimit($_GET["shapeid"], BROWSE_PAINTING_LIMIT, $orderBy);
    }

    return $paintings;
}
function createBrowsePaintingItems(){
    $allPaintings = getPaintingByFilter();
    $items = "<div class='ui divided items'>";
    foreach($allPaintings as $painting){
        if($painting != null){
            $items .= createBrowsePaintingItem($painting);
        }
    }
    $items .= "</div>";

    return utf8_encode($items);
}

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
    $item .= "<button class='ui orange button'><i class='cart icon'></i></button>";
    $item .= "<button class='ui button'><i class='favorite icon'></i></button>";
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
    $card = "<div class='ui card'>";
    $card .= "<a href='single_gallery.php?galleryid='".$gallery["GalleryID"]."' class='header'>". $gallery["GalleryName"]."</a>";
    $card .= "<div class='ui text content'><p>".$gallery["GalleryCity"].", ".$gallery["GalleryCountry"]."</p></div>";
    $card .= "</div>";

    return $card;
}
?>