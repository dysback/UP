function calcCurrent_pay() {

  if(typeof auto === 'undefined' || !auto) {
    return;
  }
  var hours = $("#hours").val();
  var cp = ($("#rate").val() * hours).toFixed(2);
  $("#current_pay").val(cp);
  var tax = new FederalTax();
  var freq = tax.frequency[$("#frequency").val()].periods;
  var periods = $("#period").val();

  pay_date = picker.get('select').obj;
  pay_date2 = getEndDate(pay_date, frequency);
  pay_date9 = getStartDate(pay_date, frequency);
  $("#reporting_period").val(pay_date9.format("m/d/Y") + " - " + pay_date2.format("m/d/Y"));

  if(mode == "E")
  {
    $("#fica_mc").val((cp * .0145).toFixed(2));
    $("#fica_ss").val((cp * .062).toFixed(2));
    $("#fica_tax").val((tax.getTax(cp * freq) / freq).toFixed(2));
    $("#ficay_mc").val(($("#fica_mc").val() * periods).toFixed(2));
    $("#ficay_ss").val(($("#fica_ss").val() * periods).toFixed(2));
    $("#ficay_tax").val(($("#fica_tax").val() * periods).toFixed(2));
    $("#deductions").val((1 * $("#fica_mc").val() + 1 * $("#fica_ss").val() + 1 * $("#fica_tax").val()).toFixed(2));
    var net_pay = cp - $("#deductions").val();
    $("#net_pay").val(net_pay.toFixed(2));
    $("#ytd_deductions").val((1 * $("#ficay_mc").val() + 1 * $("#ficay_ss").val() + 1 * $("#ficay_tax").val()).toFixed(2));
    $("#ytd_net_pay").val((cp * periods - $("#ytd_deductions").val()).toFixed(2));
    $(".dep_pay").html(" **" + Math.floor(net_pay) + "** AND **" + ((net_pay - Math.floor(net_pay)) *100).toFixed(0) + "** CENTS");
  }

  $("#ytd_gross").val((cp * periods).toFixed(2));
  $("#total").val(cp);

  var states = new States();
  stateTax = states.stateList[$("#state").val()];

  if(stateTax.tax > 0) {
    $("#fica_stax").val((cp * stateTax.tax).toFixed(2));
    $("#ficay_stax").val((cp * stateTax.tax * periods).toFixed(2));
  }
  if($("#state").val() == "ca") {
    var sdi = cp * stateTax.sdi;
    if(sdi * periods > stateTax.sdi_limit) {
      sdi = stateTax.sdi_limit / periods;
    }
    $("#fica_sditax").val(sdi.toFixed(2));
    $("#ficay_sditax").val((sdi * periods).toFixed(2));

  }
  $("#additional-checks").html("");
  //console.log(pay_date);
  for(var i = 1; i < $("#nos").val(); i++) {
    if(i == 1) {

      $("#additional-checks").append('<div class="add-stub">Type the Pay Date and Pay Period for each additonal stub selected.<br /><br /></div>');
    }
    var cpDate =  getStubDate(pay_date, i, frequency); //;new Date(pay_date);

    var pay_date2 = getEndDate(cpDate, frequency);
    var pay_date9 = getStartDate(cpDate, frequency);
    var period = pay_date9.format("m/d/Y") + " - " + pay_date2.format("m/d/Y");


    //console.log(pay_date, cpDate);
    var div = $('<div></div>');
    var ads = $("#additional-checks").append(div);

    div.append('Stub ' + (i + 1));
    div.append('<input type="text" id="paydate' + i + '" class="pickadate add-check" name="paydate[' + i + ']" value="' + cpDate.format("m/d/Y") + '">');
    div.append('<input type="text" class="add-check interval" name="rperiod[' + i + ']" style="width: 160px" value="' + period + '" >');
    div.append(' hours: ');
    div.append('<input type="number" class="add-check" name="hrs[' + i + ']" style="width: 50px" value="' + hours + '" >');
    div.append('<input type="checkbox" name="dslip[' + i + ']">');
    div.append(' Deposit slip (+ $4.99)');
  }
  $(".pickadate").pickadate({
    format: 'mm/dd/yyyy',
  });
  $(".pickadate").on('change', function() {

    //console.log($(this).parent().html());
//    console.log($(this).parent().find('.interval').val());
  });

}


