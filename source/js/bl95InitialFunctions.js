function fInitialFunctions(argument) {
  $("#form-amf-usecustaddr", "form").on("change", fAMFSetForm);
  window.onload = fAMFSetForm;
  $("#form-amf-cust").on("change", function (event) {
    let custSearchID = $("select#form-amf-cust option:selected").val();
    if (custSearchID) {
      $.getJSON("./amf_page.php", { task: "custAddress", custSearch: custSearchID })
        .done(function (jsonCustAddress) {
          let arAddrs = ["#form-amf-addr1", "#form-amf-addr2", "#form-amf-addr3", "#form-amf-city", "#form-amf-state", "#form-amf-pin"];
          for (let i = 0; i < arAddrs.length; i++) {
            let objDbValue = Object.keys(jsonCustAddress)[i];
            $(arAddrs[i]).val(jsonCustAddress[objDbValue]);
          }
        });
    } else {
      $("button[type='reset']").click();
      fAMFSetForm();
    }
  });
}

function fAMFSetForm() {
  if ($("#form-amf-usecustaddr").is(":checked")) {
    $("#form-amf-addr1, #form-amf-addr2, #form-amf-addr3, #form-amf-city, #form-amf-state, #form-amf-pin").toggleEnDis("disable").removeAttr("required");
  } else {
    $("#form-amf-addr1, #form-amf-addr2, #form-amf-addr3, #form-amf-city, #form-amf-state, #form-amf-pin").toggleEnDis("enable").not("#form-amf-addr3").attr("required", "required");
  }
}