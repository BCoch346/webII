var createPaintingPopup = function(e){
	var src = 'images/art/works/average/' + $(e).attr('id') + '.jpg';
	var div = $('<div></div>').attr('class', 'ui flowing popup top transition hidden');
	var image =  $('<img>').attr('class', 'ui image').attr('src', src).appendTo(div);

	return div;
}

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
    
    //start assignment 3 javascript
    $('.painting-thumbnail').each(function(index, value){
    	$(this).parent().popup({
    	      popup : createPaintingPopup($(this)).insertAfter($(this)),
    	      position   : 'top left',
    	      delay: {
    	        show: 150,
    	        hide: 150
    	      }
    	    })
    	  ;
    });
    
    $(".painting-thumbnail").each(function(index, value){
    	$($(".painting-thumbnail").get(index)).on('mouseenter', function(){
    		createPaintingPopup($(this));
        });
    	$($(".painting-thumbnail").get(index)).on('mouseleave', function(){
        	$('.painting-popup').remove();
        });
    });
    
    

});
