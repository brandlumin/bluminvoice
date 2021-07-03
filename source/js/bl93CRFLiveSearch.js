/**
 *    CRF LIVESEARCH-AJAX
 */
function fCRFLiveSearch() {
  /* extracted "input" event from "ON" */
  $('#form-crf-project[type="text"]').on("keyup", function () {
    /* Get input value on change  */
    let inputVal = $(this).val();
    if (inputVal.length) {
      $.get("./crf-livelist.php", { term: inputVal, task: "DropDown" }).done(function (data) {
        /* Display the returned data in browser */
        if (data) {
          $("#search-box").slideDown(300, "linear", function () {
            $("#search-list").html(data);
          });
        }
      });
    } else {
      /* hiding the dropdown */
      $("#search-box").slideUp(300, "linear", function () {
        $("#search-list").empty();
      });
    }
  });

  /* Set search input value on click of result item */
  $("#search-list").on("click", "p", function () {
    fSpinner();
    let $el = $(this),
      prjDate = $el.attr("proj-dt"),
      projD = $el.attr("proj-id");
    fCRFReset();

    $.get("./crf-livelist.php", { term: projD, task: "LastDate" })
      .then(function (lastDate) {
        $("[name=form-crf-custID]").val($el.attr("cust-id")); /* filling cust-id */
        $("[name=form-crf-projectID]").val($el.attr("proj-id")); /* filling proj-id */

        $("#form-crf-cust").val($el.attr("cust-name")); /* filling cust-name */
        $("#form-crf-project").val($el.text()); /* filling search-input OR proj-name */
        $("#form-crf-invoice").val($el.attr("proj-in")); /* filling invoice number */
        $("#form-crf-date").attr("min", () => lastDate || prjDate);
        /* optional for #form-crf-date above
        /* if (lastDate) $("#form-crf-date").attr("min", lastDate);
        else $("#form-crf-date").attr("min", prjDate); */
      }, fSpinner)
      .done(function () {
        /* enabling the form */
        $("#form-crf-date, #form-crf-desc, #form-crf-amount").toggleRO("rw");
        /* hiding the dropdown */
        $("#search-box").slideUp(300, "linear", function () {
          $("#search-list").empty();
          $("#form-crf-desc").focus();
        });
        fSpinner();
      }); /* setting minimum date */
  });
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
  /* event.preventDefault(); */
  $("input, textarea").val(function () {
    $(this).toggleRO("ro");
    return "";
  });
  $("#form-crf-project").toggleRO("rw");
  $("#form-crf-date").removeAttr("min");
}