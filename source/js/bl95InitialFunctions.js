function fInitialFunctions(argument) {
  $("#form-amf-usecustaddr", "form").on("change", function () {
    if ($("#form-amf-usecustaddr").is(":checked")) {
      $("#form-amf-addr1, #form-amf-addr2, #form-amf-addr3, #form-amf-city, #form-amf-state, #form-amf-pin").toggleEnDis("disable").removeAttr("required");
    } else {
      $("#form-amf-addr1, #form-amf-addr2, #form-amf-addr3, #form-amf-city, #form-amf-state, #form-amf-pin").toggleEnDis("enable").not("#form-amf-addr3").attr("required", "required");
    }
  });
  window.onload = function () {
    if ($("#form-amf-usecustaddr").is(":checked")) {
      $("#form-amf-addr1, #form-amf-addr2, #form-amf-addr3, #form-amf-city, #form-amf-state, #form-amf-pin").toggleEnDis("disable").removeAttr("required");
    }
  };
}