//slideshow code
$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    items: 1,              
    loop: true,            
    autoplay: true,         
    autoplayTimeout: 1000,  
    autoplayHoverPause: true, 
    nav: true,             
    dots: true,            
    autoplaySpeed: 1000,    
  });
});

