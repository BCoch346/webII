<?php


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
function createMuseumNameLink(){
    $painting = getPainting();
    $gName = getGalleryNameFromPainting();
    $link = '<a href="single-gallery.php?'.$painting["GalleryID"].'">'.$gName.'</a>';
    return utf8_encode($link);
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
function createPaintingSubjectList(){
    $painting = getPainting();
    $subjects = findSubjectsByPaintingID($painting["PaintingID"]);
    $list = "<ul class='ui list'>";
    foreach($subjects as $subject){
        //$genre = findGenreByID($paintingGenre["GenreID"]);
        $itemContent = createAnchorTag("single-subject.php?subjectid=".$subject["SubjectID"], $subject["SubjectName"]);
        $list .= createListItem("item", $itemContent);
    }
    $list .= "</ul>";

    return utf8_encode($list);
}
function createPaintingCost(){
    $value = getPaintingDataField("Cost");
    return utf8_encode("$ ".number_format($value));
}





















?>