/**
 *    IMF LIVESEARCH-AJAX
 */
function fIMFLiveSearch() {
  $('#form-imf-proj[type="text"]').on("keyup", function () { // extracted "input" event from "ON"
    // Get input value on change 
    let inputVal = $(this).val();
    if (inputVal.length) {
      $.get("imf-functions.php", { work: "findProjectForInvoice", value: inputVal }).done(function (projects) {
        // Display the returned projects in browser
        if (projects) {
          $("#search-box").slideDown(300, "linear", function () {
            $("#search-list").html(projects);
          });
        }
      });
    } else {
      // hiding the dropdown upon emptying the search field
      $("#search-box").slideUp(300, "linear", function () {
        $("#search-list").empty();
      });
    }
  });

  // Set search input value on click of result item
  $("#search-list").on("click", "p", function () {
    fResetForm();
    // form data to be used while working the IMF
    $("#form-imf-invoice").val($(this).attr("invo-id"));
    // ...additionally, this remains hidden
    $("[name=form-imf-projID]").val($(this).attr("proj-id"));
    $("[name=form-imf-custID]").val($(this).attr("cust-id"));
    $("[name=form-imf-acctID]").val($(this).attr("acct-id"));

    // form data to be shown ONLY
    $("#form-imf-proj").val($(this).text());
    $("#form-imf-cust").val($(this).attr("cust-name"));
    $("#form-imf-acct").val($(this).attr("acct-name"));

    /* FETCH REMAINING DATA FROM PHP CALL */
    $.get("imf-functions.php", { work: "findProjectDetailForInvoice", value: $(this).attr("proj-id") })
      .done(function (prjDetails) {
        if (prjDetails) {
          let jsonArrayedObject = $.parseJSON(prjDetails); // Parsing (or breaking) the array to access the object.
          console.log(jsonArrayedObject);
          /* printing all the keys
          for (let aKey in jsonArrayedObject) {
            for (let bKey in jsonArrayedObject[aKey]) {
              console.log(bKey);
            }
          } */
          fPHPDataDisplay(jsonArrayedObject);
        }
      }, "json")
      .done(function () {
        // hiding the dropdown
        $("#search-box").slideUp(300, "linear", function () {
          $("#search-list").empty();
          $("#form-imf-desc").focus();
        });
      });
  });
}

/**
 *    IMF LIVESEARCH--RESULT-BOX-WIDTH
 */
function fIMFLiveSearchWidth() {
  $("#search-box").css("width", getWidth => $("#form-imf-proj").closest('.input-group').outerWidth());
}

/**
 *    reset/refresh the form before every search-display
 *    @return   resets the form as desired
 */
function fResetForm() {
  // event.preventDefault();
  $("input, textarea").val(function () {
    $(this).toggleRO("ro");
    $("form button:not([type=reset])").toggleEnDis("disable");
    $('#form-imf-proj[type="text"]').toggleRO("rw");
    return "";
  });
  console.log("The form has been refreshed.");
}