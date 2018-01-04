// Simulates PHP's date function
Date.prototype.format = function(format) {
    var returnStr = '';
    var replace = Date.replaceChars;
    for (var i = 0; i < format.length; i++) {       var curChar = format.charAt(i);         if (i - 1 >= 0 && format.charAt(i - 1) == "\\") {
            returnStr += curChar;
        }
        else if (replace[curChar]) {
            returnStr += replace[curChar].call(this);
        } else if (curChar != "\\"){
            returnStr += curChar;
        }
    }
    return returnStr;
};

Date.replaceChars = {
    shortMonths: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    longMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    shortDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    longDays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],

    // Day
    d: function() { return (this.getDate() < 10 ? '0' : '') + this.getDate(); },
    D: function() { return Date.replaceChars.shortDays[this.getDay()]; },
    j: function() { return this.getDate(); },
    l: function() { return Date.replaceChars.longDays[this.getDay()]; },
    N: function() { return this.getDay() + 1; },
    S: function() { return (this.getDate() % 10 == 1 && this.getDate() != 11 ? 'st' : (this.getDate() % 10 == 2 && this.getDate() != 12 ? 'nd' : (this.getDate() % 10 == 3 && this.getDate() != 13 ? 'rd' : 'th'))); },
    w: function() { return this.getDay(); },
    z: function() { var d = new Date(this.getFullYear(),0,1); return Math.ceil((this - d) / 86400000); }, // Fixed now
    // Week
    W: function() { var d = new Date(this.getFullYear(), 0, 1); return Math.ceil((((this - d) / 86400000) + d.getDay() + 1) / 7); }, // Fixed now
    // Month
    F: function() { return Date.replaceChars.longMonths[this.getMonth()]; },
    m: function() { return (this.getMonth() < 9 ? '0' : '') + (this.getMonth() + 1); },
    M: function() { return Date.replaceChars.shortMonths[this.getMonth()]; },
    n: function() { return this.getMonth() + 1; },
    t: function() { var d = new Date(); return new Date(d.getFullYear(), d.getMonth(), 0).getDate() }, // Fixed now, gets #days of date
    // Year
    L: function() { var year = this.getFullYear(); return (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)); },   // Fixed now
    o: function() { var d  = new Date(this.valueOf());  d.setDate(d.getDate() - ((this.getDay() + 6) % 7) + 3); return d.getFullYear();}, //Fixed now
    Y: function() { return this.getFullYear(); },
    y: function() { return ('' + this.getFullYear()).substr(2); },
    // Time
    a: function() { return this.getHours() < 12 ? 'am' : 'pm'; },
    A: function() { return this.getHours() < 12 ? 'AM' : 'PM'; },
    B: function() { return Math.floor((((this.getUTCHours() + 1) % 24) + this.getUTCMinutes() / 60 + this.getUTCSeconds() / 3600) * 1000 / 24); }, // Fixed now
    g: function() { return this.getHours() % 12 || 12; },
    G: function() { return this.getHours(); },
    h: function() { return ((this.getHours() % 12 || 12) < 10 ? '0' : '') + (this.getHours() % 12 || 12); },
    H: function() { return (this.getHours() < 10 ? '0' : '') + this.getHours(); },
    i: function() { return (this.getMinutes() < 10 ? '0' : '') + this.getMinutes(); },
    s: function() { return (this.getSeconds() < 10 ? '0' : '') + this.getSeconds(); },
    u: function() { var m = this.getMilliseconds(); return (m < 10 ? '00' : (m < 100 ?
'0' : '')) + m; },
    // Timezone
    e: function() { return "Not Yet Supported"; },
    I: function() {
        var DST = null;
            for (var i = 0; i < 12; ++i) {
                    var d = new Date(this.getFullYear(), i, 1);
                    var offset = d.getTimezoneOffset();

                    if (DST === null) DST = offset;
                    else if (offset < DST) { DST = offset; break; }                     else if (offset > DST) break;
            }
            return (this.getTimezoneOffset() == DST) | 0;
        },
    O: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + '00'; },
    P: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + ':00'; }, // Fixed now
    T: function() { var m = this.getMonth(); this.setMonth(0); var result = this.toTimeString().replace(/^.+ \(?([^\)]+)\)?$/, '$1'); this.setMonth(m); return result;},
    Z: function() { return -this.getTimezoneOffset() * 60; },
    // Full Date/Time
    c: function() { return this.format("Y-m-d\\TH:i:sP"); }, // Fixed now
    r: function() { return this.toString(); },
    U: function() { return this.getTime() / 1000; }
};

function setOpionNrRange(selector, start, end, step = 1, replaceExisting = true) {
  var options = $(document.createDocumentFragment())
  for(var i = start; i <= end; i += step) {
    console.log(i);
    options.append($("<option></option>")
         .attr("value", i)
         .text(i)
    );
  }
  console.log(options);
  if(replaceExisting) {
    $(selector).html(options);
  } else {
    $(selector).append(options);
  }

}
function getNumber(selector) {
  return 1 * $(selector).val();
}

function getStubDate(startDate, index, frequency) {
  var date = new Date(startDate);

  switch (frequency)
  {
    case "1":
      date.setDate(date.getDate() - 7 * index);
      console.log("F:", frequency, "I:", index, date);
      break;
    case "2":
      date.setDate(date.getDate() - 14 * index);
      break;
    case "3":
      date.setDate(date.getDate() - Math.floor(15.5 * index));
      break;
    case "4":
      console.log("INDEX: ", index, " ------------------------");
      for(var i = 1; i <= index; i++) {
        var month = date.getMonth() - i;
        var year = date.getFullYear();
        if(month < 0) {
          month += 12;
          year--;
        }
        var days = daysInMonth(month + 1, year);
        console.log(month, year, days, "<", date.getDate());

        if(days < date.getDate()) {
          console.log("YE");
          date.setDate(days);
        }
      }
      date.setMonth(date.getMonth() - index);
      break;
    case "5":
      date.setFullYear(date.getFullYear() - index);
      break;
  }
  return date;
}

function getEndDate(pay_date, freq) {
  var pay_date2;
  if(freq == 1) {
    pay_date2 = new Date(pay_date - 2 * 86400000);
  } else {
    pay_date2 = new Date(pay_date - 3 * 86400000);
  }
  return pay_date2;
}

function getStartDate(pay_date, freq) {
  var pay_date2, pay_date9;
  pay_date2 = getEndDate(pay_date, freq)
  if(frequency == 1) {
    pay_date9 = new Date(pay_date - 8 * 86400000);
  } else if (frequency == 2) {
    pay_date9 = new Date(pay_date - 16 * 86400000);
  } else if (frequency == 3) {
    var md = daysInMonthDate(pay_date2);
    md = Math.round(md / 2) + 2;
    pay_date9 = new Date(pay_date - md * 86400000);
  } else if (frequency == 4) {
    var md = daysInMonthDate(pay_date2);
    md = md + 2;
    pay_date9 = new Date(pay_date - md * 86400000);
  } else if (frequency == 5) {
    md = 365;
    pay_date9 = new Date(pay_date - md * 86400000);
  }
  return pay_date9;
}
