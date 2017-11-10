$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  
  //nextArrow: '<i class="fa fa-arrow-right slicker-next"></i>',
  //prevArrow: '<i class="fa fa-arrow-left"></i>',
  asNavFor: '.slider-for',
  dots: true,
  arrows: true,
  centerMode: true,
  focusOnSelect: true
});



$(document).ready(function(){
  $('#smartwizard').smartWizard({
    theme: 'dots',
  });

  $("#test").click(function() {
    console.log("123456");
    $('#smartwizard-t-1').click();
  })
  
});