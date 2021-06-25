/**
 *    APR INVOICE LIVESEARCH-AJAX
 */
function fAPRInvoiceLiveSearch() {
  /* extracted "input" event from "ON" */
  $("#form-apr-invoice").toggleRO("rw").on('keyup', function () {
    let cLiveSearchInvoice = $(this).val();
    $("[id^='form-apr']").removeClass("text-danger").not("#form-apr-invoice").val("");
    $("#search-box-invoice").css("width", getWidth => $("#form-apr-invoice").closest('.input-group').outerWidth());
    if (cLiveSearchInvoice.length) {
      // run ajax call
      $.get('./apr-functions.php', { task: "invoiceQuickDetail", prjSearch: cLiveSearchInvoice })
        .done(function (projects) {
          /* Display the returned projects in browser */
          $("#search-box-invoice").slideDown(300, "linear", function () {
            $("#search-list-invoice").html(projects);
          });
        });
    } else {
      /* hiding the dropdown upon emptying the search field */
      fDisappearDropdown("invoice");
    }
  }).focus();

  /* Set search input value on click of result item */
  $("#search-list-invoice").on("click", "p", function (event) {
    $("form input[type='text'], form input[type='date'], form textarea").val("").not("#form-apr-invoice").toggleRO("ro");
    fDisappearDropdown("invoice");
    let nLiveSearchID = $(this).attr("proj-id");
    $.getJSON({ url: "./apr-functions.php", beforeSend: fSpinner }, { task: "projFullDetail", prjSearch: nLiveSearchID })
      .then(function (jsonPrjDetails) {
        if (jsonPrjDetails) {
          for (let aKey in jsonPrjDetails) {
            for (let bKey in jsonPrjDetails[aKey]) {}
          }
          /* ACTIVATE THE FORM */
          fAPRFormFill(jsonPrjDetails);
        }
      }, fSpinner)
      .done(() => {
        fDisappearDropdown("invoice");
        fSpinner();
      });
  });
}