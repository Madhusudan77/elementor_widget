jQuery(document).ready(function(){
    var no_of_slides = jQuery('#no_of_slides').val();
    var add_dots = jQuery('#add_dots').val();
    var auto_scroll = jQuery('#auto_scroll').val();
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

    jQuery('.slider-class').slick({
        dots: show_dots,
        infinite: true,
        speed: 300,
        slidesToShow: no_slides,
        slidesToScroll: 1,
        autoplay: scroll_it,
        autoplaySpeed: 2000,
    });
});