window.addEventListener("load", showScreenSize, false);
window.addEventListener("resize", showScreenSize, true);

/**
 *    DOCUMENT READY FUNCTION RUNS AT THE PAGELOAD
 *    @return {Boolean}   default
 */
jQuery(function ($) {
  fAlert("DOM Ready", 150);
  // $('<p/>', { class: 'text-success m-0' }).appendTo('header').text("Paragraph added by jQuery.");
});

/**
 *    WINDOW RESIZE FUNCTION RUNS WHEN WINDOW'S SIZE CHANGES
 *    @param  {function}   does the magic
 */
$(window).resize(() => {});