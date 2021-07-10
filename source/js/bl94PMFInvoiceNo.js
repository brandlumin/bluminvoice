/**
 *    Takes INPUT from Customer Dropdown and 
 *    makes an AJAX call to pmf_list.php to
 *    populate Manager Dropdown in accordance
 *    with the chosen Customer.
 */
function fPMFpageAJAX() {
  $("#form-pmf-cust").on("change", function () {
    let customerID = $(this).val();
    if (customerID > 0) {
      $.getJSON({ url: "pmf_functions.php", beforeSend: fSpinner, complete: fSpinner }, { customerID: customerID })
        .done(function (jsonManagersAMF) {
          $("#form-pmf-accm").html(jsonManagersAMF);
        });
    } else {
      $("#form-pmf-accm").html("<option value=0 disabled selected>Select the Account Manager...</option>");
    }
  });
}


/**
 *    Generate INVOICE Number for the form
 *    on the basis of project counts
 */
function fPMFInvoiceNo() {
  /* function to add left padding */
  function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
  }

  /* creating the variable */
  let x = "BL20/Q4-61",
    invoiceField = $("#form-pmf-invoice"),
    /* this is what we want it to look like */
    invTag = "BL",
    invDate = new Date(),
    invYear = invDate.getFullYear(),
    invMonth = invDate.getMonth() + 1,
    invQuarter = Math.ceil(invMonth / 3) - 1,
    invNo = pad(invoiceField.data("default"), 2);
  invQuarter = (!invQuarter) ? 4 : invQuarter; /* if quarter == 0 then set it to 1 */
  invYear = (invQuarter < 4) ? invYear : invYear - 1; /* if quarter == 4, reduce the year by 1 */
  let invSerial = invTag + (/\d{2}$/).exec(invYear) + "/Q" + invQuarter + "-" + invNo;

  /* pushing value to the form */
  invoiceField.val(invSerial).change();
}