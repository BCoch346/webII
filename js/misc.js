$(function () {

    // initialize semanticUI components

    $('.ui.menu .ui.dropdown').dropdown({
        on: 'hover'
    });

    $('.ui.menu a.item')
        .on('click', function () {
            $(this).addClass('active')
                   .siblings()
                   .removeClass('active');
        });

    $('.menu .item').tab();

    $('.event.example .image').dimmer({
        on: 'hover'
    });


    $('#artwork').on('click', function () {
        $('.ui.fullscreen.modal').modal('show');
    });

    $('.ui.sticky').sticky({
        context: '#artist-filters'
    });

});
/*function addToTheCart(){
$('#addToCart').on('click', function(e){
    var paintingid = $(this).attr('value');
    $.ajax({
        type: 'POST',
        url: 'single-painting.php',
        data: { pid: paintingid, clicked: 'TRUE' }
    }); 
});}*/

document.getElementById('addFavA').addEventListener('click', function(e){
	var id = event.target.getAttribute("value");
    jQuery.ajax({
		    type: "POST",
		    url: 'view-favorites.php',
		    dataType: 'json',
		    data: {functionname: 'addFavoriteArtist', '$id': [id]},
        success: function (results) {
            if(results){
                alert('success');
            }
            else {
                alrt('error');
            }
        }
		});
	});

document.getElementById('addFavP').addEventListener('click', function(e){
	var id = event.target.getAttribute("value");
    jQuery.ajax({
		    type: "POST",
		    url: 'view-favorites.php',
		    dataType: 'json',
		    data: {functionname: 'addFavoritePaintings', '$id': [id]},
        success: function (results) {
            if(results){
                alert('success');
            }
            else {
                alrt('error');
            }
        }
		});
	});
