/**
 *    IMF PHP-DATA-DISPLAY
 */
function fIMFFormFill(valObj, $page) {

  /* Setting 'zero' to NULL values */
  if (!valObj.fullPrjInv.TOTAL) valObj.fullPrjInv.TOTAL = 0;
  if (!valObj.fullChanges.chgAmount) valObj.fullChanges.chgAmount = 0;

  /* APPLYING DEFERRED FORM FILLING */
  $.when( /* KEY: fullPrjInv */ fIMFFormFillFullPrjInv($page, valObj))
    .done( /* KEY: fullChanges */ fIMFFormFillFullChanges($page, valObj))
    .done( /* KEY: Invoiced */ fIMFFormFillShowInvoice($page, valObj))
    .done( /* KEY: NOT Invoiced */ fIMFFormFillCalcInvoice($page, valObj))
    .done( /* CONTENT ZOOM POP-OUT */
      $.each([$page.$_desc, $page.$_narr, $page.$_crfhistory, $page.$_billing], function (index, el) {
        !!el.val() && el.css("cursor", "zoom-in").on("click", function () {
          self = this;
          fIMFcontentZoom(self, $page);
        });
      })
    );
}

/**
 *    LEFT-PADDING FUNCTION
 *    @param  {number} num     number to provide padding to
 *    @param  {number} padlen  desired length after padding
 *    @param  {string} padchar this will be padded
 *    @return {string}         final padded result
 */
function fLeftPaddy(num, padlen, padchar = "0") {
  var pad_char = typeof padchar !== "undefined" ? padchar : "0";
  var pad = new Array(1 + padlen).join(pad_char);
  return (pad + num).slice(-pad.length);
}

/**
 *      CONTENT ZOOM POP-OUT
 */
function fIMFcontentZoom(self, $page) {

  /* self and $(this) works as caller */
  let thisElName = self.name,
    wTitle = $("label[for=" + thisElName + "]").text(),
    wContent = $(self).val();

  $page.$_modalTitle.text(wTitle);
  $page.$_modalBody.text((wContent.length) ? wContent : "-- empty --");
  if (thisElName.match(/billing/)) { $page.$_modalBody.addClass("text-monospace").css("whiteSpace", "pre"); } else { $page.$_modalBody.removeClass("text-monospace").css("whiteSpace", "pre-wrap"); }
  $page.$_detailModal.modal();
}

/**
 *      fIMFFormFill Part - Project Detail
 *      @param  {Object} $page The Form Object
 *      @param  {Object} valObj The object received from the PHP
 *      @return {Object} $page The Form Object
 */
function fIMFFormFillFullPrjInv($page, valObj) {

  if (valObj.hasOwnProperty("fullPrjInv")) {
    $page.$_form.find("[name='form-imf-projID']").val(valObj.fullPrjInv.prjID); /* PROJECT-ID */
    $page.$_invoice.val(valObj.fullPrjInv.INVOICE); /* PROJECT */
    $page.$_cust.val(valObj.fullPrjInv.CUSTOMER); /* CUSTOMER */
    $page.$_acct.val(valObj.fullPrjInv.MANAGER); /* MANAGER */

    $page.$_dtstrt.val(valObj.fullPrjInv.STARTED); /* STARTED */
    $page.$_dtend
      .val(function () {
        if (valObj.fullPrjInv.isInvoiced == 0) { /* IF NOT INVOICED */
          if (valObj.hasOwnProperty("fullChanges") && valObj.fullChanges.chgHistory != '') { /* AND HAS CHANGES TOO */
            let capture = valObj.fullChanges.chgHistory.match(/\d+-\d+-\d+/gm),
              minDtPay = capture[capture.length - 1];
            $page.$_dtend.toggleRO("rw").attr("min", minDtPay);
          } else { /* HAS NO CHANGES */
            $page.$_dtend.toggleRO("rw").attr("min", valObj.fullPrjInv.STARTED);
          }
        }
        return valObj.fullPrjInv.ENDED; /* default return (even IF INVOICED) */
      })
      .on("change", fIMFFormFillDates);

    $page.$_dtpay.attr('min', dtPay => valObj.fullPrjInv.ENDED).on("change", fIMFFormFillDates);

    $page.$_desc.val(valObj.fullPrjInv.DESCRIPTION);
    $page.$_narr.val(valObj.fullPrjInv.NARRATION);
    $page.$_qprice.val(valObj.fullPrjInv.QUOTED);
  }
  return $page;
}

