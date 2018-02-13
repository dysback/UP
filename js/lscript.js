var _step = 1;
var formQ = "";

$(document).ready(function() {

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

  $('form').submit(function(e) {

    e.preventDefault();
    //swal("Congratulations", "You successfully created Paycheck", "success");

    return false;

  });

  $("#cardNumber").keyup(function() {
    a = $(this).val();

    $(this).val(validateInput(a, "xxxx-xxxx-xxxx-xxxx", 16, 16));
  });

  $("#date").keyup(function() {
    $(this).val(validateInput($(this).val(), "xx/xx", 4, 4));
  });

  //$("#date").keyup(onInput);
  //$("#date").blur(onBlur);

  $("body").on("click", ".confirm", function() {
    if (error.errorCode == '1') {
      window.location = '/getPdf.php?filename=' + error.PDFurl;
    }
  });

});

function onStep(s) {
  //console.log(s, _step);
  if (s == 2 && _step == 1) {
    $("#step-2").load("template" + a[0].slick.currentSlide + ".php", function() {
      var $input = $("#pay_date").pickadate({
        format: 'mm/dd/yyyy',
      });
      picker = $input.pickadate('picker');
      pay_date = picker.get('select').obj;

      picker = $input.pickadate('picker');

      //$("#ssn").val("1");
      $("#ssn").formatter({
        'pattern': '{{999}}-{{99}}-{{9999}}',
        'persistent': false,
      });

      $("#pay_date").on('change', function() {
        calcCurrent_pay();
        $("#dep_paydate").html(pay_date.format("m/d/Y"));
      });

      $("#stub_number").on('input', function() {
        console.log($("#stub_number").val());
        $("#dep_stub_number").html($("#stub_number").val());
      });
      $("#pay_date").change(function() {
        pay_date = picker.get('select').obj;

        if (frequency == 1) {
          pay_date2 = new Date(pay_date - 2 * 86400000);
          pay_date9 = new Date(pay_date - 8 * 86400000);
        } else if (frequency == 2) {
          pay_date2 = new Date(pay_date - 3 * 86400000);
          pay_date9 = new Date(pay_date - 16 * 86400000);

        } else if (frequency == 3) {
          pay_date2 = new Date(pay_date - 3 * 86400000);
          var md = daysInMonthDate(pay_date2);
          md = Math.round(md / 2) + 2;
          pay_date9 = new Date(pay_date - md * 86400000);

        } else if (frequency == 4) {
          pay_date2 = new Date(pay_date - 3 * 86400000);
          var md = daysInMonthDate(pay_date2);
          md = md + 2;
          pay_date9 = new Date(pay_date - md * 86400000);

        } else if (frequency == 5) {
          pay_date2 = new Date(pay_date - 3 * 86400000);
          md = 365;
          pay_date9 = new Date(pay_date - md * 86400000);
        }
        //console.log(frequency, pay_date, pay_date2, pay_date9);
        $("#reporting_period").val(pay_date9.format("m/d/Y") + " - " + pay_date2.format("m/d/Y"));
      });

      $("#rate").on('input', function() {
        calcCurrent_pay();
        rate = $(this).val();

        //$("#current_pay").val($("#rate").val() * $("#hours").val());
      });

      $("#rate").on('blur', function() {
        $(this).val(($(this).val() * 1).toFixed(2));
      })

      $("#hours").on('input', function() {
        calcCurrent_pay();
      });

      $("#nos").on("change", function() {
        calcCurrent_pay();
      });

      $("#employee_name").on('input', function() {
        console.log($("#employee_name").val());
        $(".depo_en").html($("#employee_name").val());
      });

      $("#employee_address").on('input', function() {
        $(".depo_esa").html($("#employee_address").val());
      });

      $("#period").on("change", function() {
        calcCurrent_pay();
      })
      $("#auto").on("change", function() {
        auto = !auto;

        $("#current_pay").toggleClass("noedit").prop("readonly", !$("#current_pay").prop("readonly"));
        $("#fica_mc").toggleClass("noedit").prop("readonly", !$("#fica_mc").prop("readonly"));
        $("#fica_ss").toggleClass("noedit").prop("readonly", !$("#fica_ss").prop("readonly"));
        $("#fica_tax").toggleClass("noedit").prop("readonly", !$("#fica_tax").prop("readonly"));
        $("#fica_stax").toggleClass("noedit").prop("readonly", !$("#fica_stax").prop("readonly"));
        $("#fica_sditax").toggleClass("noedit").prop("readonly", !$("#fica_sditax").prop("readonly"));
        $("#ficay_mc").toggleClass("noedit").prop("readonly", !$("#ficay_mc").prop("readonly"));
        $("#ficay_ss").toggleClass("noedit").prop("readonly", !$("#ficay_ss").prop("readonly"));
        $("#ficay_tax").toggleClass("noedit").prop("readonly", !$("#ficay_tax").prop("readonly"));
        $("#ficay_stax").toggleClass("noedit").prop("readonly", !$("#ficay_stax").prop("readonly"));
        $("#ficay_sditax").toggleClass("noedit").prop("readonly", !$("#ficay_sditax").prop("readonly"));

        $("#ytd_gross").toggleClass("noedit").prop("readonly", !$("#ytd_gross").prop("readonly"));
        $("#ytd_deductions").toggleClass("noedit").prop("readonly", !$("#ytd_deductions").prop("readonly"));
        $("#ytd_net_pay").toggleClass("noedit").prop("readonly", !$("#ytd_net_pay").prop("readonly"));
        $("#total").toggleClass("noedit").prop("readonly", !$("#total").prop("readonly"));
        $("#deductions").toggleClass("noedit").prop("readonly", !$("#deductions").prop("readonly"));
        $("#net_pay").toggleClass("noedit").prop("readonly", !$("#net_pay").prop("readonly"));
        calcCurrent_pay();
      });

      $("#state").on("change", function() {
        var states = new States();
        stateTax = states.stateList[$("#state").val()];
        if (stateTax.tax > 0) {
          $("#stax").attr("style", "");
        } else {
          $("#fica_stax").val("");
          $("#ficay_stax").val("");
          $("#stax").attr("style", "visibility: hidden;");
        }
        if ($("#state").val() == "ca") {
          $("#sditax").attr("style", "");
        } else {
          $("#fica_sditax").val("");
          $("#ficay_sditax").val("");
          $("#sditax").attr("style", "visibility: hidden;");
        }
        calcCurrent_pay();
      });
      calcCurrent_pay();
    });
  }
  if (s == 3) {
    formQ = $("form").serialize();
    console.log("RQ: ", $("form").serializeArray());
    $("#step-3").load("template" + a[0].slick.currentSlide + "f.php?" + formQ, function() {
      calcCurrent_pay();
      $(".depo_en").html($("#employee_name").val());
      $(".depo_esa").html($("#employee_address").val());
    });
  }
  _step = s;
}
var error;

function onFinish(e1, e2) {
  var formP = $(".stepy-basic").serialize();
  var url = "generateAndCharge.php?" + formP + "&" + formQ;
  //console.log("url", url);
  $.ajax({
    url: url,
  }).done(function(data) {
    error = data;
    if (data.errorCode == "1") {
      swal(data.errorDescription, data.message, "success");
    } else {
      swal(data.errorDescription, data.message, "error");
    }
  });
}

function daysInMonth(month, year) {
  return new Date(year, month, 0).getDate();
}

function daysInMonthDate(date) {
  month = date.getMonth() + 1;
  year = date.getFullYear();
  return daysInMonth(month, year);
}

function validateInput(input, pattern, minLenght, maxLength) {
  r = 0
  input = input.replace(/[\W\s\._\-]+/g, '');
  if (input.length < minLenght) {
    r = -2;
  }
  if (input.length > maxLength) {
    input = input.substr(0, maxLength);
    r = -3;
  }

  ret = "";
  count = 0;
  for (var i = 0; i < pattern.length; i++) {
    if (typeof input[count] === "undefined") break;
    if (pattern[i] == "-" || pattern[i] == "/") {
      ret += pattern[i];
    } else {
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
