jQuery(document).ready(function(){
    var no_of_slides = jQuery('#no_of_slides').val();
    var add_dots = jQuery('#add_dots').val();
    var auto_scroll = jQuery('#auto_scroll').val();
    var play_speed = jQuery('#play_speed').val();
    if(no_of_slides<1){
        no_slides = 1;
    }
    else{
        no_slides = no_of_slides;
    }
    if(add_dots=='yes'){
        show_dots = true;
    }
    else{
        show_dots = false;
    }
    if(auto_scroll=='yes'){
        scroll_it = true;
    }  
    else{
        scroll_it = false;
    }
    if(play_speed>=100){
        autoplay_speed = play_speed;
    }  
    else{
        autoplay_speed = 1000;
    }

    jQuery('.slider-class').slick({
        dots: show_dots,
        infinite: true,
        speed: 300,
        slidesToShow: no_slides,
        slidesToScroll: 1,
        autoplay: scroll_it,
        autoplaySpeed: autoplay_speed,
    });
});




jQuery(document).ready(function(){
    jQuery('button').on('click',function(e) {
        if (jQuery(this).hasClass('grid')) {
            jQuery('#container .content_main_class').removeClass('list').addClass('grid');
        }
        else if(jQuery(this).hasClass('list')) {
            jQuery('#container .content_main_class').removeClass('grid').addClass('list');
        }
    });
    
    
});