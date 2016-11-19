<?php 

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
<div class="ui attached stackable grey inverted  menu">
    <div class="ui container">
        <nav class="right menu">
            <div class="ui simple  dropdown item">
                <i class="user icon"></i> Account
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="sign in icon"></i> Login</a>
                    <a class="item"><i class="edit icon"></i> Edit Profile</a>
                    <a class="item"><i class="globe icon"></i> Choose Language</a>
                    <a class="item"><i class="settings icon"></i> Account Settings</a>
                </div>
            </div>
            <a class="item" href="view-favorites.php">
                <i class="heartbeat icon"></i> Favorites
                <div class="right ui medium teal label"><?php echo countFavorites(); ?>
                </div>   
            </a>
            <a href="view-cart.php" class="item">
                <i class="shop icon"></i> Cart
                <div class="right ui medium teal label"><?php echo countCart(); ?></div>             
            </a>
        </nav>
    </div>
</div>

<div class="ui attached stackable borderless huge menu">
    <div class="ui container">
        <h2 class="header item">
            <img src="images/logo5.png" class="ui small image">
        </h2>
        <a class="item" href="index.php">
            <i class="home icon"></i> Home
        </a>
        <a class="item" href="aboutus.php">
            <i class="mail icon"></i> About Us
        </a>
        <a class="item" href="#">
            <i class="home icon"></i> Blog
        </a>
        <div class="ui simple dropdown item">
            <i class="grid layout icon"></i> Browse
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="browse-artists.php"><i class="users icon"></i> Artists</a>
                <a class="item" href="browse-genres.php"><i class="theme icon"></i> Genres</a>
                <a class="item" href="browse-paintings.php"><i class="paint brush icon"></i> Paintings</a>
                <a class="item" href="browse-museums.php"><i class="home icon"></i> Museums</a>
                <a class="item" href="browse-subjects.php"><i class="cube icon"></i> Subjects</a>
            </div>
        </div>
        <div class="right item">
            <div class="ui mini icon input">
                <input type="text" placeholder="Search ...">
                <i class="search icon"></i>
            </div>
        </div>

    </div>
</div>