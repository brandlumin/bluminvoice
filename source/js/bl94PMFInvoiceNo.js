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


/**
 *    Generate INVOICE Number on the form on
 *    the basis of project counts
 */
function fPMFInvoiceNo(argument) {
  /* function to add left padding */
  function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
  }

  /* creating the variable */
  let x = "BL20/Q4-61",
    /* this is what we want it to look like */
    invTag = "BL",
    invDate = new Date(),
    invYear = invDate.getFullYear(),
    invMonth = invDate.getMonth() + 1,
    invQuarter = Math.ceil(invMonth / 3) - 1,
    invNo = pad($("#form-pmf-invoice").attr("default"), 2),
    invSerial = invTag + (/\d{2}$/).exec(invYear) + "/Q" + invQuarter + "-" + invNo;

  /* pushing value to the form */
  $("#form-pmf-invoice").val(invSerial).change();
}