/**
 *    THIS CREATES/TOGGLES A SPINNER ON THE PAGE
 *    @return {logical} TRUE
 */
function fSpinner() {
  if ($(".spinner-box").length) {
    /* if Spinner is displayed then proceed to hide and then remove it */
    $(".spinner-box").hide().delay(10).remove();
    console.log("Spinner Erased");
  } else {
    /* declaring the promise/ action */
    let snipperStep = () => { $("body").append($("<div/>", { class: "spinner-box" }).css("display", "none")).find(".spinner-box").append($("<div/>", { class: "pulse-container" })); };
    /* declaring the deferred */
    let snipperDeferred = $.Deferred();
    /* chaining the success callback */
    $.when(snipperDeferred)
      .done(snipperStep)
      .done(function () {
        $.each(["pulse-bubble-1", "pulse-bubble-2", "pulse-bubble-3"], function (index, classlist) {
          $("<div/>", { class: "pulse-bubble " + classlist }).appendTo(".pulse-container");
          /* if it's last iteration then display the spinner */
          if (index == 2) $(".spinner-box").show();
        });
        console.log("Spinner Created");
      });
    /* resolving the deferred */
    snipperDeferred.resolve(snipperStep);
  }
}