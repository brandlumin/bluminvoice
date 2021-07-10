/**
 *    CRF LIVESEARCH-AJAX
 */
function fCRFLiveSearch() {
  let $_form = $("form"),
    $_searchBox = $_form.find("#search-box");
  $_form.find("[type='reset']").off("click", fCRFReset).on("click", fCRFReset);
  /* extracted "input" event from "ON" */
  $("#form-crf-project").on("keyup", function () {
    /* Get input value on change  */
    let inputVal = $(this).val();
    if (inputVal.length) {
      $.getJSON("./crf-functions.php", { term: inputVal, task: "DropDown" })
        .done(function (jsonProjNameSearchCRF) {
          $_searchBox.slideDown(300, "linear", function () {
            $_searchBox.find("#search-list").html(jsonProjNameSearchCRF);
            $_searchBox.find("#search-list").off().on("click", "p", fCRFPopulateProject);
          });
        });
    } else {
      /* hiding the dropdown */
      $_searchBox.slideUp(300, "linear", function () {
        $_searchBox.find("#search-list").empty();
      });
    }
  });

  /* Set search input value on click of result item */

  function fCRFPopulateProject() {
    let $_this = $(this),
      prjDate = $_this.attr("proj-dt"),
      projD = $_this.attr("proj-id");
    fCRFReset();

    $.getJSON("./crf-functions.php", { term: projD, task: "LastDate" })
      .done(function () { /* hiding the dropdown and enabling the form*/
        $_searchBox.slideUp(300, "linear", function () {
          $_searchBox.find("#search-list").empty();
          $_form.find("#form-crf-desc").focus();
        });
        $_form.find("#form-crf-date, #form-crf-desc, #form-crf-amount").toggleRO("rw"); /* enabling the form */
      })
      .done(function (lastDate) { /* setting minimum date attribute */
        $_form.find("[name='form-crf-custID']").val($_this.attr("cust-id")); /* filling cust-id */
        $_form.find("[name='form-crf-projectID']").val($_this.attr("proj-id")); /* filling proj-id */

        $_form.find("#form-crf-cust").val($_this.attr("cust-name")); /* filling cust-name */
        $_form.find("#form-crf-project").val($_this.text()); /* filling search-input OR proj-name */
        $_form.find("#form-crf-invoice").val($_this.attr("proj-in")); /* filling invoice number */
        $_form.find("#form-crf-date").attr("min", () => lastDate || prjDate); /* setting minimum date attribute */
      });
  }
}

/**
 *    CRF LIVESEARCH--RESULT-BOX-WIDTH
 */
function fCRFLiveSearchWidth() {
  $("#search-box").css('width', (x) => $("#search-box").prev(".input-group").outerWidth());
}

/**
 *    reset/refresh the form before every search-display
 *    @return   resets the form as desired
 */
function fCRFReset() {
  let $_form = $("form");
  $_form.find("input, textarea").val(function () {
    $(this).toggleRO("ro");
    return "";
  });
  $_form.find("#form-crf-project").toggleRO("rw");
  $_form.find("#form-crf-date").removeAttr("min");
}