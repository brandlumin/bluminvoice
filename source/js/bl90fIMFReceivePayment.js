/*function fIMFReceivePayment() {
  $.get("imf-functions.php", { work: "markReceivePayment", value: $("[name=form-imf-projID]").val(), recDate: $("#form-imf-dtpay").val() })
    .done(function (prjDetails) {
      if (prjDetails) {
        let jsonArrayedObject = $.parseJSON(prjDetails); // Parsing (or breaking) the array to access the object.
        console.log(jsonArrayedObject);
        //  printing all the keys
        // for (let aKey in jsonArrayedObject) {
        //   for (let bKey in jsonArrayedObject[aKey]) {
        //     console.log(bKey);
        //   }
        // } 
      }
    }, "json")
    .done(function () {
      $("#form-imf-dtpay").off("click, change");
      $("#form-imf-dtpay").removeClass("bg-success text-white");
      $("form [type=button]").toggleEnDis("disable").removeClass("btn-outline-light").off("click", fIMFReceivePayment);
      fResetForm(); // resetting the form
    });
}*/