/**
 *    APR  Setup Radios
 */
function fAPRSetupRadios(argument) {
  $("input[type='radio']", "form").on("change", function () {
    fResetAPRpage();
    const aprAction = $("input[name='searchBy']:checked", "form").val();
    switch (aprAction) {
      case "Project":
        fAPRProjLiveSearch();
        break;
      case "Invoice":
        fAPRInvoiceLiveSearch();
        break;
      case "Started":
        fAPRStartedLiveSearch();
        break;
      case "Ended":
        fAPREndedLiveSearch();
        break;
    }
  });
  fAPRProjLiveSearch(); /* Run as default */
}

/**
 *    APR RESET PAGE UPON RADIO CHANGE
 */
function fResetAPRpage() {
  $("[id^='search-box']").slideUp(300, "linear", function () {
    $("[id^='search-list']").empty().off("click", "p");
  }); /* Hide all search-boxes and disable their clicks */
  $("[id^='form-apr']").off().removeClass("text-danger").val("").toggleRO("ro"); /* Disable, remove danger-classes, all values and toggle all fields to RO */
  $("#form-apr-desc, #form-apr-narr, #form-apr-crfhistory, #form-apr-billing").css("cursor", "auto").off(); /* Disable zoom-in feature for blank records upon reset */
}

/**
 *    APR PROJECT LIVESEARCH--HIDE-SEARCH-BOX
 */
function fDisappearDropdown($page) {
  /* Emptying the search List and hiding the search Box */
  $page.$_searchBox.slideUp(300, "linear", function () {
    $page.$_searchList.empty().off("click", "p");
  });
}

/**
 *    APR PHP-DATA-DISPLAY
 */
function fAPRFormFill(valObj, $page) {

  /* Setting 'zero' to NULL values */
  if (!valObj.fullPrjInv.TOTAL) valObj.fullPrjInv.TOTAL = 0;
  if (!valObj.fullChanges.chgAmount) valObj.fullChanges.chgAmount = 0;

  $.when(fAPRFormFillFullPrjInv($page, valObj))
    .done(fIMFFormFillFullChanges($page, valObj))
    .done(fAPRFormFillShowInvoice($page, valObj))
    .done(fIMFFormFillCalcInvoice($page, valObj))
    .done(fAPRFormFillCalcInvoice($page, valObj))
    .done(
      /* CONTENT ZOOM POP-OUT */
      $.each([$page.$_desc, $page.$_narr, $page.$_crfhistory, $page.$_billing], function (index, el) {
        !!el.val() && el.css("cursor", "zoom-in").on("click", function () {
          self = this;
          fIMFcontentZoom(self, $page);
        });
      })
    );
}

/**
 *      fAPRFormFill Part - Project Detail
 *      @param  {Object} $page The Form Object
 *      @param  {Object} valObj The object received from the PHP
 *      @return {Object} $page The Form Object
 */
function fAPRFormFillFullPrjInv($page, valObj) {

  if (valObj.hasOwnProperty("fullPrjInv")) {
    $page.$_form.find("[name='form-apr-projID']").val(valObj.fullPrjInv.prjID); /* PROJECT-ID */
    $page.$_invoice.val(valObj.fullPrjInv.INVOICE); /* PROJECT */
    $page.$_cust.val(valObj.fullPrjInv.CUSTOMER); /* CUSTOMER */
    $page.$_acct.val(valObj.fullPrjInv.MANAGER); /* MANAGER */

    $page.$_dtstrt.val(valObj.fullPrjInv.STARTED); /* STARTED */
    $page.$_dtend.val(function () {
      if (!valObj.fullPrjInv.ENDED) $(this).addClass("text-danger");
      return valObj.fullPrjInv.ENDED;
    });
    $page.$_dtpay.val(function () {
      if (!valObj.fullPrjInv.PAID) $(this).addClass("text-danger");
      return valObj.fullPrjInv.PAID;
    });

    $page.$_desc.val(valObj.fullPrjInv.DESCRIPTION);
    $page.$_narr.val(valObj.fullPrjInv.NARRATION);
    $page.$_qprice.val(valObj.fullPrjInv.QUOTED);
  }
  return $page;
}

/**
 *      fAPRFormFill Part - Display Invoiced Data
 *                          IF invoiced
 *      @param  {Object} $page The Form Object
 *      @param  {Object} valObj The object received from the PHP
 *      @return {Object} $page The Form Object
 */
function fAPRFormFillShowInvoice($page, valObj) {

  if (parseInt(valObj.fullPrjInv.isInvoiced)) {
    $page.$_total.val(valObj.fullPrjInv.TOTAL);
    $page.$_billing.val(function () {
      let aprBillText = "";
      if (!valObj.fullPrjInv.ENDED) aprBillText = "* PROJECT NOT INVOICED *\n";
      if (!valObj.fullPrjInv.PAID) aprBillText = aprBillText + "**** PROJECT NOT PAID ****\n";
      if (aprBillText !== "") aprBillText = aprBillText + "==========================\n";
      valObj.fullPrjInv.BILLING = aprBillText + valObj.fullPrjInv.BILLING;
      return valObj.fullPrjInv.BILLING;
    });
  }
  return $page;
}

/**
 *      fAPRFormFill Part - Invoice Calculations
 *                          IF UnEnded or UnBilled, then
 *                          prepending the notification 
 *                          text to the value
 *      @param  {Object} $page The Form Object
 *      @param  {Object} valObj The object received from the PHP
 *      @return {Object} $page The Form Object
 */
function fAPRFormFillCalcInvoice($page, valObj) {

  if (!valObj.fullPrjInv.ENDED || !valObj.fullPrjInv.PAID) {
    $page.$_billing.val(function () {
      let billDetails = this.value;
      if (!valObj.fullPrjInv.ENDED) aprBillText = "** PROJECT NOT INVOICED **\n";
      if (!valObj.fullPrjInv.PAID) aprBillText = aprBillText + "**** PROJECT NOT PAID ****\n";
      if (aprBillText !== "") aprBillText = aprBillText + "==========================\n";
      return (aprBillText + billDetails);
    });
  }
}