<?php 
include("Controllers/PaintingController.class.php");
include("Controllers/DropdownController.class.php");

$paintingController = new PaintingsController;
$dropdown = new DropdownController();

?>
<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8 />
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>

    <link href="css/semantic.css" rel="stylesheet" />
    <link href="css/icon.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />



</head>

<body>

    <header>
        <?php include('includes/header.inc.php'); ?>
    </header>


    <main>
        <h2 class="ui horizontal divider">
            <i class="tag icon"></i>Browse Paintings
        </h2>
        <br />
        <div class="ui fluid stackable grid">
            <div class="one wide column"></div>
                <div class="three wide column">
                    <div class="ui secondary vertical menu">
                        <div class="ui segment" id="painting-filters">
                        <form class="ui large form" action="browse-paintings.php" method="get">
                            <h3 class="ui grey dividing header">
                                Filters
                            </h3>
                            <div class="field">
                                <label class="ui grey header">
                                    Artist
                                </label>
                                <?php 
                                echo $dropdown->artistDropdown() 
                                ?>
                            </div>
                            <div class="field">
                                <label class="ui grey header">
                                    Museum
                                </label>
                                <?php 
                                echo $dropdown->museumDropdown(); 
                                ?>
                            </div>
                            <div class="field">
                                <label class="ui grey header">
                                    Shape
                                </label>
                                <?php 
                                echo $dropdown->shapeDropdown(); 
                                ?>


                            </div>
                            <button class="ui orange fluid bottom submit button" type="submit">
                                <i class="filter icon"></i>Filter
                            </button>

                        </form>

                    </div>
                </div>
            </div>
                
                <div class="ten wide column">
                    <div class="row">
                        <h2 class="ui header">
                            Paintings
                            <div class="sub header">
                                <?php 
                                echo $paintingController->createCurrentFilterString(); ?>
                            </div>
                        </h2>
                    </div>
                    <div class="ui divider"></div>
                    <?php 
                    $paintingController->setBrowsePaintingData();
                    echo $paintingController->createBrowsePaintingItems(); ?>
                </div>
        <div class="two wide column"></div>

        </div>

    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>