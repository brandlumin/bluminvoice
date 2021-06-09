/**
 *    IMF LIVESEARCH-AJAX
 */
function fIMFLiveSearch() {
  /* extracted "input" event from "ON" */
  $("#form-imf-proj").on('keyup', function () {
    let cLiveSearchID = $(this).val();
    if (cLiveSearchID.length) {
      // run ajax call
      $.get('./imf-functions.php', { task: "QuickList", prjSearch: cLiveSearchID })
        .done(function (projects) {
          /* Display the returned projects in browser */
          $("#search-box").slideDown(300, "linear", function () {
            $("#search-list").html(projects);
          });
        });
    } else {
      /* hiding the dropdown upon emptying the search field */
      fHideIMFSearchBox();
    }
  });

  /* Set search input value on click of result item */
  $("#search-list").on("click", 'p', function (event) {

    /* CONTENT ZOOM POP-OUT */
    $("#form-imf-desc, #form-imf-narr, #form-imf-crfhistory, #form-imf-billing").css("cursor", "zoom-in").on("click", function (event) {
      event.preventDefault();
      /* $(this) works as caller */
      let thisElName = $(this)[0].name,
        thisElID = $(this),
        wTitle = $("label[for=" + thisElName + "]").text(),
        wContent = thisElID.val();

      $('#detailModal .modal-title').text(wTitle);
      $('#detailModal .modal-body').text((wContent.length) ? wContent : "-- empty --");
      if (thisElName.match(/billing/)) { $('#detailModal .modal-body').addClass("text-monospace").css('whiteSpace', 'pre'); } else { $('#detailModal .modal-body').removeClass("text-monospace").css('whiteSpace', 'pre-wrap'); }
      $('#detailModal').modal();
    });


    $("form [type=submit]").toggleEnDis("disable").removeClass("btn-outline-light");
    $("form input, form textarea").val("").not("#form-imf-proj").toggleRO("ro");
    $("#form-imf-proj").val(() => event.target.innerText);
    fHideIMFSearchBox();
    let nLiveSearchID = event.target.attributes[0].nodeValue;
    $.getJSON("./imf-functions.php", { task: "FullList", prjSearch: nLiveSearchID })
      .done(function (jsonPrjDetails) {
        /* SHOWING REEIVED DATA => console.log(jsonPrjDetails); */
        if (jsonPrjDetails) {
          /* printing all the keys */
          for (let aKey in jsonPrjDetails) {
            /* SHOWING ALL THE OBJECTS ONE-BY-ONE => console.log(aKey, ":", jsonPrjDetails[aKey]); */
            for (let bKey in jsonPrjDetails[aKey]) {
              /* SHOWING ALL THE KEYS ONLY => console.log(aKey + "." + bKey); */
              /* SHOWING ALL THE KEYS WITH VALUES => console.log(aKey + "." + bKey + ": " + jsonPrjDetails[aKey][bKey]); */
            }
          }
          /* ACTIVATE THE FORM */
          fIMFFormFill(jsonPrjDetails);
        }
      })
      .done(fHideIMFSearchBox);
  });
}

/**
 *    IMF LIVESEARCH--RESULT-BOX-WIDTH
 */
function fIMFLiveSearchWidth() {
  $("#search-box").css("width", getWidth => $("#form-imf-proj").closest('.input-group').outerWidth());
  $("button[type=reset]").on("click", function () {
    $("form [type=submit]").toggleEnDis("disable").removeClass("btn-outline-light");
    $("form input, form textarea").val("").not("#form-imf-proj").toggleRO("ro");
  });
}

/**
 *    IMF LIVESEARCH--HIDE-SEARCH-BOX
 *    @return {[type]} [description]
 */
function fHideIMFSearchBox() {
  /* hiding the dropdown upon emptying the search field */
  $("#search-box").slideUp(300, "linear", function () {
    $("#search-list").empty();
  });
}