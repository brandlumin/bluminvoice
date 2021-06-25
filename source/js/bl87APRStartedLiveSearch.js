/**
 *    APR INVOICE LIVESEARCH-AJAX
 */
function fAPRStartedLiveSearch() {
  /* extracted "input" event from "ON" */
  $("#form-apr-dtstrt").toggleRO("rw").on('keyup', function () {
    let cLiveSearchStarted = $(this).val();
    $("[id^='form-apr']").removeClass("text-danger").not("#form-apr-dtstrt").val("");
    $("#search-box-started").css("width", getWidth => $("#form-apr-dtstrt").closest('.input-group').outerWidth());
    if (cLiveSearchStarted.length) {
      // run ajax call
      $.get('./apr-functions.php', { task: "startedQuickDetail", prjSearch: cLiveSearchStarted })
        .done(function (projects) {
          /* Display the returned projects in browser */
          $("#search-box-started").slideDown(300, "linear", function () {
            $("#search-list-started").html(projects);
          });
        });
    } else {
      /* hiding the dropdown upon emptying the search field */
      fDisappearDropdown("started");
    }
  }).focus();

  /* Set search input value on click of result item */
  $("#search-list-started").on("click", "p", function (event) {
    $("form input[type='text'], form input[type='date'], form textarea").val("").not("#form-apr-dtstrt").toggleRO("ro");
    fDisappearDropdown("started");
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
        fDisappearDropdown("started");
        fSpinner();
      });
  });
}