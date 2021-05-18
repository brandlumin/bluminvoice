/**
 *    Takes INPUT from Customer Dropdown and 
 *    makes an AJAX call to pmf_list.php to
 *    populate Manager Dropdown in accordance
 *    with the chosen Customer.
 */
function fPMFpageAJAX(argument) {
  $("#form-pmf-cust").on("change", function () {
    let customerID = $(this).val();
    if (customerID > 0) {
      $.ajax({
        type: "POST",
        url: "pmf_list.php",
        data: "customerID=" + customerID,
        success: function (html) {
          $("#form-pmf-accm").html(html);
        }
      });
    } else {
      $("#form-pmf-accm").html("<option value=0 disabled selected>Select the Account Manager...</option>");
      $("#form-pmf-invoice").val("").change();
    }
  });
}