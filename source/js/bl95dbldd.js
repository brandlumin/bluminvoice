$("#form-pmf-cust").on("change", function () {
  let customerID = $(this).val();
  if (customerID) {
    $.ajax({
      type: "POST",
      url: "pmf_list.php",
      data: "customerID=" + customerID,
      success: function (html) {
        $("#form-pmf-accm").html(html);
      }
    });
  } else {
    $("#form-pmf-accm").html('<option disabled value=0 selected>Choose the Account Manager...</option>');
  }
});