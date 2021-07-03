/**
 *      POPUP MESSAGE FUNCTION TO NOTIFY USERS
 *      @param  {String} message THE MESSAGE TO DISPLAY
 *      @param  {Integer} stayDur THE DURATION TO STAY/"sticky"
 *      @param  {Interger} speed   SPEED OF TRANSITION
 *      @return {Boolean}         True
 */
function fPopup(message, stayDur, speed) {

  /* REMOVE ANY STUCK POPUP */
  !!($('#alertBox').length) && $('#alertBox').remove();

  /* VARIABLE DECLARATIONS */
  let alertBoxStyles = {
      top: "50%",
      left: "50%",
      zIndex: "3",
      minWidth: "300px",
      minHeight: "170px",
      maxWidth: "750px",
      maxHeight: "400px",
      position: "absolute",
      padding: "25px 50px",
      borderRadius: "0.25rem",
      border: "10px solid white",
      backgroundColor: "#ffc107",
      boxShadow: "0 0.5rem 1.5rem rgba(0,0,0,.2)",
      transform: "translate(-50%,-50%)",
      justifyContent: "center",
      alignItems: "center",
      display: "flex",
      /* flex: "1", */
    },

    msgBoxStyles = {
      maxWidth: "450px",
      maxHeight: "253px",
      overflow: "auto"
    },

    alertBox = $("<div/>", { id: "alertBox" }).appendTo("body").css(alertBoxStyles).hide(),

    msgBox = $("<div/>", { class: "text-dark text-center", id: "msgBox" }).appendTo(alertBox).css(msgBoxStyles).hide();
  speed = speed || 500;

  /* SETTING UP THE MESSAGE */
  (message) && msgBox.html(message);

  /* FUNCTION: BRINGING IN THE POPUP */
  function inPop(speed) {
    alertBox.animate({ opacity: "toggle" }, speed);
    msgBox.animate({ opacity: "toggle" }, speed * 0.85);
    return alertBox;
  }

  /* FUNCTION: TAKING OUT THE POPUP */
  function outPop(speed) {
    msgBox.animate({ opacity: "toggle" }, speed * 0.85);
    alertBox.animate({ opacity: "toggle" }, speed);
    return alertBox;
  }

  /* ACTION: BRINGING IN THE POPUP */
  inPop(speed);
  /* ACTION: STAYING FOR DURATION AND TAKING OUT THE POPUP*/
  (stayDur !== "sticky") && setTimeout(function () { outPop(speed).remove(); }, stayDur || 2000);
  (stayDur === "sticky") && $(document).click(() => outPop(500).remove()); /* click anywhere to dismiss */
}