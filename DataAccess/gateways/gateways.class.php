<?php
include("TableGateway.class.php");
class ArtistTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Artist";
    }
    public function getSelectStatement(){
        return "SELECT ArtistID, ArtistLink, Details, FirstName, LastName, Gender, Nationality, YearOfBirth, YearOfDeath FROM artists";
    }
    public function getArtistWorks(){
    	
    }
    public function getPrimaryKeyName(){
        return "ArtistID";
    }

}
class CustomerLogonTableGateway extends TableDataGateway{
    public function getClassName(){
        return "CustomerLogon";
    }
    public function getSelectStatement(){
        return "SELECT CustomerID, DateJoined, DateLastModified, Pass, Salt, State, UserName FROM customerLogon";
    }
    public function getPrimaryKeyName(){
        return "CustomerID";
    }
}
class CustomersTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Customer";
    }
    public function getSelectStatement(){
        return "SELECT CustomerID, Address, City, Country, Email, FirstName, LastName, Phone, Postal, Privacy, Region  FROM customers";
    }
    public function getPrimaryKeyName(){
        return "CustomerID";
    }
}
class ErasTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Era";
    }
    public function getSelectStatement(){
        return "SELECT EraID, EraName, EraYears FROM eras";
    }
    public function getPrimaryKeyName(){
        return "EraID";
    }
}
class GalleriesTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Gallery";
    }
    public function getSelectStatement(){
        return "SELECT GalleryID, GalleryName, GalleryCity, GalleryCountry, GalleryNativeName, GalleryWebSite, Latitude, Longitude FROM galleries";
    }
    public function getPrimaryKeyName(){
        return "GalleryID";
    }
    public function getSelectStatementForBrowseAll(){
    	return "SELECT GalleryID, GalleryName, GalleryCity, GalleryCountry FROM galleries";
    }
    public function getPaintings($id){
    	return "SELECT PaintingID, ImageFileName, Title FROM paintings WHERE GalleryID = ".$id." ORDER BY Title";
    }
}
class GenresTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Genre";
    }
    public function getSelectStatement(){
        return "SELECT GenreID, GenreName, EraID, Link, Description FROM genres";
    }
    public function getPrimaryKeyName(){
        return "GenreID";
    }
    public function getPaintings($id){ 
    	return "SELECT ImageFileName, Title, Paintings.PaintingID FROM Paintings INNER JOIN PaintingGenres ON Paintings.PaintingID = PaintingGenres.PaintingID INNER JOIN Genres ON Genres.GenreID = PaintingGenres.GenreID WHERE Genres.GenreID = $id ORDER BY YearOfWork";
    }
}
class OrderDetailsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "OrderDetail";
    }
    public function getSelectStatement(){
        return "SELECT OrderDetailID, OrderID, PaintingID, FramID, GlassID, MattID FROM orderDetails";
    }
    public function getPrimaryKeyName(){
        return "OrderDetailID";
    }
}
class OrdersTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Order";
    }
    public function getSelectStatement(){
        return "SELECT CustomerID, DateStarted, OrderID, Quantity, ShipperID FROM orders";
    }
    public function getPrimaryKeyName(){
        return "OrderID";
    }
}
class PaintingGenreTableGateway extends TableDataGateway{
     public function getClassName(){
        return "PaintingGenre";
    }
    public function getSelectStatement(){
        return "SELECT GenreID, PaintingGenreID, PaintingID FROM paintingGenres";
    }
    public function getPrimaryKeyName(){
        return "PaintingGenreID";
    }
}
class PaintingsTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Painting";
    }
    public function getSelectStatement(){
        return "SELECT AccessionNumber, ArtistID, CopyrightText, Cost, Description, Excerpt, GalleryID, GoogleDescription, GoogleLink, Height, ImageFileName, Medium, MSRP, MuseumLink, PaintingID, ShapeID, Title, Width, WikiLink, YearOfWork FROM paintings";
    }
    public function getPrimaryKeyName(){
        return "PaintingID";
    }
    public function getGenre($id){
    	$sql = "SELECT Genres.GenreID, GenreName FROM Genres JOIN PaintingGenres ON Genres.GenreID = PaintingGenres.GenreID JOIN Paintings ON Paintings.PaintingID = PaintingGenres.PaintingID WHERE Paintings.PaintingID = ". $id;
    }
    public function getShape($id){
    	return "SELECT shapes.ShapeID, ShapeName FROM shapes JOIN paintings ON shape.ShapeID = Paintings.ShapeID WHERE shape.ShapeID = ". $id;
    	 
    }

}
class PaintingSubjectsTableGateway extends TableDataGateway{
    private $class = "";
    public function getClassName(){
        return "PaintingSubject";
    }
    public function getSelectStatement(){
        return "SELECT PaintingID, PaintingSubjectID, SubjectID FROM paintingSubjects";
    }
    public function getPrimaryKeyName(){
        return "PaintingSubjectID";
    }
}
class ReviewsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Review";
    }
    public function getSelectStatement(){
        return "SELECT Comment, PaintingID, Rating, RatingID, ReviewDate FROM reviews";
    }
    public function getPrimaryKeyName(){
        return "RatingID";
    }
}
class ShapesTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Shape";
    }
    public function getSelectStatement(){
        return "SELECT ShapeID, ShapeName FROM shapes";
    }
    public function getPrimaryKeyName(){
        return "ShapeID";
    }
}
class SubjectsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Subject";
    }
    public function getSelectStatement(){
        return "SELECT SubjectID, SubjectName FROM subjects";
    }
    public function getPrimaryKeyName(){
        return "SubjectID";
    }
    
    public function getPaintingsSelectStatement($id){
    	return "SELECT ImageFileName, Title, Paintings.PaintingID FROM Paintings INNER JOIN PaintingSubjects ON Paintings.PaintingID = PaintingSubjects.PaintingID INNER JOIN Subjects ON Subjects.SubjectID = PaintingSubjects.SubjectID WHERE Subjects.SubjectID = $id ORDER BY Title";
    	 
    }
}
class TypesFramesTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Frame";
    }
    public function getSelectStatement(){
        return "SELECT Color, FrameID, Price, Syle, Title FROM typesFrames";
    }
    public function getPrimaryKeyName(){
        return "FrameID";
    }
}
class TypesGlassTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Glass";
    }
    public function getSelectStatement(){
        return "SELECT Description, GlassID, Price, Title FROM typesGlass";
    }
    public function getPrimaryKeyName(){
        return "GlassID";
    }
}
class TypesMattTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Matt";
    }
    public function getSelectStatement(){
        return "SELECT ColorCode, MattID, Title FROM typesMatt";
    }
    public function getPrimaryKeyName(){
        return "MattID";
    }
}
class TypesShippersTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Shipper";
    }
    public function getSelectStatement(){
        return "SELECT shipperAvgTime, shipperBaseFee, shipperClass, shipperDescription, shipperID, shipperName, shipperWeightFee FROM typeShippers";
    }
    public function getPrimaryKeyName(){
        return "shipperID";
    }
}
class TypesStatusCodesTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Status";
    }
    public function getSelectStatement(){
        return "SELECT StatusID, status FROM typesStatusCodes";
    }
    public function getPrimaryKeyName(){
        return "StatusID";
    }
}
class VisitsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Visit";
    }
    public function getSelectStatement(){
        return "SELECT * FROM visits";
    }
    public function getPrimaryKeyName(){
        return "VisitID";
    }
}










?>