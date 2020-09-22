window.addEventListener("load", showScreenSize, false);
window.addEventListener("resize", showScreenSize, true);

/**
 *    DOCUMENT READY FUNCTION RUNS AT THE PAGELOAD
 *    @return {Boolean}   default
 */
<<<<<<< HEAD
(function ($) {})(jQuery);
=======
$(document).ready(function() {
  showScreenSize(); // shows the screen-dimension on-screen
  $("body").css( "padding-top" , $("header").height() ); // setting the header display right
  if ( $("#login").length ) loginPageDisplay(); // setting the login page display
  if ( $(".bl__crf_crf").length ) crfPageDisplay(); // setting the CRF page display
});

/**
 *    WINDOW RESIZE FUNCTION RUNS WHEN WINDOW'S SIZE CHANGES
 *    @param  {function}   does the magic
 */
$(window).resize( () => {
  showScreenSize(); // shows the screen-dimension on-screen
  $("body").css( "padding-top" , $("header").height() );
  if ( $("#login").length ) loginPageDisplay();
  if ( $(".bl__crf_crf").length ) crfPageDisplay(); // setting the CRF page display
} );


function loginPageDisplay() {
  $("html, body").css("height", "100%");
  $("#login section").css("height", ()=> $("body").height() -  $("footer").height());
}

function crfPageDisplay() {
  if ( ifHeightNeeded( parseInt($("footer").css("margin-top")) + parseInt($("body").css("padding-top")), 0, $('main') ) ) {
    $("footer").addClass("sticky-footer");
  } else {
    $("footer").removeClass("sticky-footer");
  } 
}

function ifHeightNeeded(anyAddlHeight, isNeeded, el= $(window).height()) {
  let scrWidth = $(window).width(),
  scrHeight = $(window).height(),
  elHeight = el.height() + (anyAddlHeight || 0);
  // console.log(`elHeight: ${elHeight}, scrHeight; ${scrHeight}`);
  isNeeded = ( elHeight <= scrHeight ) ? true : false ;
  return isNeeded;
}

/**
 *    DISPLAY VIWEPORT CONSISTENTLY
 *    @return {default}
 */
function showScreenSize() {
  if ( !$("#blSizeWindow").length ) $("<div/>",{
      id    :"blSizeWindow",
      class : "px-3 py-1 small"
    })
    .css({
      position        : "fixed",
      bottom          : "10px",
      right           : "10px",
      backgroundColor : "rgba(255,255,255,.6)",
      border          : "solid 1px rgba(255,255,255,1)",
      boxShadow       : "0 2px 6px rgba(0,0,0,.4)",
      color           : "#333",
      zIndex          : "2000"
    })
    .appendTo("body");
  
  $("#blSizeWindow").text(()=> $(window).outerWidth() + " x " + $(window).outerHeight());
}
>>>>>>> 0ed8f76674f8935305c22582bd2552a0b1980e1e
