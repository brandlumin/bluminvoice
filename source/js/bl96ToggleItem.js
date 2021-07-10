/**
 *    Toggles the #toggleItem on the page AND
 *    Changes the text on the #toggleBtn
 */
function fEnableToggler() {
  let $_form = $("form");
  $_form.find("#toggleBtn").click(function () {
    let theList = $("section#toggleItem", "body"),
      buttonText = (theList.hasClass("d-none")) ? $_form.find("#toggleBtn").text("Hide List") : $_form.find("#toggleBtn").text("Show List"); /* change the button-text */
    theList.toggleClass("d-none"); /* toggle the item */
  });
}