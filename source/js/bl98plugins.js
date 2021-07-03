/**
 *    Called by .toggleEnDis(action="toggle, enable, disable")
 *    Function to SCREEN through the GIVEN elements, and 
 *    TOGGLE the DISABLED attribute ONLY for the ALLOWED 
 *    BUTTON, INPUT and TEXTAREA tags.
 *    @param  {String} action [description]
 *    @return {object}        [description]
 */
jQuery.prototype.toggleEnDis = function (action = "toggle") {
  return this.filter("button, input, textarea").each(function () {
    let providedEl = $(this);
    /* providedEl.text("TARGETTED"); TESTING PURPOSE */
    if (action === "enable") providedEl.removeAttr("disabled");
    if (action === "disable") providedEl.attr("disabled", "disabled");
    if (action === "toggle") {
      if (providedEl.attr("disabled")) { providedEl.removeAttr("disabled"); } else { providedEl.attr("disabled", "disabled"); }
    }
  });
};



/**
 *    Called by .toggleRO(action="toggle, ro, rw")
 *    Function to SCREEN through the GIVEN elements, and 
 *    TOGGLE the READONLY attribute ONLY for the ALLOWED 
 *    INPUT and TEXTAREA tags.
 *    @param  {String} action [description]
 *    @return {object}        [description]
 */
jQuery.prototype.toggleRO = function (action = "toggle") {
  return this.filter("input, textarea").each(function () {
    let providedEl = $(this);
    /* providedEl.text("TARGETTED"); TESTING PURPOSE */
    if (action === "ro") providedEl.attr("readonly", "readonly");
    if (action === "rw") providedEl.removeAttr("readonly");
    if (action === "toggle") {
      if (providedEl.attr("readonly")) { providedEl.removeAttr("readonly"); } else { providedEl.attr("readonly", "readonly"); }
    }
  });
};