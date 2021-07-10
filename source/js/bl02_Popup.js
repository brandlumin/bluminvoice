/**
 *      POPUP MESSAGE FUNCTION TO NOTIFY USERS
 *      @param  {String} message THE MESSAGE TO DISPLAY
 *      @param  {Integer} stayDur THE DURATION TO STAY/"sticky"
 *      @param  {Interger} speed   SPEED OF TRANSITION
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
      overflow: "auto",
    },

    alertBox = $("<div/>", { "id": "alertBox" }).appendTo("body").css(alertBoxStyles).hide(),

    msgBox = $("<div/>", { "class": "text-dark text-center", "id": "msgBox" }).appendTo(alertBox).css(msgBoxStyles).hide();
  speed = speed || 500;

  /* SETTING UP THE MESSAGE */
  (message) && msgBox.html(message);


  /* FUNCTION: BRINGING IN THE POPUP */
  function inPop(speed) {
    alertBox.fadeToggle(speed);
    msgBox.fadeToggle(speed * 1.5);
  }

  /* FUNCTION: TAKING OUT THE POPUP */
  function outPop(speed) {
    msgBox.fadeToggle(speed * 0.5);
    alertBox.fadeToggle(speed, function () { this.remove(); });
  }

  function stickyPopupEventListener(event) { /* EVENTLISTENER: click anywhere to dismiss */
    if (event.target != alertBox.get(0) && event.target != msgBox.get(0)) {
      outPop(speed);
      document.removeEventListener("click", stickyPopupEventListener);
    }
  }

  /* ACTION: BRINGING IN THE POPUP */
  inPop(speed);
  /* ACTION: STAYING FOR DURATION AND TAKING OUT THE POPUP*/
  if (stayDur === "sticky") document.addEventListener("click", stickyPopupEventListener);
  else setTimeout(function () { outPop(speed); }, stayDur || 2000);
}