/**
 *    DISPLAY VIWEPORT CONSISTENTLY
 *    @return {default}
 */
function showScreenSize() {
  /* Plugged in setting header's height sized top-padding to body */
  $("body").css("paddingTop", (height) => $("header").height());

  /* showScreenSize() starts here */
  if (!$("#blSizeWindow").length)
    $("<div/>", {
      id: "blSizeWindow",
      class: "px-3 py-1 small",
    })
    .css({
      position: "fixed",
      bottom: "10px",
      right: "10px",
      backgroundColor: "rgba(255,255,255,.5)",
      border: "solid 1px rgba(255,255,255,1)",
      boxShadow: "0 2px 6px rgba(0,0,0,.4)",
      color: "#333",
      zIndex: "2000",
      /* display: "none", */
    })
    .appendTo("body");

  $("#blSizeWindow").text(
    () => $(window).outerWidth() + " : " + $(window).outerHeight()
  );
}


/* Example starter JavaScript for disabling form submissions if there are invalid fields */
/* NECCESSARY FOR BOOTSTRAP VALIDATION */
window.addEventListener(
  "load",
  function () {
    /* Fetch all the forms we want to apply custom Bootstrap validation styles to */
    var forms = document.getElementsByClassName("needs-validation");
    /* Loop over them and prevent submission */
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener(
        "submit",
        function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add("was-validated");
        },
        false
      );
    });
  },
  false
);