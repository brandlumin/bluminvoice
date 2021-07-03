/**
 *      APR END-DATE LIVESEARCH-AJAX
 *      @return {[type]} [description]
 */
function fAPREndedLiveSearch() {
  $("#form-apr-dtend").toggleRO("rw").on('keyup', fAPREndedTopSearch).focus();

  function fAPREndedTopSearch() {
    let cLiveSearchEnded = $(this).val();
    $("[id^='form-apr']").removeClass("text-danger").not("#form-apr-dtend").val("").toggleRO("ro");
    $("#search-box-ended").css("width", getWidth => $("#form-apr-dtend").closest('.input-group').outerWidth());
    if (cLiveSearchEnded.length) {
      $.get('./apr-functions.php', { task: "endedQuickDetail", prjSearch: cLiveSearchEnded })
        .done(function (projects) {
          $("#search-box-ended").slideDown(300, "linear", function () {
            $("#search-list-ended").html(projects);
            $("#search-list-ended").off().on("click", "p", fAPREndedDetailSearch);
          });
        });
    } else {
      /* Don't hide this dropdown as it will break in the DATE field upon keypress
      fDisappearDropdown("ended");  */
    }
  }

  function fAPREndedDetailSearch(event) {
    $("#form-apr-dtend").off();
    fDisappearDropdown("ended");

    let nLiveSearchID = $(this).attr("proj-id");

    $.getJSON({ url: "./apr-functions.php", beforeSend: fSpinner, complete: fSpinner }, { task: "projFullDetail", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        if (jsonPrjDetails.hasOwnProperty('fullPrjInv')) {
          fAPRFormFill(jsonPrjDetails);
        } else {
          fPopup("<strong>:: SYSTEM ERROR ::</strong><br/> Please ensure a working internet connection.<br />If that is working fine and you continue to receive this error then please report it.", "sticky");
        }
      })
      .always(() => { $("#form-apr-dtend").on('keyup', fAPREndedTopSearch).focus(); });
  }
}