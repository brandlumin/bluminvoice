/**
 *      APR START-DARE LIVESEARCH-AJAX
 *      @return {[type]} [description]
 */
function fAPRStartedLiveSearch() {
  $("#form-apr-dtstrt").toggleRO("rw").on('keyup', fAPRStartedTopSearch).focus();

  function fAPRStartedTopSearch() {
    let cLiveSearchStarted = $(this).val();
    $("[id^='form-apr']").removeClass("text-danger").not("#form-apr-dtstrt").val("").toggleRO("ro");
    $("#search-box-started").css("width", getWidth => $("#form-apr-dtstrt").closest('.input-group').outerWidth());
    if (cLiveSearchStarted.length) {
      $.get('./apr-functions.php', { task: "startedQuickDetail", prjSearch: cLiveSearchStarted })
        .done(function (projects) {
          $("#search-box-started").slideDown(300, "linear", function () {
            $("#search-list-started").html(projects);
            $("#search-list-started").off().on("click", "p", fAPRStartedDetailSearch);
          });
        });
    } else {
      /* Don't hide this dropdown as it will break in the DATE field upon keypress
      fDisappearDropdown("started");  */
    }
  }

  function fAPRStartedDetailSearch(event) {
    $("#form-apr-dtstrt").off();
    fDisappearDropdown("started");

    let nLiveSearchID = $(this).attr("proj-id");

    $.getJSON({ url: "./apr-functions.php", beforeSend: fSpinner, complete: fSpinner }, { task: "projFullDetail", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        if (jsonPrjDetails.hasOwnProperty('fullPrjInv')) {
          fAPRFormFill(jsonPrjDetails);
        } else {
          fPopup("<strong>:: SYSTEM ERROR ::</strong><br/> Please ensure a working internet connection.<br />If that is working fine and you continue to receive this error then please report it.", "sticky");
        }
      })
      .always(() => { $("#form-apr-dtstrt").on('keyup', fAPRStartedTopSearch).focus(); });
  }
}