/**
 *    Disables current page link in the navbar
 */
function fNavDeactive() {
  let pgTitle = document.title,
    seq;
  if ((/^CMF/i).test(pgTitle)) seq = 0;
  if ((/^AMF/i).test(pgTitle)) seq = 1;
  if ((/^PMF/i).test(pgTitle)) seq = 2;
  if ((/^CRF/i).test(pgTitle)) seq = 3;
  if ((/^IMF/i).test(pgTitle)) seq = 4;

  let oEl = $("header ul.list-unstyled li").eq(seq).find('a');
  $("</p>").html($(oEl).html()).addClass("text-warning").insertAfter(oEl);
  oEl.remove();
}