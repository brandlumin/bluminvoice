/**
 *    DISPLAY VIWEPORT CONSISTENTLY
 *    @return {default}
 */
function showScreenSize() {
  // While removing showScreenSize, take the following one line into Document.Ready
  $("body").css("paddingTop", (height) => $("header").height());

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
        // display: "none",
      })
      .appendTo("body");

  $("#blSizeWindow").text(
    () => $(window).outerWidth() + " : " + $(window).outerHeight()
  );
}

/**
 *
 * @param {text} msg
 * @param {number} dur
 * @param {text} bgc
 * @param {text} tc
 */
function fAlert(msg = "Alert", dur = 300, bgc = `#FFE082`, tc = `#20232a`) {
  if (bgc == `#FF5733` || bgc == `#27AE60`) tc = `#ffffff`;
  if ($(`#blAlertBox`.length)) $(`#blAlertBox`).hide();
  let box = $(`<div/>`, {
    // THE ALERT WINDOW
    id: `blAlertBox`,
    class: `text-center`,
  })
    .css({
      backgroundColor: bgc,
      border: `5px solid #fff`,
      borderRadius: `0`,
      boxShadow: `0em .5em 1.25em -.5em rgba(0,0,0,.7)`,
      color: tc,
      display: `none`,
      fontSize: `1rem`,
      fontWeight: `normal`,
      left: `50%`,
      lineHeight: `1.5`,
      padding: `1.25rem 3rem`,
      position: `fixed`,
      textShadow: `none !important`,
      top: `50%`,
      transform: `translate(calc(-50% - .1px), calc(-50% - .1px))`,
      zIndex: `10`,
    })
    .appendTo(`body`);
  let msgContent = $(`<div/>`, { id: `blAlertBoxMsg` })
    .css({
      // THE ALERT MESSAGE
      display: `flex`,
      justifyContent: `center`,
      alignItems: `center`,
      height: `100%`,
      width: `100%`,
      opacity: 0,
    })
    .html(msg)
    .appendTo(`#blAlertBox`);
  box
    .toggle(function () {
      msgContent.css(`opacity`, `1`);
    }) // when BOX displayed, show the msgContent
    .delay(dur + 500)
    .queue(() => {
      msgContent.css(`opacity`, `0`);
      box.dequeue();
    }) // once delayED, run
    .toggle(() => {
      box.remove();
    });
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function ($) {
  "use strict";
  window.addEventListener(
    "load",
    function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName("needs-validation");
      // Loop over them and prevent submission
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
})(jQuery);