$(function() {
  var defaults = {
    w: 995,
    extend: false,
    textarea: false,
    advanced: false,
    modal: true,
    loader: false
  };
  var fields = ['stubNumber', 'paymentDate', 'paymentPeriodDate', 'payhours', 'paythis', 'ytdtotal', 'ytddeductions', 'ytdnetpay', 'total', 'deductions', 'netpay', 'ytdficamedtax', 'ytdficasstax', 'ytdficafedtax', 'ytdsttax', 'ytdcasditax', 'ficamedtax', 'ficasstax', 'ficafedtax', 'sttax', 'casditax'];

  var divlId = 'carusel_preview';
  var itemElement = '<div class="item"></div>';

  var options;
  var total = ['ytdtotal', 'ytddeductions', 'ytdnetpay'];



  $.fn.myStubPlugin = function(params) {
    options = $.extend({}, defaults, params);
    if (options.advanced) {
      fields.push('payytd', 'overtimeytd', 'holidayytd', 'vacationytd', 'bonusytd', 'floatytd');
    }
    if ($('#medicalrate').length) {
      fields.push("medicalytd", "retireytd");
    }
    if ($('#childsuprate').length) {
      fields.push("childsupytd", "optionalytd");
    }

    $(this).click(function() {
      if (!options.modal) {
        $('#' + divlId).hide();
        $('.button-next').click();
      } else {
        var $modalW = $('#PreviewStubs');
        $modalW.modal('show');
        $modalW.find('.modal-dialog').css({
          'width': 'auto',
          'max-width': '960px',
        });
        $modalW.css('overflow-x', 'auto');
      }

      if (options.loader) {
        $('.loader-line').addClass('active');
      }

      if (options.textarea) {
        var t1 = $('#companyAddress2').val();
        var t2 = $('#employeeAddress2').val();
        var t3 = $('#notes').val();
      }
      //if (options.advanced) {
      var text_select1 = $('#maritalStatus').val();
      var text_select2 = $('#exemptions').val();
      var text_select3 = $('#state').val();
      //}

      var count = Number($('#stubsAmount').val()) + 1;
      var content = '';
      for (var i = 1; i <= count; i++) {
        content = content + itemElement;
      }

      var $divContent = $('#' + divlId).find('.carousel-inner');
      if (count == 1) {
        $divContent.parent().find('.carousel-control').hide();
      } else {
        $divContent.parent().find('.carousel-control').show();
      }
      $divContent.html(content);

      var $div = $('div#all_preset1');
      var clon = $div.clone();
      clon.find('#otherlabel').hide();
      $divContent.find('div.item:eq(0)').addClass('active').append(clon.attr('id', 'clonStub1'));

      var $stub,
        netpay;

      for (var i = 2; i <= count; i++) {
        $stub = $('#stub' + i);
        clon = $div.clone();
        clon.find('#otherlabel').remove();
        for (var f = 0; f < fields.length; f++) {
          clon.find('#' + fields[f]).val($stub.find('#' + fields[f] + i).val());
        }
        if (options.extend) {
          if ($stub.find('#extended' + i).prop('checked')) {
            netpay = ($('#netpay' + i).val()).split('.');
            clon.find('#extdollars').html(netpay[0]);
            clon.find('#extcents').html(netpay[1]);
            clon.find('#temp').removeClass('temp_easy').addClass('temp_ext');
            clon.find('#extendform').show().find('#extpaymentDate').text($stub.find('#paymentDate' + i).val());
            clon.find('#extstubNumber').text($stub.find('#stubNumber' + i).val());
          } else {
            clon.find('#temp').removeClass('temp_ext').addClass('temp_easy');
            clon.find('#extendform').hide();
          }
          if ($('#this_total').length) {
            for (var f = 0; f < total.length; f++) {
              clon.find('#this_' + total[f]).val($stub.find('#' + total[f] + i).val());
            }
          }
        }
        $divContent.find('div.item:eq(' + (i - 1) + ')').append(clon.attr('id', 'clonStub' + (i)));
      }


      if (options.textarea) {
        $divContent.find('#companyAddress2').text(t1).val(t1);
        $divContent.find('#employeeAddress2').text(t2).val(t2);
        $divContent.find('#notes').text(t3).val(t3);
      }

      var v, idd;
      $('#temp select').each(function() {
        v = $(this).val();
        idd = $(this).attr('id');
        if ($(this).hasClass('period')) {
          if (v === 0) {
            v = '';
          }
        } else if (idd === 'maritalStatus') {
          v = text_select1;
        } else if (idd === 'exemptions') {
          v = text_select2;
        } else if (idd === "state") {
          v = '';
          if (text_select3 != 0) {
            v = $(this).find('option[value="' + text_select3 + '"]').text();
          }
        }
        if (idd == 'maritalStatus' || idd == 'exemptions' || idd == 'state') {
          $divContent.find('select#' + idd).after('<p id="' + idd + '" class="no_select">' + v + '</p>').remove();
        } else {
          $divContent.find('select#' + idd).remove();
        }
      });

      $divContent.find('.popover').remove();
      $divContent.find('input[type="text"], .after-stub input[type="hidden"]').each(function() {
        if ($(this).css("display") == "none") {
          return;
        }
        var val = $(this).val();
        var id = $(this).attr('id');
        if ($(this).parent('div.require').length != 0) {
          var $this = $(this).parent('div.require');
        } else {
          var $this = $(this);
        }
        var className = '';


        if ($this.hasClass('line-up') || $this.hasClass('rate') || $this.hasClass('advhours') || $this.hasClass('payhours')) {
          className = ' class="line-up"';
        } else if ($this.hasClass('center-line-up')) {
          className = ' class="center-line-up"';
        } else if ($this.hasClass('readonly')) {
          className = ' class="readonly"';
        }
        $this.before('<p' + className + ' id="' + id + '">' + val + '</p>');
        $this.remove();
      });
      $divContent.find('textarea').each(function() {
        if ($(this).css("display") == "none") {
          return;
        }
        /*var val = $(this).val();
        var id = $(this).attr('id');*/
        /*if ($(this).parent('div.require').length != 0) {
            var $this = $(this).parent('div.require');
        } else {
            var $this = $(this);
        }*/
        $(this).attr('readonly', 'readonly')
          .css('border', '0')
          .css('background', 'none');
        //$this.before('<div id="'+id+'">'+val+'</div>');
        //$this.remove();
      });
      /*$divContent.find('.company_name_zone input').each(function () {
              var val = $(this).val();
              var id = $(this).attr('id');
              $(this).before('<p id="companyName">'+val+'</p>');
              $(this).remove();
      });
      $divContent.find('.header_of_stub input').each(function () {
          if ($(this).attr('type') !== 'hidden') {
              var fsize = parseInt($(this).css('font-size'));
              var lHeight = parseInt($(this).css('line-height'));
              var val = $(this).val();
              var id = $(this).attr('id');
              $(this).before('<span style="font-size:'+fsize+'px;line-height:'+lHeight+'px;">'+val+'</span>');
              $(this).remove();
          }
      });
      $divContent.find('.top1 input, .top2 textarea, .head_stub input, .options_box input, .info_box input, .center_rs textarea, .top_rs input, .stub_top input, .top_left_head input, .top_right_head input').each(function () {
          if ($(this).attr('type') !== 'hidden') {
              var fsize = parseInt($(this).css('font-size'));
              var lHeight = parseInt($(this).css('line-height'));
              var val = $(this).val();
              var id = $(this).attr('id');
              var alignText = '';
              if (id == 'paymentDate' || id == 'ssn' || id == 'employeeId') {
                  $(this).parent().css({'width':'auto', 'margin': '0'});
              }
              $(this).before('<span style="'+alignText+' font-size:'+fsize+'px;line-height:'+lHeight+'px;margin:1px 0 ;display: inline-block;">'+val+'</span>');
              $(this).remove();
          }
      });*/
      $divContent.find('#payrate, #payhours, #paythis').each(function() {
        if (!options.advanced) {
          $(this).css('text-align', 'center');
        } else {
          $(this).css('margin', '0');
        }
      });
      /*$divContent.find('.grey_box input').each(function () {
          var fsize = parseInt($(this).css('font-size'));
          $(this).css({'border':'0', 'background':'none', 'font-size': fsize+'px'});
          $(this).parent().css('margin-right','5px');
      });
      $divContent.find('.stub_body input, .stub_center input, .dumb input, .dumb2 input, .center_ls input, .botton_ls input, .center_of_stub input').each(function (){
          $(this).attr('readonly', 'readonly').css({'border': '0'}).focus(function() {
              $(this).attr('readonly', 'readonly').val($(this).val());
          });
          if (options.advanced && $(this).attr('id') !== 'optionalfield') {
              $(this).css('text-align', 'right');
          }
      });*/


      if (options.loader) {
        $('.loader-line').removeClass('active');
      }
      if (!options.modal) {
        $('#' + divlId).show();
      }
      $('#carusel_preview').trigger('shown:preview');

      return false;
    });
  };

  $('#PreviewStubs').on('shown.bs.modal', function() {
    $('#carusel_preview').trigger('shown:preview');
    charLimit2();
  });

  $('a[data-toggle="tab"][href="#stub_wizard_tab_3"]').on('shown.bs.tab', function() {
    charLimit2();
  });
});
