/**
 *    APR PROJECT LIVESEARCH-AJAX
 */
function fAPRProjLiveSearch() {
  /* extracted "input" event from "ON" */
  $("#form-apr-proj").toggleRO("rw").on('keyup', function () {
    let cLiveSearchID = $(this).val();
    $("[id^='form-apr']").removeClass("text-danger").not("#form-apr-proj").val("");
    $("#search-box-project").css("width", getWidth => $("#form-apr-proj").closest('.input-group').outerWidth());
    if (cLiveSearchID.length) {
      // run ajax call
      $.get('./apr-functions.php', { task: "projQuickDetail", prjSearch: cLiveSearchID })
        .done(function (projects) {
          /* Display the returned projects in browser */
          $("#search-box-project").slideDown(300, "linear", function () {
            $("#search-list-project").html(projects);
          });
        });
    } else {
      /* hiding the dropdown upon emptying the search field */
      fDisappearDropdown("project");
    }
  }).focus();

  /* Set search input value on click of result item */
  $("#search-list-project").on("click", "p", function (event) {
    $("form input[type='text'], form input[type='date'], form textarea").val("").not("#form-apr-proj").toggleRO("ro");
    $("#form-apr-proj").val(() => event.target.innerText); /* displaying the project name */
    fDisappearDropdown("project");
    let nLiveSearchID = event.target.attributes[0].nodeValue;
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
        fDisappearDropdown("project");
        fSpinner();
      });
  });
}