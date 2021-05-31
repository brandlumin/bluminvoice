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

TABLE STRUCTURES

assgMaster;
+---------------+---------------+------+-----+-------------------+-------------------+
| Field         | Type          | Null | Key | Default           | Extra             |
+---------------+---------------+------+-----+-------------------+-------------------+
| custID        | int           | NO   |     | NULL              |                   |
| accID         | int           | NO   |     | NULL              |                   |
| prjID         | int           | NO   | PRI | NULL              |                   |
| prjName       | varchar(255)  | NO   |     | NULL              |                   |
| prjDesc       | text          | YES  |     | NULL              |                   |
| prjNarr       | text          | YES  |     | NULL              |                   |
| prjStartDate  | date          | NO   |     | NULL              |                   |
| prjEndDate    | date          | YES  |     | NULL              |                   |
| prjCostQuoted | decimal(10,2) | NO   |     | NULL              |                   |
| prjInvoiceID  | varchar(10)   | NO   |     | NULL              |                   |
| isInvoiced    | bit(1)        | NO   |     | b'0'              |                   |
| prjCreate     | timestamp     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
+---------------+---------------+------+-----+-------------------+-------------------+


customerMaster;
+------------+--------------+------+-----+-------------------+-------------------+
| Field      | Type         | Null | Key | Default           | Extra             |
+------------+--------------+------+-----+-------------------+-------------------+
| custID     | int          | NO   | PRI | NULL              | auto_increment    |
| custCreate | timestamp    | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
| custName   | varchar(255) | NO   | MUL | NULL              |                   |
| custAddr1  | varchar(255) | NO   |     | NULL              |                   |
| custAddr2  | varchar(255) | NO   |     | NULL              |                   |
| custAddr3  | varchar(255) | YES  |     | NULL              |                   |
| custCity   | varchar(50)  | NO   |     | NULL              |                   |
| custState  | varchar(50)  | NO   |     | NULL              |                   |
| custPin    | varchar(10)  | NO   |     | NULL              |                   |
| custGSTIN  | varchar(20)  | NO   |     | NULL              |                   |
| custType   | varchar(10)  | NO   |     | NULL              |                   |
+------------+--------------+------+-----+-------------------+-------------------+


changeMaster;
+--------------+---------------+------+-----+-------------------+-------------------+
| Field        | Type          | Null | Key | Default           | Extra             |
+--------------+---------------+------+-----+-------------------+-------------------+
| custID       | int           | NO   |     | NULL              |                   |
| prjID        | int           | NO   |     | NULL              |                   |
| changeID     | int           | NO   | PRI | NULL              | auto_increment    |
| changeReq    | text          | NO   |     | NULL              |                   |
| changeDate   | date          | NO   |     | NULL              |                   |
| changeAmount | decimal(10,2) | NO   |     | NULL              |                   |
| changeCreate | timestamp     | NO   |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
+--------------+---------------+------+-----+-------------------+-------------------+


invoiceMaster;
+----------------+---------------+------+-----+---------+-------+
| Field          | Type          | Null | Key | Default | Extra |
+----------------+---------------+------+-----+---------+-------+
| prjID          | int           | NO   | PRI | NULL    |       |
| invDate        | date          | NO   |     | NULL    |       |
| prjTotalBill   | decimal(10,2) | NO   |     | NULL    |       |
| cgst           | decimal(10,2) | YES  |     | NULL    |       |
| sgst           | decimal(10,2) | YES  |     | NULL    |       |
| igst           | decimal(10,2) | YES  |     | NULL    |       |
| prjGrandTotal  | decimal(10,2) | NO   |     | NULL    |       |
| prjBillDetails | text          | YES  |     | NULL    |       |
| isPaid         | bit(1)        | NO   |     | b'0'    |       |
| prjPaidDate    | date          | YES  |     | NULL    |       |
+----------------+---------------+------+-----+---------+-------+
------------------------------------------

NOTES:
---------

IDEA:
SET group_concat_max_len = 2048;
SELECT person_id, 
       GROUP_CONCAT(hobbies ORDER BY hobbies ASC SEPARATOR ', ')
FROM peoples_hobbies
GROUP BY person_id;


OLD:
SELECT A.prjName PROJECT, A.prjInvoiceID INVOICE, B.custName CUSTOMER, C.accName MANAGER, A.prjStartDate STARTED, A.prjEndDate ENDED, A.isInvoiced, A.prjDesc DESCRIPTION, A.prjNarr NARRATION, A.prjCostQuoted QUOTED, B.custType FROM assgMaster A JOIN customerMaster B USING (custID) JOIN accountMaster C USING (accID) WHERE prjID =


NEW:
SELECT 
A.prjID, A.prjName PROJECT, A.prjInvoiceID INVOICE, B.custName CUSTOMER, C.accName MANAGER, 
A.prjStartDate STARTED, A.prjEndDate ENDED, A.isInvoiced, A.prjDesc DESCRIPTION, 
A.prjNarr NARRATION, A.prjCostQuoted QUOTED, B.custType,
D.invDate, D.prjTotalBill TOTAL, D.prjBillDetails BILLING
FROM assgMaster A 
JOIN customerMaster B 
USING (custID) 
JOIN accountMaster C 
USING (accID) 
LEFT JOIN invoiceMaster D 
USING (prjID)
WHERE prjID = 67