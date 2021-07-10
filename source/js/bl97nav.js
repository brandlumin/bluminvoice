/**
 *    Disables current page link in the navbar
 */
function fNavDeactive() {
  let pgTitle = document.title,
    seq;
  if ((/^CMF/i).test(pgTitle)) seq = 0;
  else if ((/^AMF/i).test(pgTitle)) seq = 1;
  else if ((/^PMF/i).test(pgTitle)) seq = 2;
  else if ((/^CRF/i).test(pgTitle)) seq = 3;
  else if ((/^IMF/i).test(pgTitle)) seq = 4;
  else if ((/^APR/i).test(pgTitle)) seq = 5;

  let oEl = $("header ul.list-unstyled li").eq(seq).find('a');
  $("</p>")
    .html($(oEl).html())
    .addClass("text-warning")
    .insertAfter(oEl);
  oEl.remove();
}