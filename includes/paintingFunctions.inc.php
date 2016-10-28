<?php

function getPainting(){
    $id = DEFAULT_PAINTING_ID;
    if(isValid("paintingid")){
        $id = $_GET["paintingid"];
    }
    $painting = findPaintingByID($id);
    if($painting == null){
        $painting = findPaintingByID(DEFAULT_PAINTING_ID);
    }
    return $painting;
}
function getPaintingDataField($field){
    $painting = getPainting();
    return utf8_encode($painting[$field]);
}
function getPaintingArtistLink(){
    $painting = getPainting();
    $artist = findArtistByID($painting["ArtistID"]);
    $anchor = createAnchorTag("single-artist.php?artistid=".$artist["ArtistID"], $artist["LastName"]);
    return utf8_encode($anchor);
}
function getPaintingDimensions(){
    $painting = getPainting();
    $dimensions = $painting["Height"]. " x " . $painting["Width"];
    return utf8_encode($dimensions);
}
function getGalleryNameFromPainting(){
    $painting = getPainting();
    $gallery = findGalleryByID($painting["GalleryID"]);
    return utf8_encode($gallery["GalleryName"]);
}
function createPaintingGenreList(){
    $painting = getPainting();
    $genres = findGenresByPaintingID($painting["PaintingID"]);
    $list = "<ul class='ui list'>";
    foreach($genres as $genre){
        //$genre = findGenreByID($paintingGenre["GenreID"]);
        $itemContent = createAnchorTag("single-genre.php?genreid=".$genre["GenreID"], $genre["GenreName"]);
        $list .= createListItem("item", $itemContent);
    }
    $list .= "</ul>";

    return utf8_encode($list);
}
function createPaintingCost(){
    $value = getPaintingDataField("Cost");
    return utf8_encode("$ ".number_format($value));
}

//----------------
//----DESCRIPTION-
//----------------
function getPaintingDescription($painting){
    $description = "<div class='description'><p>".$painting["Excerpt"]."</p></div>";

    return utf8_encode($description);
}

function currentPaintingDescription(){
    $painting = getPainting();

    return utf8_encode(getPaintingDescription($painting));
}

//-------------
//MAIN INFO----
//-------------
function createPaintingHeader(){
    $painting = getPainting();
    $header = "<h2 class='header'>" . $painting["Title"] . "</h2>";
    $artist = findArtistByID($painting["ArtistID"]);
    $header .= "<h3>" . $artist["LastName"] . "</h3>";

    return utf8_encode($header);
}

function createPaintingExcerpt(){
    $painting = getPainting();
    $excerpt = "<p>" . truncateString($painting["Excerpt"], 150) . "</P>";

    return utf8_encode($excerpt);

}




















?>