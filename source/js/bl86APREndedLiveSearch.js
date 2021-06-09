/**
 *    APR INVOICE LIVESEARCH-AJAX
 */
function fAPREndedLiveSearch() {
  /* extracted "input" event from "ON" */
  $("#form-apr-dtend").toggleRO("rw").on('keyup', function () {
    let cLiveSearchEnded = $(this).val();
    $("[id^='form-apr']").removeClass("text-danger").not("#form-apr-dtend").val("");
    $("#search-box-ended").css("width", getWidth => $("#form-apr-dtend").closest('.input-group').outerWidth());
    if (cLiveSearchEnded.length) {
      // run ajax call
      $.get('./apr-functions.php', { task: "endedQuickDetail", prjSearch: cLiveSearchEnded })
        .done(function (projects) {
          /* Display the returned projects in browser */
          $("#search-box-ended").slideDown(300, "linear", function () {
            $("#search-list-ended").html(projects);
          });
        });
    } else {
      /* hiding the dropdown upon emptying the search field */
      fDisappearDropdown("ended");
    }
  }).focus();

  /* Set search input value on click of result item */
  $("#search-list-ended").on("click", "p", function (event) {
    $("form input[type='text'], form input[type='date'], form textarea").val("").not("#form-apr-dtend").toggleRO("ro");
    fDisappearDropdown("ended");
    let nLiveSearchID = $(this).attr("proj-id");
    $.getJSON("./apr-functions.php", { task: "projFullDetail", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        if (jsonPrjDetails) {
          for (let aKey in jsonPrjDetails) {
            for (let bKey in jsonPrjDetails[aKey]) {}
          }
          /* ACTIVATE THE FORM */
          fAPRFormFill(jsonPrjDetails);
        }
      })
      .done(fDisappearDropdown("ended"));
  });
}