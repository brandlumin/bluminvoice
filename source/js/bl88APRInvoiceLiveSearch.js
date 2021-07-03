/**
 *      APR INVOICE LIVESEARCH-AJAX
 *      @return {[type]} [description]
 */
function fAPRInvoiceLiveSearch() {
  $("#form-apr-invoice").toggleRO("rw").on('keyup', fAPRInvoiceTopSearch).focus();

  function fAPRInvoiceTopSearch() {
    let cLiveSearchInvoice = $(this).val();
    $("[id^='form-apr']").removeClass("text-danger").not("#form-apr-invoice").val("").toggleRO("ro");
    $("#search-box-invoice").css("width", getWidth => $("#form-apr-invoice").closest('.input-group').outerWidth());
    if (cLiveSearchInvoice.length) {
      $.get('./apr-functions.php', { task: "invoiceQuickDetail", prjSearch: cLiveSearchInvoice })
        .done(function (projects) {
          $("#search-box-invoice").slideDown(300, "linear", function () {
            $("#search-list-invoice").html(projects);
            $("#search-list-invoice").off().on("click", "p", fAPRInvoiceDetailSearch);
          });
        });
    } else {
      fDisappearDropdown("invoice");
    }
  }

  function fAPRInvoiceDetailSearch() {
    $("#form-apr-invoice").off();
    fDisappearDropdown("invoice");

    let nLiveSearchID = $(this).attr("proj-id");

    $.getJSON({ url: "./apr-functions.php", beforeSend: fSpinner, complete: fSpinner }, { task: "projFullDetail", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        if (jsonPrjDetails.hasOwnProperty('fullPrjInv')) {
          fAPRFormFill(jsonPrjDetails);
        } else {
          fPopup("<strong>:: SYSTEM ERROR ::</strong><br/> Please ensure a working internet connection.<br />If that is working fine and you continue to receive this error then please report it.", "sticky");
        }
      })
      .always(() => { $("#form-apr-invoice").on('keyup', fAPRInvoiceTopSearch).focus(); });
  }
}