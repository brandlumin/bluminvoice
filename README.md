# bluminvoice
It is a custom 'personal' project for internal use.

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