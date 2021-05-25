/**
 *    IMF PHP-DATA-DISPLAY
 */
function fPHPDataDisplay(valObj) {

  if (!valObj.changes.chgAmount) valObj.changes.chgAmount = 0;

  if (valObj.hasOwnProperty("assignment")) { // KEY: changes
    $("#form-imf-dtstrt").val(valObj.assignment.prjStartDate); // prjStartDate
    $("#form-imf-dtend").on("click, change", function (e) {
      // Enabling Invoice Generation upon Ending the project i.e. Filling the 'End Date'
      if ($(this).val()) {
        $(this).addClass("bg-success text-white");
        $("[name=generate]").toggleEnDis("enable").addClass("btn-outline-light");
      } else {
        $(this).removeClass("bg-success text-white");
        $("[name=generate]").toggleEnDis("disable").removeClass("btn-outline-light");
      }
    }).val(function () {
      if (valObj.assignment.isInvoiced == 0) $("#form-imf-dtend, #form-imf-billing").toggleRO("rw").attr("min", valObj.assignment.prjStartDate);
      return valObj.assignment.prjEndDate;
    });
    $("#form-imf-desc").val(valObj.assignment.prjDesc);
    $("#form-imf-narr").val(valObj.assignment.prjNarr);
    $("#form-imf-qprice").val(valObj.assignment.prjCostQuoted);
  }

  if (valObj.hasOwnProperty("changes")) { // KEY: changes
    $("#form-imf-crftotal").val(function () {
      if (valObj.changes.chgAmount > 0) {
        return "+" + (valObj.changes.chgAmount).toFixed(2);
      } else if (valObj.changes.chgAmount < 0) {
        return (valObj.changes.chgAmount).toFixed(2);
      } else {
        return (valObj.changes.chgAmount).toFixed(2);
      }
    });
    $("#form-imf-crfhistory").val(valObj.changes.chgHistory);
    $("#form-imf-dtpay").on("click, change", function (e) {
      // Enabling Payment Receipt upon receiving the payment i.e. Filling the 'Paid Date'
      if ($(this).val()) {
        $(this).addClass("bg-success text-white");
        $("form [name=payment]").toggleEnDis("enable").addClass("btn-outline-light");
      } else {
        $(this).removeClass("bg-success text-white");
        $("form [name=payment]").toggleEnDis("disable").removeClass("btn-outline-light");
      }
    });
  }

  if (valObj.hasOwnProperty("invoice")) { // KEY: invoice
    $("#form-imf-total").val(valObj.invoice.prjTotalBill);
    $("#form-imf-billing").val(valObj.invoice.prjBillDetails);
    $("#form-imf-dtpay").val(function () {
      if ((valObj.assignment.isInvoiced == 1) && (valObj.invoice.isPaid == 0)) {
        $(this).toggleRO("rw").attr("min", valObj.assignment.prjEndDate);
      }
      return valObj.invoice.prjPaidDate;
    });
  } else { // KEY: invoice absent
    $("#form-imf-total").val((parseInt(valObj.assignment.prjCostQuoted) + parseInt(valObj.changes.chgAmount)).toFixed(2));
    $("#form-imf-billing").val(function () {
      let imfCgst = ($("#form-imf-total").val() * 0.09).toFixed(2),
        imfSgst = ($("#form-imf-total").val() * 0.09).toFixed(2),
        imfIgst = ($("#form-imf-total").val() * 0.18).toFixed(2),
        imfGtot = (parseInt($("#form-imf-total").val()) + parseInt(($("#form-imf-total").val() * 0.18).toFixed(2))).toFixed(2);
      if (valObj.assignment.custType == "scgst") $("[name=form-imf-cgst]").val(imfCgst);
      if (valObj.assignment.custType == "scgst") $("[name=form-imf-sgst]").val(imfSgst);
      if (valObj.assignment.custType == "igst") $("[name=form-imf-igst]").val(imfIgst);
      $("[name=form-imf-gtot]").val(imfGtot);
      let objImfBill = {
        "TOTAL": "TAXABLE   : ₹ " + paddy($("#form-imf-total").val(), imfGtot.length),
        "CGST": "CGST ( 9%): ₹ " + paddy(imfCgst, imfGtot.length),
        "SGST": "SGST ( 9%): ₹ " + paddy(imfSgst, imfGtot.length),
        "IGST": "IGST (18%): ₹ " + paddy(imfIgst, imfGtot.length),
        "GTOT": "PAYABLE   : ₹ " + paddy(imfGtot, imfGtot.length)
      };
      if (valObj.assignment.custType == "igst") {
        // remove CGST and SGST
        delete objImfBill.CGST;
        delete objImfBill.SGST;
      } else {
        // remove IGST
        delete objImfBill.IGST;
      }
      let imfBillText = "";
      for (let key in objImfBill) {
        if (key == "GTOT") {
          imfBillText = imfBillText + "--------------------------\n" + objImfBill[key];
        } else {
          imfBillText = imfBillText + objImfBill[key] + "\n";
        }
      }
      return imfBillText;
    });
  }
}

/**
 *    LEFT-PADDING FUNCTION
 *    @param  {number} num     number to provide padding to
 *    @param  {number} padlen  desired length after padding
 *    @param  {string} padchar this will be padded
 *    @return {string}         final padded result
 */
function paddy(num, padlen, padchar = "0") {
  var pad_char = typeof padchar !== 'undefined' ? padchar : '0';
  var pad = new Array(1 + padlen).join(pad_char);
  return (pad + num).slice(-pad.length);
}