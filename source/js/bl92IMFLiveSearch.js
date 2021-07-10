/**
 *    IMF LIVESEARCH-AJAX
 */
function fIMFLiveSearch() {

  const $page = new IMFAPRpageObject("#search-box", "#search-list", "imf");

  /* extracted "input" event from "ON" */
  $page.$_project.off("keyup").on("keyup", function () {
    let cLiveSearchID = $(this).val();
    if (cLiveSearchID.length) {
      /* run ajax call */
      $.getJSON({ url: './imf-functions.php', beforeSend: fSpinner, complete: fSpinner }, { task: "QuickList", prjSearch: cLiveSearchID })
        .done(function (jsonProjNameSearchIMF) {
          /* Disabling CONTENT ZOOM POP-OUT */
          $page.$_form.find("#form-imf-desc, #form-imf-narr, #form-imf-crfhistory, #form-imf-billing").css("cursor", "auto").off("click");
          /* Display the returned projects in browser */
          $page.$_searchBox.slideDown(300, "linear", function () {
            $page.$_searchList.html(jsonProjNameSearchIMF);
          });
        });
    } else {
      /* hiding the dropdown upon emptying the search field */
      fIMFHideSearchBox($page);
    }
  });

  /* Set search input value on click of result item */
  $page.$_searchList.off("click").on("click", 'p', function (event) {

    let nLiveSearchID = event.target.attributes[0].nodeValue;
    $.getJSON({ url: "./imf-functions.php", beforeSend: beforeSendCleanup, complete: fSpinner }, { task: "FullList", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetailsIMF) {
        if (jsonPrjDetailsIMF.hasOwnProperty('fullPrjInv')) {
          fIMFFormFill(jsonPrjDetailsIMF, $page); /* ACTIVATE THE FORM */
        } else {
          fPopup("<strong>:: SYSTEM ERROR ::</strong><br/> Please ensure a working internet connection.<br />If that is working fine and you continue to receive this error then please report it.", "sticky");
        }
      });

    function beforeSendCleanup() {
      fSpinner();
      $("form [type=submit]").toggleEnDis("disable").removeClass("btn-outline-light");
      $("form input, form textarea").val("").removeClass("text-danger").removeAttr("min").not($page.$_project).toggleRO("ro");
      $page.$_project.val(() => event.target.innerText);
      fIMFHideSearchBox($page);
    }
  });
}

/**
 *    IMF LIVESEARCH--HIDE-SEARCH-BOX
 *    @return {[type]} [description]
 */
function fIMFHideSearchBox($page) {

  /* hiding the dropdown upon emptying the search field */
  $page.$_searchBox.slideUp(300, "linear", function () {
    $page.$_searchList.empty();
  });
}

/**
 *    IMF LIVESEARCH--RESULT-BOX-WIDTH
 */
function fIMFLiveSearchWidth() {
  let $_form = $("form"),
    $_searchBox = $("#search-box", $_form),
    $_project = $("#form-imf-proj", $_form);
  $_searchBox.css("width", getWidth => $_project.closest('.input-group').outerWidth());
  /* SETTING THE RESET BUTTON'S FUNCTIONALITY HERE JUST BECUASE OF AALAS */
  $("form button[type='reset']").off("click").on("click", function () {
    $("form [type='submit']").toggleEnDis("disable").removeClass("btn-outline-light");
    $("form input, form textarea").val("").removeClass("text-danger").removeAttr("min").not($_project).toggleRO("ro");
  });
}