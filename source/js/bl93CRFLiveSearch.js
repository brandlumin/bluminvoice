/**
 *    CRF LIVESEARCH-AJAX
 */
function fCRFLiveSearch(argument) {
  $('#form-crf-search[type="text"]').on("keyup", function () { // extracted "input" event from "ON"
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
    // form data to be used while registering the CRF
    $("[name=form-crf-custID]").val($(this).attr("cust-id")).change(); // filling cust-id
    $("[name=form-crf-projectID]").val($(this).attr("proj-id")).change(); // filling proj-id

    // form data to be shown ONLY
    $("#form-crf-cust").val($(this).attr("cust-name")).change(); // filling cust-name
    $("#form-crf-search, #form-crf-project").val($(this).text()).change(); // filling search-input, proj-name

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
  $("#search-box").css("width", getWidth => $("#form-crf-searchform").outerWidth());
}