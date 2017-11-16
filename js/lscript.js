var _step = 1;

$(document).ready(function(){

    $.fn.stepy.defaults.legend = false;
    $.fn.stepy.defaults.transition = 'fade';
    $.fn.stepy.defaults.duration = 150;

    //$('form').submit(false);

    $(".stepy-basic").stepy({
        finishButton: true,
        select: onStep,
        finish: onFinish,
        description: true,
    });
    $('.stepy-step').find('.button-next').addClass('btn btn-primary');
    $('.stepy-step').find('.button-back').addClass('btn btn-default');



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


    //$("form").ajaxSubmit({url: 'server.php', type: 'post'})

    $('form').submit(function(e){

        e.preventDefault();
        //swal("Congratulations", "You successfully created Paycheck", "success");

        return false;
x
    });

    $("#cardNumber").keyup(function() {
        a = $(this).val();

        $(this).val(validateInput(a, "xxxx-xxxx-xxxx-xxxx", 16, 16));
    });

    $("#date").keyup(function() {
        $(this).val(validateInput($(this).val(), "xx/xx", 4,4));
    });

    //$("#date").keyup(onInput);
    //$("#date").blur(onBlur);

    $("body").on("click", ".confirm", function() {
      if(error.errorCode == '1')
        {
          window.location='/getPdf.php?filename=' + error.PDFurl;
        }
    });
});

function onStep(s) {
    console.log(s, _step);
    if(s==2 && _step==1)
    {
      $("#step-2").load("template" + a[0].slick.currentSlide + ".php");
    }
    if(s==3)
    {
      formQ = $("form").serialize();
      $("#step-3").load("template" + a[0].slick.currentSlide + "f.php?" + formQ);
    }

    _step = s;
}
var error;
function onFinish(e1, e2) {
  var formP = $(".stepy-basic").serialize();
  var url = "generateAndCharge.php?" + formP;
  //console.log("url", url);
  $.ajax({
    url: url,
  }).done(function( data ) {
    error = data;
    if(data.errorCode == "1") {
      swal(data.errorDescription, data.message, "success");
    } else {
      swal(data.errorDescription, data.message, "error");
    }
  });
}








function validateInput(input, pattern, minLenght, maxLength) {
    r = 0
    input = input.replace(/[\W\s\._\-]+/g, '');
    if (input.length < minLenght) {
        r = -2;
    }
    if(input.length > maxLength) {
        input = input.substr(0, maxLength);
        r = -3;
    }


    ret = "";
    count = 0;
    for(var i = 0; i < pattern.length; i++) {
        if(typeof input[count] === "undefined") break;
        if(pattern[i] == "-" || pattern[i] == "/")
        {
            ret += pattern[i];
        } else
        {
            ret += input[count++];
        }
    }
    input = ret;


    return input;
}




function checkValue(str, max) {
    if (str.charAt(0) !== '0' || str == '00') {
      var num = parseInt(str);
      if (isNaN(num) || num <= 0 || num > max) num = 1;
      str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
    };
    return str;
  };

  function onInput(e) {
    //this.type = 'text';
    console.log("oi", e);
    var input = $(this).val();
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    var values = input.split('/').map(function(v) {
      return v.replace(/\D/g, '')
    });
    if (values[0]) values[0] = checkValue(values[0], 12);
    if (values[1]) values[1] = checkValue(values[1], 31);
    var output = values.map(function(v, i) {
      return v.length == 2 && i < 2 ? v + ' / ' : v;
    });
    $(this).val(output.join('').substr(0, 14));
  };

  function onBlur(e) {
    //this.type = 'text';
    console.log("ob", e);
    var input = $(this).val();
    var values = input.split('/').map(function(v, i) {
      return v.replace(/\D/g, '')
    });
    var output = '';

    if (values.length == 3) {
      var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
      var month = parseInt(values[0]) - 1;
      var day = parseInt(values[1]);
      var d = new Date(year, month, day);
      if (!isNaN(d)) {
        result = d.toString();
        var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
        output = dates.map(function(v) {
          v = v.toString();
          return v.length == 1 ? '0' + v : v;
        }).join(' / ');
      };
    };
    $(this).val() = output;
  };
