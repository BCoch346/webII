<?php

//-----------------------
//------PDO-------------
//---------------------
function PDO(){
	try{
		$pdo = new PDO(DBCONN, DBUSER, DBPASS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
	}
	catch(PDOException $e){
		die( $e->getmessage() );
	}
}
function runQuery($pdo, $sql, $parameters=array()){
    if(!is_array($parameters)){
        $parameters = array($parameters);
    }
    try{
        $statement = null;
        if(count($parameters > 0)){
            $statement = $pdo->prepare($sql);
            $statement->execute($parameters);
        }
        else{
            $statement = $pdo->query($sql);
        }
        return $statement;
    }
    catch(PDOException $e){
        throw $e;
    }
}

function queryDatabaseForSingleItem($pdo, $sql, $parameters=array()){
    $result = queryDatabaseForDataSet($pdo, $sql, $parameters);
    return $result->fetch();
}
function queryDatabaseForDataSet($pdo, $sql, $parameters=array()){
    $statement = runQuery($pdo, $sql, $parameters);
    return $statement;
}

//-----------------------
//-----QUERIES----------
//-----------------------
function findPaintingByID($id){
    $pdo = PDO();
    $sql = "SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description,
            YearOfWork, Width, Height, Medium, Cost, GoogleLink, GoogleDescription, WikiLink, Excerpt
            FROM Paintings WHERE PaintingID = $id";
    $statement = queryDatabaseForSingleItem($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllPaintingsByArtistID($id){
    $pdo = PDO();
    $sql = "SELECT ImageFileName, Title, PaintingID FROM Paintings WHERE ArtistID = $id";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findPaintingByIDOrderBy($id, $orderBy){
    $pdo = PDO();
    $sql = "SELECT * FROM Paintings WHERE PaintingID = $id ORDER BY $orderBy";
    $statement = queryDatabaseForSingleItem($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllPaintingsByArtistIDLimit($id, $limit, $orderBy){
    $pdo = PDO();
    $sql = "SELECT PaintingID, ImageFileName, Title, Description, Cost, FirstName, LastName FROM Paintings JOIN Artists ON Paintings.ArtistID = Artists.ArtistID WHERE Artists.ArtistID = $id ORDER BY $orderBy LIMIT $limit" ;
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllPaintingsByGalleryIDLimit($id, $limit, $orderBy){
    $pdo = PDO();
    $sql = "SELECT PaintingID, ImageFileName, Title, Description, Cost, FirstName, LastName FROM Paintings JOIN Artists ON Paintings.ArtistID = Artists.ArtistID WHERE GalleryID = $id ORDER BY $orderBy LIMIT $limit ";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllPaintingsByShapeIDLimit($id, $limit, $orderBy){
    $pdo = PDO();
    $sql = "SELECT PaintingID, ImageFileName, Title, Description, Cost, FirstName, LastName FROM Paintings JOIN Artists ON Paintings.ArtistID = Artists.ArtistID WHERE ShapeID = $id ORDER BY $orderBy LIMIT $limit";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllPaintingSortBy($sortOrder){
    $pdo = PDO();
    $sql = "SELECT PaintingID, ImageFileName, Title, Description, Cost, FirstName, LastName FROM Paintings JOIN Artists ON Paintings.ArtistID = Artists.ArtistID ORDER BY " . $sortOrder;
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllPaintingSortByLimit($sortOrder, $limit){
    $pdo = PDO();
    $sql = "SELECT PaintingID, ImageFileName, Title, Description, Cost, FirstName, LastName FROM Paintings JOIN Artists ON Paintings.ArtistID = Artists.ArtistID ORDER BY " . $sortOrder . " LIMIT " . $limit;
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}

function findGenresByPaintingID($id){
    $pdo = PDO();
    $sql = "SELECT Genres.GenreID, GenreName FROM Genres JOIN PaintingGenres ON Genres.GenreID = PaintingGenres.GenreID JOIN Paintings ON Paintings.PaintingID = PaintingGenres.PaintingID WHERE Paintings.PaintingID = ". $id;
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findPaintingsByGenreID($id){
    $pdo = PDO();
    $sql = "SELECT ImageFileName, Title, Paintings.PaintingID FROM Paintings INNER JOIN PaintingGenres ON Paintings.PaintingID = PaintingGenres.PaintingID INNER JOIN Genres ON Genres.GenreID = PaintingGenres.GenreID WHERE Genres.GenreID = $id ORDER BY YearOfWork";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
///--ARTIST
function findArtistByID($id){
    $pdo = PDO();
    $sql = "SELECT ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details, ArtistLink FROM Artists WHERE ArtistID = ". $id;
    $statement = queryDatabaseForSingleItem($pdo, $sql);
    $pdo = null;
    return $statement;
}

///--GALLERY
function findGalleryByID($id){
    $pdo = PDO();
    $sql = "SELECT GalleryID, GalleryName, GalleryWebSite FROM Galleries WHERE GalleryID = ". $id;
    $statement = queryDatabaseForSingleItem($pdo, $sql);
    $pdo = null;
    return $statement;
}

///--GENRE
function findGenreByID($id){
    $pdo = PDO();
    $sql = "SELECT GenreID, GenreName, EraID, Description, Link FROM Genres WHERE GenreID = ". $id;
    $statement = queryDatabaseForSingleItem($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllGenres(){
    $pdo = PDO();
    $sql = "SELECT GenreID, GenreName, EraID, Description, Link  FROM Genres";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllGenresOrderedBy($orderBy){
    $pdo = PDO();
    $sql = "SELECT GenreID, GenreName, EraID, Description, Link FROM Genres ORDER BY $orderBy";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
///--TYPE
function findAllOfType($type){
    $pdo = PDO();
    //move this to a gateway for next assignment to remove *
    $sql = "SELECT * FROM types".$type;
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}

///--REVIEWS
function findReviewsByPaintingID($id){
    $pdo = PDO();
    $sql = "SELECT RatingID, ReviewDate, Rating, Comment FROM Reviews WHERE PaintingID = ". $id;
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}

///--GENERIC
///---To be replaced by runQuery in data access layer for next assignment
function findAllFromTable($table){
    $pdo = PDO();
    $sql = "SELECT * FROM $table";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllFromTableWhere($table, $field, $id){
    $pdo = PDO();
    $sql = "SELECT * FROM $table WHERE $field = $id";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllFromTableWhereOrderBy($table, $field, $id, $orderBy){
    $pdo = PDO();
    $sql = "SELECT * FROM $table WHERE $field = $id ORDER BY $orderBy";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findAllFromTableOrderBy($table, $orderBy){
    $pdo = PDO();
    $sql = "SELECT * FROM $table ORDER BY $orderBy";
    $statement = queryDatabaseForDataSet($pdo, $sql);
    $pdo = null;
    return $statement;
}
function findSingleFromTableByID($table, $tableIDString, $idToFind){
    $pdo = PDO();
    $sql = "SELECT * FROM $table WHERE $tableIDString = $idToFind";
    $statement = queryDatabaseForSingleItem($pdo, $sql);
    $pdo = null;
    return $statement;
}





















?>