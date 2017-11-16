/*
$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
*/



$(document).ready(function(){
  a = $('.slider-nav').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    
    //nextArrow: '<i class="fa fa-arrow-right slicker-next"></i>',
    //prevArrow: '<i class="fa fa-arrow-left"></i>',
    //asNavFor: '.slider-for',
    dots: true,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
  });
  //console.log(JSON.stringify(a));  
  $('#smartwizard').smartWizard({
    theme: 'dots',
  
  });

  $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
    console.log("Do you want to leave the step "+stepNumber+"?");
    if(stepNumber==0)
    {
      $("#step-2").load("template" + a[0].slick.currentSlide + ".html");
    }
    if(stepNumber==1)
    {
      formQ = $("form").serialize();
      $("#step-3").load("template" + a[0].slick.currentSlide + "f.php?" + formQ);
    }
    if(stepNumber==2)
    {
      window.location="Paycheck.php?action=download&" + formQ;
    }

    
    //return confirm("Do you want to leave the step "+stepNumber+"?");
  });

  $("#next-btn, #select-temp").on("click", function() {
    // Navigate next
    $('#smartwizard').smartWizard("next");
    return true;
  });
});