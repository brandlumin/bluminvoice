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
        // fAlert("Caution<br/>This module has not yet begun.", 1200);
        break;
    }
  });
  fAPRProjLiveSearch();
}


/**
 *    APR RESET PAGE UPON RADIO CHANGE
 */
function fResetAPRpage() {
  $("[id^='search-box']").slideUp(300, "linear", function () {
    $("[id^='search-list']").empty();
  });
  $("[id^='form-apr']").removeClass("text-danger").val("").toggleRO("ro");
}


/**
 *    APR PROJECT LIVESEARCH--HIDE-SEARCH-BOX
 */
function fDisappearDropdown(searchBy) {
  /* hiding the dropdown upon emptying the search field */
  let parentBox = "#search-box-" + searchBy,
    childBox = "#search-list-" + searchBy,
    hideIt = $(parentBox).slideUp(300, "linear", function () {
      $(childBox).empty();
    });
}


/**
 *    APR FORM FILL DURING SEARCH BY PROJECT
 */
function fAPRFormFill(valObj) {

  /* CONTENT ZOOM POP-OUT */
  $("#form-apr-desc, #form-apr-narr, #form-apr-crfhistory, #form-apr-billing").css("cursor", "zoom-in").on("click", function (event) {
    event.preventDefault();
    /* $(this) works as caller */
    let thisElName = $(this)[0].name,
      thisElID = $(this),
      wTitle = $("label[for='" + thisElName + "']").text(),
      wContent = thisElID.val();
    $('#detailModal .modal-title').text(wTitle);
    $('#detailModal .modal-body').text((wContent.length) ? wContent : "-- empty --").css("color", "black");
    if (thisElName.match(/billing/)) { $('#detailModal .modal-body').addClass("text-monospace").css('whiteSpace', 'pre'); } else { $('#detailModal .modal-body').removeClass("text-monospace").css('whiteSpace', 'pre-wrap'); }
    $('#detailModal').modal();
  });

  /* Setting 'zero' to NULL values */
  if (!valObj.fullPrjInv.TOTAL) valObj.fullPrjInv.TOTAL = 0;
  if (!valObj.fullChanges.chgAmount) valObj.fullChanges.chgAmount = 0;

  /* KEY: fullPrjInv */
  if (valObj.hasOwnProperty("fullPrjInv")) {
    $("#form-apr-proj").val(valObj.fullPrjInv.PROJECT); /* PROJECT */
    $("[name='form-apr-projID']").val(valObj.fullPrjInv.prjID); /* PROJECT-ID */
    $("#form-apr-invoice").val(valObj.fullPrjInv.INVOICE); /* PROJECT */
    $("#form-apr-cust").val(valObj.fullPrjInv.CUSTOMER); /* CUSTOMER */
    $("#form-apr-acct").val(valObj.fullPrjInv.MANAGER); /* MANAGER */

    $("#form-apr-dtstrt").val(valObj.fullPrjInv.STARTED); /* STARTED */
    $("#form-apr-dtend").val(function () {
      if (!valObj.fullPrjInv.ENDED) $(this).addClass("text-danger");
      return valObj.fullPrjInv.ENDED;
    });
    $("#form-apr-dtpay").val(function () {
      if (!valObj.fullPrjInv.PAID) $(this).addClass("text-danger");
      return valObj.fullPrjInv.PAID;
    });
    $("#form-apr-desc").val(valObj.fullPrjInv.DESCRIPTION);
    $("#form-apr-narr").val(valObj.fullPrjInv.NARRATION);
    $("#form-apr-qprice").val(valObj.fullPrjInv.QUOTED);
  }

  /* KEY: fullChanges */
  if (valObj.hasOwnProperty("fullChanges")) {
    $("#form-apr-crftotal").val(function () {
      if (valObj.fullChanges.chgAmount > 0) {
        return "+" + (valObj.fullChanges.chgAmount).toFixed(2);
      } else if (valObj.fullChanges.chgAmount < 0) {
        return (valObj.fullChanges.chgAmount).toFixed(2);
      } else {
        return (valObj.fullChanges.chgAmount).toFixed(2);
      }
    });
    $("#form-apr-crfhistory").val(function () {
      valObj.fullChanges.chgHistory = valObj.fullChanges.chgHistory.replace(/[-\s]+$/g, "");
      return valObj.fullChanges.chgHistory;
    });
  }

  /* IF invoiced */
  if (parseInt(valObj.fullPrjInv.isInvoiced)) {
    $("#form-apr-total").val(valObj.fullPrjInv.TOTAL);
    $("#form-apr-billing").val(function () {
      let aprBillText = "";
      if (!valObj.fullPrjInv.ENDED) aprBillText = "* PROJECT NOT INVOICED *\n";
      if (!valObj.fullPrjInv.PAID) aprBillText = aprBillText + "**** PROJECT NOT PAID ****\n";
      if (aprBillText !== "") aprBillText = aprBillText + "==========================\n";
      valObj.fullPrjInv.BILLING = aprBillText + valObj.fullPrjInv.BILLING;
      return valObj.fullPrjInv.BILLING;
    });
  } else { /* IF NOT invoiced */
    $("#form-apr-total").val((parseInt(valObj.fullPrjInv.QUOTED) + parseInt(valObj.fullChanges.chgAmount)).toFixed(2));
    $("#form-apr-billing").val(function () {
      let aprCgst = ($("#form-apr-total").val() * 0.09).toFixed(2),
        aprSgst = ($("#form-apr-total").val() * 0.09).toFixed(2),
        aprIgst = ($("#form-apr-total").val() * 0.18).toFixed(2),
        aprGtot = (parseInt($("#form-apr-total").val()) + parseInt(($("#form-apr-total").val() * 0.18).toFixed(2))).toFixed(2);

      /* Filling Taxes Field */
      if (valObj.fullPrjInv.custType == "scgst") $("[name='form-apr-cgst']").val(aprCgst);
      if (valObj.fullPrjInv.custType == "scgst") $("[name='form-apr-sgst']").val(aprSgst);
      if (valObj.fullPrjInv.custType == "igst") $("[name='form-apr-igst']").val(aprIgst);
      $("[name='form-apr-gtot']").val(aprGtot);

      let objImfBill = {
        "TOTAL": "TAXABLE   : ₹ " + fLeftPaddy($("#form-apr-total").val(), aprGtot.length),
        "CGST": "CGST ( 9%): ₹ " + fLeftPaddy(aprCgst, aprGtot.length),
        "SGST": "SGST ( 9%): ₹ " + fLeftPaddy(aprSgst, aprGtot.length),
        "IGST": "IGST (18%): ₹ " + fLeftPaddy(aprIgst, aprGtot.length),
        "GTOT": "PAYABLE   : ₹ " + fLeftPaddy(aprGtot, aprGtot.length)
      };
      if (valObj.fullPrjInv.custType == "igst") {
        /* remove CGST and SGST */
        delete objImfBill.CGST;
        delete objImfBill.SGST;
      } else {
        /* remove IGST */
        delete objImfBill.IGST;
      }
      let aprBillText = "";
      if (!valObj.fullPrjInv.ENDED) aprBillText = "** PROJECT NOT INVOICED **\n";
      if (!valObj.fullPrjInv.PAID) aprBillText = aprBillText + "**** PROJECT NOT PAID ****\n";
      if (aprBillText !== "") aprBillText = aprBillText + "==========================\n";
      for (let key in objImfBill) {
        if (key == "GTOT") {
          aprBillText = aprBillText + "==========================\n" + objImfBill[key];
        } else {
          aprBillText = aprBillText + objImfBill[key] + "\n";
        }
      }
      /* Returning Billing Details */
      return aprBillText;
    });
  }
}