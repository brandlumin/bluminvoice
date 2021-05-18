window.addEventListener("load", showScreenSize, false);
window.addEventListener("resize", showScreenSize, true);

/**
 *    DOCUMENT READY FUNCTION RUNS AT THE PAGELOAD
 *    @return {Boolean}   default
 */
jQuery(function ($) {
  let pgTitle = $(document).attr('title');
  console.log(pgTitle);
  fAlert("DOM Ready", 30);
  fNavDeactive();
  fEnableToggler();
  if ((/^pmf/i).test(pgTitle)) {
    fPMFpageAJAX();
    fPMFInvoiceNo();
  }
  if ((/^crf/i).test(pgTitle)) {
    fCRFLiveSearchWidth();
    fCRFLiveSearch();
  }
  /*if ((/^imf/i).test(pgTitle)) {
    fIMFLiveSearchWidth();
    fIMFLiveSearch();
  }*/
});

/**
 *    WINDOW RESIZE FUNCTION RUNS WHEN WINDOW'S SIZE CHANGES
 *    @param  {function}   does the magic
 */
$(window).resize(() => {
  let pgTitle = $(document).attr('title');
  if ((/^crf/i).test(pgTitle)) {
    fCRFLiveSearchWidth();
  }
  /*if ((/^imf/i).test(pgTitle)) {
  fIMFLiveSearchWidth();
  fIMFLiveSearch();
}*/
});