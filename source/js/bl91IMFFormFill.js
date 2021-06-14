/**
 *    IMF PHP-DATA-DISPLAY
 */
function fIMFFormFill(valObj) {

  /* Setting 'zero' to NULL values */
  if (!valObj.fullPrjInv.TOTAL) valObj.fullPrjInv.TOTAL = 0;
  if (!valObj.fullChanges.chgAmount) valObj.fullChanges.chgAmount = 0;

  /* KEY: fullPrjInv */
  if (valObj.hasOwnProperty("fullPrjInv")) {
    $("[name='form-imf-projID']").val(valObj.fullPrjInv.prjID); /* PROJECT-ID */
    $("#form-imf-invoice").val(valObj.fullPrjInv.INVOICE); /* PROJECT */
    $("#form-imf-cust").val(valObj.fullPrjInv.CUSTOMER); /* CUSTOMER */
    $("#form-imf-acct").val(valObj.fullPrjInv.MANAGER); /* MANAGER */

    $("#form-imf-dtstrt").val(valObj.fullPrjInv.STARTED); /* STARTED */
    $("#form-imf-dtend").on("click, change", function (e) {
      let thisMax = $(this).attr("max"),
        thisMin = $(this).attr("min"),
        thisVal = $(this).val();
      if (new Date(thisVal) <= new Date(thisMax) && new Date(thisMin) <= new Date(thisVal)) {
        /* Enabling Invoice Generation BUTTON upon Ending the project i.e. Filling the 'End Date' */
        $("[name=generate]").toggleEnDis("enable").addClass("btn-outline-light");
      } else {
        $("[name=generate]").toggleEnDis("disable").removeClass("btn-outline-light");
      }
    }).val(function () {
      if (valObj.fullPrjInv.isInvoiced == 0) { /* IF NOT INVOICED */
        if (valObj.hasOwnProperty("fullChanges") && valObj.fullChanges.chgHistory != '') { /* AND HAS CHANGES TOO */
          let capture = valObj.fullChanges.chgHistory.match(/\d+-\d+-\d+/gm),
            minDtPay = capture[capture.length - 1];
          $("#form-imf-dtend").toggleRO("rw").attr("min", minDtPay);
        } else { /* HAS NO CHANGES */
          $("#form-imf-dtend").toggleRO("rw").attr("min", valObj.fullPrjInv.STARTED);
        }
      }
      return valObj.fullPrjInv.ENDED; /* default return (even IF INVOICED) */
    });
    $("#form-imf-dtpay").on("click, change", function (e) {
      let thisMax = $(this).attr("max"),
        thisMin = $(this).attr("min"),
        thisVal = $(this).val();
      if (new Date(thisVal) <= new Date(thisMax) && new Date(thisMin) <= new Date(thisVal)) {
        /* Enabling Payment Receipt BUTTON upon receiving the payment i.e. Filling the 'Paid Date' */
        $("form [name=payment]").toggleEnDis("enable").addClass("btn-outline-light");
      } else {
        $("form [name=payment]").toggleEnDis("disable").removeClass("btn-outline-light");
      }
    }).attr('min', dtPay => valObj.fullPrjInv.ENDED);
    $("#form-imf-desc").val(valObj.fullPrjInv.DESCRIPTION);
    $("#form-imf-narr").val(valObj.fullPrjInv.NARRATION);
    $("#form-imf-qprice").val(valObj.fullPrjInv.QUOTED);
  }

  /* KEY: fullChanges */
  if (valObj.hasOwnProperty("fullChanges")) {
    $("#form-imf-crftotal").val(function () {
      if (valObj.fullChanges.chgAmount > 0) {
        return "+" + (valObj.fullChanges.chgAmount).toFixed(2);
      } else if (valObj.fullChanges.chgAmount < 0) {
        return (valObj.fullChanges.chgAmount).toFixed(2);
      } else {
        return (valObj.fullChanges.chgAmount).toFixed(2);
      }
    });
    $("#form-imf-crfhistory").val(function () {
      valObj.fullChanges.chgHistory = valObj.fullChanges.chgHistory.replace(/[-\s]+$/g, "");
      return valObj.fullChanges.chgHistory;
    });
  }

  /* IF invoiced */
  if (parseInt(valObj.fullPrjInv.isInvoiced)) {
    $("#form-imf-total").val(valObj.fullPrjInv.TOTAL);
    $("#form-imf-billing").val(valObj.fullPrjInv.BILLING);
    $("#form-imf-dtpay").val(function () {
      if (valObj.fullPrjInv.isInvoiced == 1) {
        $(this).toggleRO("rw").attr("min", valObj.fullPrjInv.ENDED);
      }
    });
  } else { /* IF NOT invoiced */
    $("#form-imf-total").val((parseInt(valObj.fullPrjInv.QUOTED) + parseInt(valObj.fullChanges.chgAmount)).toFixed(2));
    $("#form-imf-billing").val(function () {
      let imfCgst = ($("#form-imf-total").val() * 0.09).toFixed(2),
        imfSgst = ($("#form-imf-total").val() * 0.09).toFixed(2),
        imfIgst = ($("#form-imf-total").val() * 0.18).toFixed(2),
        imfGtot = (parseInt($("#form-imf-total").val()) + parseInt(($("#form-imf-total").val() * 0.18).toFixed(2))).toFixed(2);

      /* Filling Taxes Field */
      if (valObj.fullPrjInv.custType == "scgst") $("[name=form-imf-cgst]").val(imfCgst);
      if (valObj.fullPrjInv.custType == "scgst") $("[name=form-imf-sgst]").val(imfSgst);
      if (valObj.fullPrjInv.custType == "igst") $("[name=form-imf-igst]").val(imfIgst);
      $("[name=form-imf-gtot]").val(imfGtot);

      let objImfBill = {
        "TOTAL": "TAXABLE   : ₹ " + fLeftPaddy($("#form-imf-total").val(), imfGtot.length),
        "CGST": "CGST ( 9%): ₹ " + fLeftPaddy(imfCgst, imfGtot.length),
        "SGST": "SGST ( 9%): ₹ " + fLeftPaddy(imfSgst, imfGtot.length),
        "IGST": "IGST (18%): ₹ " + fLeftPaddy(imfIgst, imfGtot.length),
        "GTOT": "PAYABLE   : ₹ " + fLeftPaddy(imfGtot, imfGtot.length)
      };
      if (valObj.fullPrjInv.custType == "igst") {
        /* remove CGST and SGST */
        delete objImfBill.CGST;
        delete objImfBill.SGST;
      } else {
        /* remove IGST */
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
      /* Returning Billing Details */
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
function fLeftPaddy(num, padlen, padchar = "0") {
  var pad_char = typeof padchar !== 'undefined' ? padchar : '0';
  var pad = new Array(1 + padlen).join(pad_char);
  return (pad + num).slice(-pad.length);
}