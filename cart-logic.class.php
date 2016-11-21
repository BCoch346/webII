<?php
include("Controllers/instance.class.php");

class cartLogic extends instance{
	private $gateway;
	public function __construct(){
		parent::__construct();
		$this->gateway = new PaintingsTableGateway($this->dbAdapter);
	}
	public function getGlassByID($id){
		return $this->dbAdapter->fetchRow("SELECT Description, GlassID, Price, Title FROM typesglass");
	}
	public function getMattByID($id){
		return $this->dbAdapter->fetchRow("SELECT ColorCode, MattID, Title FROM typesmatt");
	}
	public function getFrameByID($id){
		return $this->dbAdapter->fetchRow("SELECT Color, FrameID, Price, Syle, Title FROM typesframes");
	}
	// ADD CURRENT SELECTIONS TO THE CART DISPLAY
	public function instantiateCartLogic() {
		if (! empty ( $_SESSION ['Painting'] )) {
			$painting = $_SESSION ['Painting'];
			for($paintIndex = 0; $paintIndex < count ( $painting ); $paintIndex ++) {
				// echo'<script>console.log($painting[$paintIndex]["id"])</script>';
				$singlePainting = $this->gateway->findById( $painting [$paintIndex] ['id'] );
				if (isset ( $_POST [$singlePainting ['PaintingID'] . 'Quantity'] ) && ! empty ( $_POST [$singlePainting ['PaintingID'] . 'Quantity'] )) {
					$_SESSION ['Painting'] [$paintIndex] ['quantity'] = $_POST [$singlePainting ['PaintingID'] . 'Quantity'];
				}
				
				if (isset ( $_POST [$singlePainting ['PaintingID'] . 'changeFrame'] ) && $_POST [$singlePainting ['PaintingID'] . 'changeFrame'] == "yes" && isset ( $_POST ['frameid'] ) && $_POST ['frameid'] != $painting [$paintIndex] ['frame']) {
					if ($_POST ['frameid'] == 'None') {
						$_SESSION ['Painting'] [$paintIndex] ['frame'] = 18;
					} else {
						$_SESSION ['Painting'] [$paintIndex] ['frame'] = $_POST ['frameid'];
					}
				}
				
				if (isset ( $_POST [$singlePainting ['PaintingID'] . 'changeGlass'] ) && $_POST [$singlePainting ['PaintingID'] . 'changeGlass'] == "yes" && isset ( $_POST ['glassid'] ) && $_POST ['glassid'] != $painting [$paintIndex] ['glass']) {
					if ($_POST ['glassid'] == 'None') {
						$_SESSION ['Painting'] [$paintIndex] ['glass'] = 5;
					} else {
						$_SESSION ['Painting'] [$paintIndex] ['glass'] = $_POST ['glassid'];
					}
				}
				
				if (isset ( $_POST [$singlePainting ['PaintingID'] . 'changeMatt'] ) && $_POST [$singlePainting ['PaintingID'] . 'changeMatt'] == "yes" && isset ( $_POST ['mattid'] ) && $_POST ['mattid'] != $painting [$paintIndex] ['matt']) {
					if ($_POST ['mattid'] == 'None') {
						$_SESSION ['Painting'] [$paintIndex] ['matt'] = 35;
					} else {
						$_SESSION ['Painting'] [$paintIndex] ['matt'] = $_POST ['mattid'];
					}
				}
				
				if (isset ( $_POST [$singlePainting ['PaintingID'] . 'remove'] ) && $_POST [$singlePainting ['PaintingID'] . 'remove'] == "Remove") {
					for($i = 0; $i < count ( $painting ); $i ++) {
						if ($singlePainting ['PaintingID'] == $_SESSION ['Painting'] [$i] ['id']) {
							break;
						}
					}
					unset ( $_SESSION ['Painting'] [$i] );
					$_SESSION ['Painting'] = array_values ( $_SESSION ['Painting'] );
				}
				
				if (isset ( $_POST ['cartOptions'] ) && $_POST ['cartOptions'] == "Empty Cart") {
					unset ( $_SESSION ['Painting'] );
				}
				
				if (isset ( $_POST ['cartOptions'] ) && $_POST ['cartOptions'] == "Update") {
				}
			}
		}
		if (! isset ( $_SESSION ['totalValues'] )) {
			
			$_SESSION ['totalValues'] = array (
					"standard" => '',
					"express" => '',
					"totalSubtotal" => '' 
			);
		};
		
		if (! isset ( $_SESSION ['valueHolder'] )) {
			
			$_SESSION ['valueHolder'] = array (
					"standard" => '',
					"express" => '',
					"totalSubtotal" => '' 
			);
		};
		
		if (! isset ( $_SESSION ['stopVariable'] )) {
			$_SESSION ['stopVariable'] = 0;
		}
	}
}
?>