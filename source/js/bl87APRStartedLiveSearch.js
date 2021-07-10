/**
 *      APR START-DARE LIVESEARCH-AJAX
 *      @return {[type]} [description]
 */
function fAPRStartedLiveSearch() {

  const $page = new IMFAPRpageObject("#search-box-started", "#search-list-started");
  $page.$_dtstrt.toggleRO("rw").on('keyup', fAPRStartedTopSearch).focus();

  function fAPRStartedTopSearch() {
    let cLiveSearchStarted = $(this).val();

    $.each($page, function (key, value) {
      (!/form$|modal|search/i.test(key)) && value.removeClass("text-danger").not($page.$_dtstrt).val("").toggleRO("ro"); /* Reset previously shown values in the form and disable to initial */
    });

    $page.$_searchBox.css("width", getWidth => $page.$_dtstrt.closest('.input-group').outerWidth());
    if (cLiveSearchStarted.length) {
      $.get('./apr-functions.php', { task: "startedQuickDetail", prjSearch: cLiveSearchStarted })
        .done(function (projects) {
          $page.$_searchBox.slideDown(300, "linear", function () {
            $page.$_searchList.html(projects);
            $page.$_searchList.off().on("click", "p", fAPRStartedDetailSearch);
          });
        });
    } else {
      /* Don't hide this dropdown as it will break in the DATE field upon keypress
      fDisappearDropdown($page);  */
    }
  }

  function fAPRStartedDetailSearch(event) {
    $page.$_dtstrt.off();
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
      .always(() => { $page.$_dtstrt.on('keyup', fAPRStartedTopSearch).focus(); });
  }
}