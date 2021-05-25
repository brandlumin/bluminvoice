# bluminvoice
It is a custom 'personal' project for internal use.

RESOURCE:
How to call a specific function in a PHP script via Ajax?
https://stackoverflow.com/questions/6371857/how-to-call-a-specific-function-in-a-php-script-via-ajax

>> isInvoiced = FALSE,
  Disable the PAID_DATE, and -- done
  upon giving the END_DATE, enable the 'Generate' button. -- done
>> isInvoiced = TRUE && isPaid = FALSE,
  upon giving the PAID_DATE, enable the 'Receive Payment' button.

METHOD TO SHOW RECEIVED JSON DATA FROM PHP
------------------------------------------
console.log(prjDetails); // Proof that the returned object is encapsulated into an array here.
let jsonArrayedObject = $.parseJSON(prjDetails); // Parsing (or breaking) the array to access the object.
console.log(jsonArrayedObject); // Success! Able to see the object at the element number 0.
$(jsonArrayedObject).each(function (index, value) { // Iterate over array to access its elements.
  $.each(value, function (key, keyValue) { // Accessing the received object to get the values.
    console.log(key + " : " + keyValue); // use the values here.
  });
});

SELECT C.changeReq, C.changeDate, C.changeAmount, I.prjTotalBill, I.prjBillingDetails, I.prjPaidDate
FROM invoiceMaster I
INNER JOIN changeMaster C
ON I.prjID = C.prjID
WHERE I.prjID = 63
------------------------------------------