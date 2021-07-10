/**
 *    THIS CREATES/TOGGLES A SPINNER ON THE PAGE
 */
function fSpinner() {
  if ($(".spinner-box").length) {
    $(".spinner-box").empty().hide().remove();
  } else {
    let spinnerBox = $("body").append($("<div/>", { "class": "spinner-box", id: "spinnerBox" }).hide()).find("#spinnerBox").append($("<div/>", { "class": "pulse-container", id: "pulseContainer" })),
      pulseContainer = $("#pulseContainer");
    for (var i = 1; i < 4; i++) {
      $("<div/>", { "class": "pulse-bubble pulse-bubble-" + i }).appendTo(pulseContainer);
    }
    $(spinnerBox).show();
  }
}