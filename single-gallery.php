<?php session_start();?>
<?php include("includes/functions.inc.php"); ?>

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

<style>
       #map {
    height: 350px;
    width: 100%;
       }

    </style>

</head>

<body>

    <header>
        <?php include('includes/header.inc.php'); ?>
    </header>

    <main>
        <br />
        <div class="ui wide container">
                    <div class="ui stackable grid">
            	<div class="ui four wide column">
            		<h2 class="ui header">Gallery Name</h2>
            		<p>city, country</p>
            		<div class='ui divider'></div>
					<div class="animated fluid ui button">
                    <a href="#">
                        <div class="visible content">Visit website</div>
                        <div class="hidden content">
                            <i class='right arrow icon'></i>
                        </div>
                    </a>                    
                	</div>
                	<div class='ui hidden divider'></div>
                	
            		<?php echo createMuseumMap(); ?>
            	</div>
            	<div class="ui twelve wide column"><iframe src="http://www.belvedere.at/" height="500" width="100%"></iframe>
</div>
            
            </div>
        
            <div class="ui horizontal divider">
                <h2 class="ui">Paintings</h2>
            </div>

            <div class="ui six column stackable grid">
                <?php echo createSingleGalleryPictureGrid(); ?>
            </div>
            

            
            
        </div>


    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>