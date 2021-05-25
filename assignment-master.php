    <title>PMF : bluminvoice</title>
    <?php @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="container bl__home_pmf">
        <div class="row">
          <div class="col">
            <form class="needs-validation p-4" accept-charset="UTF-8" action="./pmf_page.php" method="post" id="form-pmf" name="form-pmf" novalidate>
              <h3 class="text-center mb-4 text-white font-weight-bold">Assignment Master Form</h3>
              <div class="row">
                <!-- CUSTOMER -->
                <div class="form-group col-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-accm">Customer:</label>
                    </div>
                    <!-- SOURCE: Here is the URL: https://www.lisenme.com/dynamic-dependent-select-box-using-jquery-ajax-php/ -->
                    <select class="custom-select" id="form-pmf-cust" name="form-pmf-cust" required aria-describedby="form-pmf-cust-help" required>
                      <?php @include "consql.php";
                        // get all the customers
                        $custList = mysqli_query($connection, "SELECT `custID`, `custName` FROM `customerMaster` ORDER BY `custName` ASC");
                        // get invoiceCount for later Use
                        $projList = mysqli_query($connection, "SELECT DISTINCT `prjID` FROM `assgMaster`");

                        $projNewSerial = mysqli_num_rows($projList) + 62; // this '62' is starting of this year
                        // Closing DB connection
                        mysqli_close($connection);
                        
                        // populating the data into options
                        if(mysqli_num_rows($custList) > 0 ) {
                          echo "<option value='' selected>Select the Customer...</option>";
                          while($row=mysqli_fetch_array($custList)) {
                            echo "<option value=$row[custID]>$row[custName]</option>";
                          }
                        } else {
                          echo "<option value='' disabled selected>Customer not found in the system.</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <small id="form-pmf-cust-help" class="form-text text-muted text-right">Select the Customer.</small>
                </div>
              </div>
              <div class="row">
                <!-- MANAGER -->
                <div class="form-group col-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-accm">Manager:</label>
                    </div>
                    <select class="custom-select" id="form-pmf-accm" name="form-pmf-accm" required aria-describedby="form-pmf-accm-help" required>
                      <option value='' disabled selected>Select the Account Manager...</option>
                    </select>
                  </div>
                  <small id="form-pmf-accm-help" class="form-text text-muted text-right">Select the Account Manager or Project SPOC.</small>
                </div>
              </div>
              <div class="row">
                <!-- PROJECT -->
                <div class="form-group mb-1 mb-md-auto col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-name">Project:</label>
                    </div>
                    <input type="text" class="form-control" id="form-pmf-name" name="form-pmf-name" required placeholder="Project's Name*" />
                  </div>
                </div>
                <!-- INVOICE NUMBER -->
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-invoice">Invoice#</label>
                    </div>
                    <input type="text" class="form-control" id="form-pmf-invoice" name="form-pmf-invoice" required readonly default="<?php echo $projNewSerial?>"/>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- DESCRIPTION -->
                <div class="form-group col-12 col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-desc">Description:</label>
                    </div>
                    <textarea class="form-control" id="form-pmf-desc" name="form-pmf-desc" rows="6" placeholder="Project Description" style="resize: none"></textarea>
                  </div>
                </div>
                <!-- NARRATION -->
                <div class="form-group col-12 col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-narr">Narration:</label>
                    </div>
                    <textarea class="form-control" id="form-pmf-narr" name="form-pmf-narr" rows="6" placeholder="Internal Narration" style="resize: none"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- START DATE -->
                <div class="form-group mb-1 mb-md-auto col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-start-date">Start Date:</label>
                    </div>
                    <input type="date" class="form-control" id="form-pmf-start-date" name="form-pmf-start-date" required value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>"/>
                  </div>
                </div>
                <!-- Quoted Amount -->
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-quote">Quoted (&#8377;)</label>
                    </div>
                    <input type="text" class="form-control" id="form-pmf-quote" name="form-pmf-quote" placeholder="Project cost*" required pattern="\d+\.{0,1}\d{0,2}" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-success shadow-sm-dark no-shadow-hover float-right">
                      Create
                    </button>
                    <button type="reset" class="btn btn-info shadow-sm-dark no-shadow-hover mr-3 float-right">
                      Reset
                    </button>
                  <!-- </div> -->
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php
        /**
         *    This captures the response sent back from pmf_page.php
         *    and displays the success or failure result accordingly.
         */
          if (isset($_GET["success"])) {
            $opStatus = "<div class='alert alert-success alert-dismissible fade show position-absolute center-vertical' role='alert'>Project ". ( ( isset($_GET["ID"]) && !empty($_GET["ID"]) ) ? "<b>[</b><span class=text-primary>" . $_GET["ID"] ."</span><b>]</b> " : '') ."has been added.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          } elseif (isset($_GET["error"])) {
            $opStatus = "<div class='alert alert-danger alert-dismissible fade show position-absolute center-vertical' role='alert'><b>Error encountered:</b> " . $_GET["error"] . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          }
          if (isset($opStatus)) {echo $opStatus; unset($opStatus);}
        ?>
      </section>
    </main>
    <?php @include_once "footer.html" ?>
