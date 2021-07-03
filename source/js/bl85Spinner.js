/**
 *    THIS CREATES/TOGGLES A SPINNER ON THE PAGE
 *    @return {logical} TRUE
 */
function fSpinner() {
  if ($(".spinner-box").length) {
    $(".spinner-box").empty().hide().remove();
  } else {
    $("body").append($("<div/>", { "class": "spinner-box", id: "spinnerBox" }).hide()).find("#spinnerBox").append($("<div/>", { "class": "pulse-container", id: "pulseContainer" }));
    let pulseContainer = $("#pulseContainer");
    for (var i = 1; i < 4; i++) {
      $("<div/>", { "class": "pulse-bubble pulse-bubble-" + i }).appendTo(pulseContainer);
    }
    $(".spinner-box").show();
  }
}