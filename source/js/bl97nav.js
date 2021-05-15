/**
 *    [fNavActive description]
 *    Disables current page link in the navbar
 */
function fNavDeactive() {
  let pageTitle, seq;
  pageTitle = $("h3.font-weight-bold").text().replace(/\sform$/i, "").replace(/\s/i, "-").toLowerCase();
  if (pageTitle == "customer-master") seq = 0;
  if (pageTitle == "accounts-master") seq = 1;
  if (pageTitle == "assignment-master") seq = 2;
  if (pageTitle == "change-request" && !($(".jumbotron").length)) seq = 3;
  if (pageTitle == "invoice-master") seq = 4;
  if (seq >= 0 && seq <= 4) $("header ul.list-unstyled li").eq(seq).find('a').attr("class", "text-info").removeAttr("href");
}