/**
 *      fIMFFormFill Part - Change History
 *      @param  {Object} $page The Form Object
 *      @param  {Object} valObj The object received from the PHP
 *      @return {Object} $page The Form Object
 */
function fIMFFormFillFullChanges($page, valObj) {

  if (valObj.hasOwnProperty("fullChanges")) {
    $page.$_crftotal.val(function () {
      if (valObj.fullChanges.chgAmount > 0) {
        return "+" + (valObj.fullChanges.chgAmount).toFixed(2);
        /* } else if (valObj.fullChanges.chgAmount < 0) {
          return (valObj.fullChanges.chgAmount).toFixed(2); */
      } else {
        return (valObj.fullChanges.chgAmount).toFixed(2);
      }
    });
    $page.$_crfhistory.val(function () {
      valObj.fullChanges.chgHistory = valObj.fullChanges.chgHistory.replace(/[-\s]+$/g, "");
      return valObj.fullChanges.chgHistory;
    });
  }
  return $page;
}

/**
 *      fIMFFormFill Part - Display Invoiced Data
 *                          IF invoiced
 *      @param  {Object} $page The Form Object
 *      @param  {Object} valObj The object received from the PHP
 *      @return {Object} $page The Form Object
 */
function fIMFFormFillShowInvoice($page, valObj) {

  if (parseInt(valObj.fullPrjInv.isInvoiced)) {
    $page.$_total.val(valObj.fullPrjInv.TOTAL);
    $page.$_billing.val(valObj.fullPrjInv.BILLING);
    $page.$_dtpay.val(function () {
      if (valObj.fullPrjInv.isInvoiced == 1) {
        $(this).toggleRO("rw").attr("min", valObj.fullPrjInv.ENDED);
      }
    });
  }
  return $page;
}

/**
 *      fIMFFormFill Part - Invoice Calculations
 *                          IF NOT invoiced
 *      @param  {Object} $page The Form Object
 *      @param  {Object} valObj The object received from the PHP
 *      @return {Object} $page The Form Object
 */
function fIMFFormFillCalcInvoice($page, valObj) {

  if (!parseInt(valObj.fullPrjInv.isInvoiced)) {
    $page.$_total.val((parseInt(valObj.fullPrjInv.QUOTED) + parseInt(valObj.fullChanges.chgAmount)).toFixed(2));
    $page.$_billing.val(function () {
      let imfCgst = ($page.$_total.val() * 0.09).toFixed(2),
        imfSgst = ($page.$_total.val() * 0.09).toFixed(2),
        imfIgst = ($page.$_total.val() * 0.18).toFixed(2),
        imfGtot = (parseInt($page.$_total.val()) + parseInt(($page.$_total.val() * 0.18).toFixed(2))).toFixed(2);

      /* Filling Taxes Field */
      if (valObj.fullPrjInv.custType == "scgst") $("[name=form-imf-cgst]", $page.$_form).val(imfCgst);
      if (valObj.fullPrjInv.custType == "scgst") $("[name=form-imf-sgst]", $page.$_form).val(imfSgst);
      if (valObj.fullPrjInv.custType == "igst") $("[name=form-imf-igst]", $page.$_form).val(imfIgst);
      $("[name=form-imf-gtot]", $page.$_form).val(imfGtot);

      let objImfBill = {
        "TOTAL": "TAXABLE   : ₹ " + fLeftPaddy($page.$_total.val(), imfGtot.length),
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
  return $page;
}

/**
 *      Project EndDate & Paid Date validation function
 *      @param  {Object} e Change Event
 *      @return {[type]}   [description]
 */
function fIMFFormFillDates(e) {

  let self = this,
    $_self = $(this),
    thisMax = $_self.attr("max"),
    thisMin = $_self.attr("min"),
    thisVal = $_self.val(),
    $_targetButton = (self.id === "form-imf-dtend") ? $("form button[name=generate]") : $("form button[name=payment]");
  if (new Date(thisVal) <= new Date(thisMax) && new Date(thisMin) <= new Date(thisVal)) {
    /* Enabling Generate or Receive Payment BUTTONs depending on respective dates */
    $_self.removeClass("text-danger");
    $_targetButton.toggleEnDis("enable").addClass("btn-outline-light");
  } else {
    $_self.addClass("text-danger");
    $_targetButton.toggleEnDis("disable").removeClass("btn-outline-light");
  }
}