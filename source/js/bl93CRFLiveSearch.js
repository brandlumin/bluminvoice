/**
 *    CRF LIVESEARCH-AJAX
 */
function fCRFLiveSearch() {
  $('#form-crf-project[type="text"]').on("keyup", function () { // extracted "input" event from "ON"
    // Get input value on change 
    let inputVal = $(this).val();
    if (inputVal.length) {
      $.get("crf-livelist.php", { term: inputVal }).done(function (data) {
        // Display the returned data in browser
        if (data) {
          $("#search-box").slideDown(300, "linear", function () {
            $("#search-list").html(data);
          });
        }
      });
    } else {
      // hiding the dropdown
      $("#search-box").slideUp(300, "linear", function () {
        $("#search-list").empty();
      });
    }
  });

  // Set search input value on click of result item
  $("#search-list").on("click", "p", function () {

    fResetForm();

    // form data to be used while registering the CRF
    $("[name=form-crf-custID]").val($(this).attr("cust-id")); // filling cust-id
    $("[name=form-crf-projectID]").val($(this).attr("proj-id")); // filling proj-id

    // form data to be shown ONLY
    $("#form-crf-cust").val($(this).attr("cust-name")); // filling cust-name
    $("#form-crf-project").val($(this).text()); // filling search-input OR proj-name
    $("#form-crf-invoice").val($(this).attr("proj-in")); // filling invoice number
    $("#form-crf-date").attr("min", $(this).attr("proj-dt")).change(); // setting minimum date

    // enabling the form
    $("#form-crf-date, #form-crf-desc, #form-crf-amount").toggleRO("rw");

    // hiding the dropdown
    $("#search-box").slideUp(300, "linear", function () {
      $("#search-list").empty();
      $("#form-crf-desc").focus();
    });
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
function fResetForm() {
  // event.preventDefault();
  $("input, textarea").val(function () {
    $(this).toggleRO("ro");
    $('#form-crf-project[type="text"]').toggleRO("rw");
    return "";
  });
}