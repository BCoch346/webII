<?php
include("TableGateway.class.php");
class ArtistTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Artist";
    }
    public function getSelectStatement(){
        return "SELECT ArtistID, ArtistLink, Details, FirstName, LastName, Gender, Nationality, YearOfBirth, YearOfDeath FROM Artists";
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
        return "SELECT CustomerID, DateJoined, DateLastModified, Pass, Salt, State, UserName FROM CustomerLogon";
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
        return "SELECT CustomerID, Address, City, Country, Email, FirstName, LastName, Phone, Postal, Privacy, Region  FROM Customers";
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
        return "SELECT EraID, EraName, EraYears FROM Eras";
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
        return "SELECT GalleryID, GalleryName, GalleryCity, GalleryCountry, GalleryNativeName, GalleryWebSite, Latitude, Longitude FROM Galleries";
    }
    public function getPrimaryKeyName(){
        return "GalleryID";
    }
    public function getSelectStatementForBrowseAll(){
    	return "SELECT GalleryID, GalleryName, GalleryCity, GalleryCountry FROM Galleries";
    }
}
class GenresTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Genre";
    }
    public function getSelectStatement(){
        return "SELECT GenreID, GenreName, EraID, Link, Description FROM Genres";
    }
    public function getPrimaryKeyName(){
        return "GenreID";
    }
}
class OrderDetailsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "OrderDetail";
    }
    public function getSelectStatement(){
        return "SELECT OrderDetailID, OrderID, PaintingID, FramID, GlassID, MattID FROM OrderDetails";
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
        return "SELECT CustomerID, DateStarted, OrderID, Quantity, ShipperID FROM Orders";
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
        return "SELECT GenreID, PaintingGenreID, PaintingID FROM PaintingGenres";
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
        return "SELECT AccessionNumber, ArtistID, CopyrightText, Cost, Description, Excerpt, GalleryID, GoogleDescription, GoogleLink, Height, ImageFileName, Medium, MSRP, MuseumLink, PaintingID, ShapeID, Title, Width, WikiLink, YearOfWork FROM Paintings";
    }
    public function getPrimaryKeyName(){
        return "PaintingID";
    }

}
class PaintingSubjectsTableGateway extends TableDataGateway{
    private $class = "";
    public function getClassName(){
        return "PaintingSubject";
    }
    public function getSelectStatement(){
        return "SELECT PaintingID, PaintingSubjectID, SubjectID FROM PaintingSubjects";
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
        return "SELECT Comment, PaintingID, Rating, RatingID, ReviewDate FROM Reviews";
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
        return "SELECT ShapeID, ShapeName FROM Shapes";
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
        return "SELECT SubjectID, SubjectName FROM Subjects";
    }
    public function getPrimaryKeyName(){
        return "SubjectID";
    }
}
class TypesFramesTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Frame";
    }
    public function getSelectStatement(){
        return "SELECT Color, FrameID, Price, Syle, Title FROM TypesFrames";
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
        return "SELECT Description, GlassID, Price, Title FROM TypesGlass";
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
        return "SELECT ColorCode, MattID, Title FROM TypesMatt";
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
        return "SELECT shipperAvgTime, shipperBaseFee, shipperClass, shipperDescription, shipperID, shipperName, shipperWeightFee FROM TypeShippers";
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
        return "SELECT StatusID, status FROM TypesStatusCodes";
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
        return "SELECT * FROM Visits";
    }
    public function getPrimaryKeyName(){
        return "VisitID";
    }
}










?>