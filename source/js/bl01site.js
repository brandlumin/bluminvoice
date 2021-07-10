/**
 *    DOCUMENT READY FUNCTION RUNS AT THE PAGELOAD
 */
jQuery(function ($) {
  $("[role=main").css({ marginTop: $("header").outerHeight() });
  let pgTitle = document.title;
  if (!(/^login/i).test(pgTitle) && !(/^register/i).test(pgTitle)) {
    fNavDeactive();
    fEnableToggler();
    if ((/^home/i).test(pgTitle) || (/^cmf/i).test(pgTitle) || (/^amf/i).test(pgTitle)) {
      if ($("#form-amf-usecustaddr").length) fInitialFunctions();
    }
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
 */
$(window).resize(() => {
  let pgTitle = $(document).attr('title');

  if (!/^login/i.test(pgTitle) && !/^register/i.test(pgTitle)) {
    if (/^crf/i.test(pgTitle) || /^home/i.test(pgTitle)) {
      fCRFLiveSearchWidth();
    }

    if (/^imf/i.test(pgTitle)) {
      fIMFLiveSearchWidth();
    }
  }
});