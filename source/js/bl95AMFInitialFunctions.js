/**
 *      Fetches customer's address upom toggling the switch of AMF
 *      @param  {[type]} argument [description]
 */
function fInitialFunctions(argument) {

  const $page = new AMFpageObject();

  window.addEventListener("load", fAMFSetForm);

  $page.$_usecustaddr.on("change", fAMFSetForm);

  /* Upon RESET, additionally resets all the address fields as disabled */
  $page.$_btnReset.off().on("click", () => {
    $.each($page, function (key, value) {
      (/addr|city|state|pin/i.test(key)) && value.toggleEnDis("disable").removeAttr("required"); /* Reset previously shown values in the form and disable to initial */
    });
  });

  /* Fetch selected customer's address depending upon the Customer-Dropdown */
  $page.$_cust.on("change", function (event) {
    let custSearchID = $page.$_cust.find("option:selected").val();
    if (custSearchID) {
      $.getJSON({ url: "./amf_page.php", beforeSend: fSpinner, complete: fSpinner }, { task: "custAddress", custSearch: custSearchID })
        .done(function (jsonCustAddress) {
          let arAddrs = [$page.$_addr1, $page.$_addr2, $page.$_addr3, $page.$_city, $page.$_state, $page.$_pin];
          for (let i = 0; i < arAddrs.length; i++) {
            let objDbValue = Object.keys(jsonCustAddress)[i];
            arAddrs[i].val(jsonCustAddress[objDbValue]);
          }
        });
    } else {
      /* if Customer is selected back to 'Choose Customer' in the Customer-Dropdown */
      fAMFSetForm(null, $page);
      $page.$_btnReset.click();
    }
  });
}

/**
 *      Setup AMF page upon window.load and on Reset
 *      @param  {Object} event  Event of window.onload
 *      @param  {Object} $pgObj "$page" Object to traverse
 */
function fAMFSetForm(event, $pgObj) {
  const $page = $pgObj || new AMFpageObject();

  if ($page.$_usecustaddr.is(":checked")) {
    $.each([$page.$_addr1, $page.$_addr2, $page.$_addr3, $page.$_city, $page.$_state, $page.$_pin], function (index, el) {
      el.toggleEnDis("disable").removeAttr("required");
    });
  } else {
    $.each([$page.$_addr1, $page.$_addr2, $page.$_addr3, $page.$_city, $page.$_state, $page.$_pin], function (index, el) {
      (el.get(0).name != "form-amf-addr3") && el.toggleEnDis("enable").attr("required", "required");
      (el.get(0).name == "form-amf-addr3") && el.toggleEnDis("enable");
    });
  }
}