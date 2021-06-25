/**
 *    IMF LIVESEARCH-AJAX
 */
function fIMFLiveSearch() {
  /* extracted "input" event from "ON" */
  $("#form-imf-proj").on('keyup', function () {
    let cLiveSearchID = $(this).val();
    if (cLiveSearchID.length) {
      // run ajax call
      $.get('./imf-functions.php', { task: "QuickList", prjSearch: cLiveSearchID })
        .done(function (projects) {
          /* Display the returned projects in browser */
          $("#search-box").slideDown(300, "linear", function () {
            $("#search-list").html(projects);
          });
        });
    } else {
      /* hiding the dropdown upon emptying the search field */
      fIMFHideSearchBox();
    }
  });

  /* Set search input value on click of result item */
  $("#search-list").on("click", 'p', function (event) {

    function beforeSendCleanup() {
      fSpinner();
      $("form [type=submit]").toggleEnDis("disable").removeClass("btn-outline-light");
      $("form input, form textarea").val("").removeClass("text-danger").removeAttr("min").not("#form-imf-proj").toggleRO("ro");
      $("#form-imf-proj").val(() => event.target.innerText);
      fIMFHideSearchBox();
    }

    let nLiveSearchID = event.target.attributes[0].nodeValue;
    $.getJSON({ url: "./imf-functions.php", beforeSend: beforeSendCleanup }, { task: "FullList", prjSearch: nLiveSearchID })
      .then(function (jsonPrjDetails) {
        if (jsonPrjDetails) {
          fIMFFormFill(jsonPrjDetails); /* ACTIVATE THE FORM */
        }
      }, fSpinner)
      .done(fSpinner);
  });
}

/**
 *    IMF LIVESEARCH--RESULT-BOX-WIDTH
 */
function fIMFLiveSearchWidth() {
  $("#search-box").css("width", getWidth => $("#form-imf-proj").closest('.input-group').outerWidth());
  /* SETTING THE RESET BUTTON'S FUNCTIONALITY HERE JUST BECUASE OF AALAS */
  $("button[type=reset]").on("click", function () {
    $("form [type=submit]").toggleEnDis("disable").removeClass("btn-outline-light");
    $("form input, form textarea").val("").removeClass("text-danger").removeAttr("min").not("#form-imf-proj").toggleRO("ro");
  });
}

/**
 *    IMF LIVESEARCH--HIDE-SEARCH-BOX
 *    @return {[type]} [description]
 */
function fIMFHideSearchBox() {
  /* hiding the dropdown upon emptying the search field */
  $("#search-box").slideUp(300, "linear", function () {
    $("#search-list").empty();
  });
}