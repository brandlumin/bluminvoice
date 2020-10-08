/**
 *    Called by .disAttr(action="toggle, enable, disable")
 *    Function to SCREEN through the GIVEN elements, and 
 *    TOGGLE the DISABLED attribute ONLY for the ALLOWED 
 *    BUTTON, INPUT and TEXTAREA tags.
 *    @param  {String} action [description]
 *    @return {object}        [description]
 */
jQuery.prototype.disAttr = function (action = "toggle") {
  return this.filter("button, input, textarea").each(function () {
    let providedEl = $(this);
    // providedEl.text("TARGETTED"); TESTING PURPOSE
    if (action === "enable") providedEl.removeAttr("disabled");
    if (action === "disable") providedEl.attr("disabled", "disabled");
    if (action === "toggle") {
      if (providedEl.attr("disabled")) { providedEl.removeAttr("disabled"); } else { providedEl.attr("disabled", "disabled"); }
    }
  });
};