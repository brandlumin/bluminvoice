    <title>AMF : bluminvoice</title>
    <?php @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="container bl__home_amf">
        <div class="row">
          <div class="col">
            <form class="needs-validation p-4" accept-charset="UTF-8" action="./amf_page.php" method="post" id="form-amf" name="form-amf" autocomplete="off" novalidate>
              <h3 class="text-center mb-4 text-white font-weight-bold">Accounts Master Form</h3>
              <div class="form-row">
                <!-- CUSTOMER -->
                <div class="form-group col-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-cust">Customer:</label>
                    </div>
                    <select class="custom-select" id="form-amf-cust" name="form-amf-cust" required aria-describedby="form-amf-cust-help" required autofocus="">
                      <?php
                        @include "consql.php";
                        /* Customer List for the Dropdown */
                        $custListQuery = "SELECT `custID`, `custName` FROM `customerMaster` ORDER BY `custName` ASC";
                        $custList = mysqli_query($connection, $custListQuery);
                        /* Account Managers List for the listing */
                        $accListQuery = "SELECT accountMaster.accName, customerMaster.custName FROM accountMaster, customerMaster WHERE accountMaster.custID = customerMaster.custID ORDER BY `custName` ASC";
                        $accList = mysqli_query($connection, $accListQuery);
                        /* Closing the connection */
                        mysqli_close($connection);
                        if(mysqli_num_rows($custList) > 0 ) {
                          $custOptions = "<option value='' selected>Choose Customer...</option>";
                          while($row=mysqli_fetch_array($custList)) {
                            $custOptions = $custOptions . "<option value='" . $row["custID"] . "'>" . $row["custName"] . "</option>";
                          }
                        } else {
                          $custOptions = "<option disabled value='0' selected>Customer not found in the system.</option>";
                        }
                        echo $custOptions;
                      ?>
                    </select>
                  </div>
                  <small id="form-amf-cust-help" class="form-text text-muted text-right">Select the customer.</small>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-7">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-name">Manager:</label>
                    </div>
                    <input class="form-control" id="form-amf-name" name="form-amf-name" required placeholder="Account Person's Name*" pattern="[\s\w]+" />
                  </div>
                </div>
                <div class="form-group col-md-5">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-desig">Designation:</label>
                    </div>
                    <input class="form-control" id="form-amf-desig" name="form-amf-desig" required placeholder="Designation*" pattern="[\w\s.)(-]+" />
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col mb-2">
                  <div class="custom-control custom-switch text-center">
                    <span class="mr-5 pr-2 text-light" pointer onclick="$(this).siblings('input').click()">Use Separate Address</span>
                    <input type="checkbox" class="custom-control-input" id="form-amf-usecustaddr" name="form-amf-usecustaddr" checked="checked">
                    <label class="custom-control-label" for="form-amf-usecustaddr" pointer>Use Customer's Address</label>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-12">
                  <div class="input-group d-flex">
                    <div class="">
                      <label class="input-group-text bg-warning text-body h-100" for="form-amf-addr1">Billing<br/>Address:</label>
                    </div>
                    <div class="flex-grow-1">
                      <input class="form-control mb-1" id="form-amf-addr1" name="form-amf-addr1" required placeholder="Address 1*" />
                      <input class="form-control mb-1" id="form-amf-addr2" name="form-amf-addr2" required placeholder="Address 2*" />
                      <input class="form-control" id="form-amf-addr3" name="form-amf-addr3" placeholder="Address 3" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row align-items-center">
                <div class="form-group mb-1 mb-md-auto col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-city">City:</label>
                    </div>
                    <input class="form-control" id="form-amf-city" name="form-amf-city" placeholder="City*" required />
                  </div>
                </div>
                <div class="form-group mb-1 mb-md-auto col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-state">State:</label>
                    </div>
                    <input class="form-control" id="form-amf-state" name="form-amf-state" placeholder="State*" required />
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-pin">PIN:</label>
                    </div>
                    <input class="form-control" id="form-amf-pin" name="form-amf-pin" placeholder="PIN*" pattern="\d{6}" required />
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-phones">Phone(s):</label>
                    </div>
                    <input class="form-control" id="form-amf-phones" name="form-amf-phones" required placeholder="7767844772,02212345678*" pattern="([\d]{10,11}[,]?([\d]{10,11})?)+" />
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-email">Email:</label>
                    </div>
                    <input class="form-control" id="form-amf-email" name="form-amf-email" required placeholder="Email address*" pattern="^[a-z0-9.+_-]+@[a-z0-9-]+(?:\.[a-z]{2,})$" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <hr class="bl-seperator">
                  <a class="btn btn-secondary no-shadow-hover" id="toggleBtn">Show List</a>
                  <button type="submit" class="btn btn-success no-shadow-hover float-right">Create</button>
                  <button type="reset" class="btn btn-primary no-shadow-hover mr-3 float-right">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php
        /**
         *    This captures the response sent back from amf_page.php
         *    and displays the success or failure result accordingly.
         */
          if (isset($_GET["success"])) {
            $opStatus = "<div class='alert alert-success alert-dismissible fade show position-absolute center-vertical' role='alert'>Account Manager has been added.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          } elseif (isset($_GET["error"])) {
            $opStatus = "<div class='alert alert-danger alert-dismissible fade show position-absolute center-vertical' role='alert'><b>Error encountered:</b> " . $_GET["error"] . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          }
          if (isset($opStatus)) {echo $opStatus; unset($opStatus);}
        ?>
      </section>
      <section class="container bl__home_amf-list d-none" id="toggleItem">
        <div class="row">
          <div class="col">
            <h4 name="subtitle">List of Account Managers</h4>
            <div class="d-flex flex-row justify-content-between flex-wrap list">
              <!-- p-2 mb-2 bg-secondary text-white -->
              <?php
                /* @include "consql.php"; */
                /* $accListQuery = "SELECT accountMaster.accName, customerMaster.custName FROM accountMaster, customerMaster WHERE accountMaster.custID = customerMaster.custID ORDER BY `custName` ASC"; */
                /* $accList = mysqli_query($connection, $accListQuery); */
                /* mysqli_close($connection); */
                if(mysqli_num_rows($accList) > 0 ) {
                  while($row=mysqli_fetch_assoc($accList)) {
                    echo "<div class='p-2 small'>".$row['accName']." (".$row['custName'].")</div>";
                 }
                } else {
                  echo "Account Manager not found in the system.";
                }
              ?>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php @include_once "footer.html" ?>