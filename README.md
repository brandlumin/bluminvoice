# bluminvoice
It is a custom 'personal' project for internal use.

CREATE TABLE `blvoice`.`customerMaster` ( 
                                         `custCreate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                                         `custName` VARCHAR(255) NOT NULL , 
                                         `custAddr1` VARCHAR(255) NOT NULL , 
                                         `custAddr2` VARCHAR(255) NOT NULL , 
                                         `custAddr3` VARCHAR(255) NULL , 
                                         `custCity` VARCHAR(50) NOT NULL , 
                                         `custSate` VARCHAR(50) NOT NULL , 
                                         `custPin` VARCHAR(10) NOT NULL , 
                                         `custGSTIN` VARCHAR(20) NOT NULL , 
                                         `custType` VARCHAR(10) NOT NULL COMMENT 'CGST or SGST' , 
                                         `custID` INT(3) NOT NULL AUTO_INCREMENT , 
                                         PRIMARY KEY (`custID`), 
                                         INDEX `CUSTOMERS` (`custName`)
) ENGINE = InnoDB;