/**
 *      APR PROJECT LIVESEARCH-AJAX
 *      @return {[type]} [description]
 */
function fAPRProjLiveSearch() {
  $("#form-apr-proj").toggleRO("rw").on('keyup', fAPRProjectTopSearch).focus(); /* Enable keyup for project search */

  function fAPRProjectTopSearch() {
    let cLiveSearchID = $(this).val(); /* Capture parts to fetch Project list */
    $("[id^='form-apr']").removeClass("text-danger").not("#form-apr-proj").val("").toggleRO("ro"); /* Reset previously shown values in the form and disable to initial */
    $("#search-box-project").css("width", getWidth => $("#form-apr-proj").closest('.input-group').outerWidth());

    if (cLiveSearchID.length) {
      $.get('./apr-functions.php', { task: "projQuickDetail", prjSearch: cLiveSearchID })
        .done(function (projects) {
          $("#search-box-project").slideDown(300, "linear", function () {
            $("#search-list-project").html(projects);
            $("#search-list-project").off().on("click", "p", fAPRProjectDetailSearch); /* Reset click on project list */
          });
        });
    } else {
      fDisappearDropdown("project"); /* Hide dropdown and disable click on projects */
    }
  }

  function fAPRProjectDetailSearch() {
    $("#form-apr-proj").off(); /* Disable keyup for project search */
    fDisappearDropdown("project"); /* Hide dropdown and disable click on projects */

    $("#form-apr-proj").val(x => event.target.innerText); /* Display project name in field during spinner */
    let nLiveSearchID = event.target.attributes[0].nodeValue; /* Capture Project-ID to fetch details */

    $.getJSON({ url: "./apr-functions.php", beforeSend: fSpinner, complete: fSpinner }, { task: "projFullDetail", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        if (jsonPrjDetails.hasOwnProperty('fullPrjInv')) {
          fAPRFormFill(jsonPrjDetails); /* FORM FILLING */
        } else {
          fPopup("<strong>:: SYSTEM ERROR ::</strong><br/> Please ensure a working internet connection.<br />If that is working fine and you continue to receive this error then please report it.", "sticky");
        }
      })
      .always(() => { $("#form-apr-proj").on('keyup', fAPRProjectTopSearch).focus(); /* Enable keyup for project search */ });
  }
}