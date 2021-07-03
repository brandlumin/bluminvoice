/**
 *    WINDOW RESIZE FUNCTION RUNS WHEN WINDOW"S SIZE CHANGES
 *    @param  {function}   does the magic
 */
function windowResize(event) {
  showScreenSize(); /* shows the screen-dimension on-screen */ 
  $("body").css("padding-top", $("header").height()); /* setting the header display right */ 
  if ($("#login").length) crfPageDisplay($("#login")); /* setting sticky-footer on login page */ 
  if ($(".bl__crf_crf").length)
    crfPageDisplay(
      $(".bl__crf_crf"),
      parseInt($("body").css("padding-top")) +
      parseInt($("footer").css("margin-top"))
    ); /* setting sticky-footer on CRF page */ 
  if ($(".bl__cstmr_form").length)
    crfPageDisplay(
      $(".bl__cstmr_form"),
      parseInt($("body").css("padding-top")) +
      parseInt($("footer").css("margin-top"))
    ); /* setting sticky - footer on login page * /
}

function crfPageDisplay(el) {
  if (ifStickyNeeded(el, (anyAddlHeight = 0))) {
    $("footer").addClass("sticky-footer");
  } else {
    $("footer").removeClass("sticky-footer");
  }
}

function ifStickyNeeded(el, anyAddlHeight, isStickyNeeded = 0) {
  let scrWidth = $(window).width(),
    scrHeight = $(window).height(),
    elHeight = el.height() + (anyAddlHeight || 0);
  isStickyNeeded = elHeight <= scrHeight ? true : false;
  /* console.log(`elementHeight: ${elHeight},\nscreenHeight; ${scrHeight}\nisStickyNeeded? .. ${isStickyNeeded}`); */
  return isStickyNeeded;
}