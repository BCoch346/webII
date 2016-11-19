<?php
function getArtist(){
    $id = DEFAULT_ARTIST_ID;
    if(isValid("artistid")){
        $id = $_GET["artistid"];
    }
    $artist = findArtistByID($id);
    if($artist == null){
        $artist = findArtistByID(DEFAULT_PAINTING_ID);
    }
    return $artist;
}
function getArtistDataField($field){
    $artist = getArtist();
    return utf8_encode($artist[$field]);
}
function getArtistName(){
    $artist = getArtist();
    return name_format($artist["FirstName"], $artist["LastName"]);
}
function createArtistInformationItem(){
    $artist = getArtist();

    return utf8_encode(createArtistItem($artist));
}
function createArtistItem($artist){
    $item = "<div class='item'>";
    $item .= "<div class='ui image'>" . createArtistMediumImage($artist) . "</div>";
    $item .= createArtistItemContent($artist);
    $item .= "</div>";

    return $item;
}
function createArtistItemContent($artist){
    $birthYear = $artist["YearOfBirth"];
    $deathYear = $artist["YearOfDeath"];
    $content = "<div class='content'>";
    $content .= "<strong>Nationality: </strong>" . $artist["Nationality"] . "<br />";
    $content .= "<strong>Gender: </strong>" . $artist["Gender"] . "<br />";
    $content .= "<strong>Year of birth: </strong>" . $birthYear . "<br />";
    $content .= "<strong>Year of death: </strong>" . $deathYear . " (age ". ($deathYear - $birthYear) . " )";
    $content .= "<div class='ui bottom attached'>";
    $content .= createArtistViewWorksButton($artist["ArtistID"]);
    $content .= createArtistFavoriteButton($artist["ArtistID"]);
    $content .= createAnchorTag($artist["ArtistLink"], "Wikipedia");
    $content .= "</div><br /><div class='ui horizontal divider'><div class='ui header'>Details</div></div>";
    $content .="<p>" . $artist["Details"]."</p>";
    $content .= "</div>";

    return $content;
}
function createArtistViewWorksButton($id){
    $button = "<a href='browse-paintings.php?artistid=$id'>";
    $button .= "<div class='ui right floated primary button'>View Works<i class='right chevron icon'></i></div>";
    $button .= "</a>";

    return $button;
}
function createArtistFavoriteButton($id){
    $button = "<button value=$id class='ui right floated button' id='addFav'>Add To Favourites <i class='heart icon'></i>";
    $button .= "</button>";

    return $button;
}
function createArtistWorks(){
    $artistID = DEFAULT_ARTIST_ID;
    if(isValid("artistid")){
        $artistID = $_GET["artistid"];
    }
    $paintings = findAllPaintingsByArtistID($artistID);
    $works = "";
    foreach($paintings as $painting){
        $works .= "<div class='ui column'><div class='ui image'>" . createWorksSquareMediumImageWithLink($painting) . "</div></div>";
    }
    return $works;

}

?>