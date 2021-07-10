/**
 *      APR PROJECT LIVESEARCH-AJAX
 *      @return {[type]} [description]
 */
function fAPRProjLiveSearch() {

  const $page = new IMFAPRpageObject("#search-box-project", "#search-list-project");
  $page.$_project.toggleRO("rw").on('keyup', fAPRProjectTopSearch).focus(); /* Enable keyup for project search */

  function fAPRProjectTopSearch() {
    let cLiveSearchID = $(this).val(); /* Capture parts to fetch Project list */

    $.each($page, function (key, value) {
      (!/form$|modal|search/i.test(key)) && value.removeClass("text-danger").not($page.$_project).val("").toggleRO("ro"); /* Reset previously shown values in the form and disable to initial */
    });

    $page.$_searchBox.css("width", getWidth => $page.$_project.closest('.input-group').outerWidth());

    if (cLiveSearchID.length) {
      $.get('./apr-functions.php', { task: "projQuickDetail", prjSearch: cLiveSearchID })
        .done(function (projects) {
          $page.$_searchBox.slideDown(300, "linear", function () {
            $page.$_searchList.html(projects);
            $page.$_searchList.off().on("click", "p", fAPRProjectDetailSearch); /* Reset click on project list */
          });
        });
    } else {
      fDisappearDropdown($page); /* Hide dropdown and disable click on projects */
    }
  }

  function fAPRProjectDetailSearch() {
    $page.$_project.off(); /* Disable keyup for project search */
    fDisappearDropdown($page); /* Hide dropdown and disable click on projects */

    $page.$_project.val(x => event.target.innerText); /* Display project name in field during spinner */
    let nLiveSearchID = event.target.attributes[0].nodeValue; /* Capture Project-ID to fetch details */

    $.getJSON({ url: "./apr-functions.php", beforeSend: fSpinner, complete: fSpinner }, { task: "projFullDetail", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        if (jsonPrjDetails.hasOwnProperty('fullPrjInv')) {
          fAPRFormFill(jsonPrjDetails, $page); /* ACTIVATING THE FORM */
        } else {
          fPopup("<strong>:: SYSTEM ERROR ::</strong><br/> Please ensure a working internet connection.<br />If that is working fine and you continue to receive this error then please report it.", "sticky");
        }
      })
      .always(() => { $page.$_project.on('keyup', fAPRProjectTopSearch).focus(); /* Enable keyup for project search */ });
  }
}