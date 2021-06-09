// window.addEventListener("load", showScreenSize, false);
// window.addEventListener("resize", showScreenSize, true);

/**
 *    DOCUMENT READY FUNCTION RUNS AT THE PAGELOAD
 *    @return {Boolean}   default
 */
jQuery(function ($) {
  $("[role=main").css({ marginTop: $("header").outerHeight() });
  let pgTitle = document.title;
  if (!(/^login/i).test(pgTitle) && !(/^register/i).test(pgTitle)) {
    fNavDeactive();
    fEnableToggler();
    if ((/^pmf/i).test(pgTitle)) {
      fPMFpageAJAX();
      fPMFInvoiceNo();
    }
    if ((/^crf/i).test(pgTitle) || (/^home/i).test(pgTitle)) {
      fCRFLiveSearchWidth();
      fCRFLiveSearch();
    }
    if ((/^imf/i).test(pgTitle)) {
      fIMFLiveSearchWidth();
      fIMFLiveSearch();
    }
    if ((/^apr/i).test(pgTitle)) {
      fAPRSetupRadios();
    }
  }
});

/**
 *    WINDOW RESIZE FUNCTION RUNS WHEN WINDOW'S SIZE CHANGES
 *    @param  {function}   does the magic
 */
$(window).resize(() => {
  let pgTitle = $(document).attr('title');
  if (!(/^login/i).test(pgTitle) && !(/^register/i).test(pgTitle)) {
    if ((/^crf/i).test(pgTitle) || (/^home/i).test(pgTitle)) {
      fCRFLiveSearchWidth();
    }
    if ((/^imf/i).test(pgTitle)) {
      fIMFLiveSearchWidth();
    }
  }
});