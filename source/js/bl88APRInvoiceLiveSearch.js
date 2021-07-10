/**
 *      APR INVOICE LIVESEARCH-AJAX
 *      @return {[type]} [description]
 */
function fAPRInvoiceLiveSearch() {

  const $page = new IMFAPRpageObject("#search-box-invoice", "#search-list-invoice");
  $page.$_invoice.toggleRO("rw").on('keyup', fAPRInvoiceTopSearch).focus();

  function fAPRInvoiceTopSearch() {
    let cLiveSearchInvoice = $(this).val();

    $.each($page, function (key, value) {
      (!/form$|modal|search/i.test(key)) && value.removeClass("text-danger").not($page.$_invoice).val("").toggleRO("ro"); /* Reset previously shown values in the form and disable to initial */
    });

    $page.$_searchBox.css("width", getWidth => $page.$_invoice.closest('.input-group').outerWidth());
    if (cLiveSearchInvoice.length) {
      $.get('./apr-functions.php', { task: "invoiceQuickDetail", prjSearch: cLiveSearchInvoice })
        .done(function (projects) {
          $page.$_searchBox.slideDown(300, "linear", function () {
            $page.$_searchList.html(projects);
            $page.$_searchList.off().on("click", "p", fAPRInvoiceDetailSearch);
          });
        });
    } else {
      fDisappearDropdown($page);
    }
  }

  function fAPRInvoiceDetailSearch() {
    $page.$_invoice.off();
    fDisappearDropdown($page);

    let nLiveSearchID = $(this).attr("proj-id");

    $.getJSON({ url: "./apr-functions.php", beforeSend: fSpinner, complete: fSpinner }, { task: "projFullDetail", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        if (jsonPrjDetails.hasOwnProperty('fullPrjInv')) {
          fAPRFormFill(jsonPrjDetails, $page); /* ACTIVATING THE FORM */
        } else {
          fPopup("<strong>:: SYSTEM ERROR ::</strong><br/> Please ensure a working internet connection.<br />If that is working fine and you continue to receive this error then please report it.", "sticky");
        }
      })
      .always(() => { $page.$_invoice.on('keyup', fAPRInvoiceTopSearch).focus(); });
  }
}