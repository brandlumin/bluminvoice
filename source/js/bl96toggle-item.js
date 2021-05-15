/**
 *    Toggles the #toggleItem on the page AND
 *    Changes the text on the #toggleBtn
 */
$('#toggleBtn').click(function () {
  // change the button-text
  if ($('#toggleItem').hasClass('d-none')) {
    $('#toggleBtn').text('Hide List');
  } else {
    $('#toggleBtn').text('Show List');
  }
  // toggle the item
  $('#toggleItem').toggleClass("d-none");
});