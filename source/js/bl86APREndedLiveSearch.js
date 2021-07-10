/**
 *      APR END-DATE LIVESEARCH-AJAX
 *      @return {[type]} [description]
 */
function fAPREndedLiveSearch() {

  const $page = new IMFAPRpageObject("#search-box-ended", "#search-list-ended");
  $page.$_dtend.toggleRO("rw").on('keyup', fAPREndedTopSearch).focus();

  function fAPREndedTopSearch() {
    let cLiveSearchEnded = $(this).val();

    $.each($page, function (key, value) {
      (!/form$|modal|search/i.test(key)) && value.removeClass("text-danger").not($page.$_dtend).val("").toggleRO("ro"); /* Reset previously shown values in the form and disable to initial */
    });

    $page.$_searchBox.css("width", getWidth => $page.$_dtend.closest('.input-group').outerWidth());
    if (cLiveSearchEnded.length) {
      $.get('./apr-functions.php', { task: "endedQuickDetail", prjSearch: cLiveSearchEnded })
        .done(function (projects) {
          $page.$_searchBox.slideDown(300, "linear", function () {
            $page.$_searchList.html(projects);
            $page.$_searchList.off().on("click", "p", fAPREndedDetailSearch);
          });
        });
    } else {
      /* Don't hide this dropdown as it will break in the DATE field upon keypress
      fDisappearDropdown($page);  */
    }
  }

  function fAPREndedDetailSearch(event) {
    $page.$_dtend.off();
    fDisappearDropdown($page);

    let nLiveSearchID = $(this).attr("proj-id");

    $.getJSON({ url: "./apr-functions.php", beforeSend: fSpinner, complete: fSpinner }, { task: "projFullDetail", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        if (jsonPrjDetails.hasOwnProperty('fullPrjInv')) {
          fAPRFormFill(jsonPrjDetails, $page);
        } else {
          fPopup("<strong>:: SYSTEM ERROR ::</strong><br/> Please ensure a working internet connection.<br />If that is working fine and you continue to receive this error then please report it.", "sticky");
        }
      })
      .always(() => { $page.$_dtend.on('keyup', fAPREndedTopSearch).focus(); });
  }
}