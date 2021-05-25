<title>IMF : bluminvoice</title>
<?php @include_once "header.html" ?>
<main role="main" class="container flex-fill d-flex flex-column justify-content-center mt-4">
  <section class="container bl__home_imf">
    <div class="row">
      <div class="col">
        <?php
        /**
         *    This captures the response sent back from amf_page.php
         *    and displays the success or failure result accordingly.
         */
          if (isset($_GET["payment"])) {
            $opStatus = "<div class='alert alert-warning alert-dismissible fade show position-absolute center-vertical' role='alert'>Payment has been received successfully.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          } elseif (isset($_GET["generate"])) {
            $opStatus = "<div class='alert alert-success alert-dismissible fade show position-absolute center-vertical' role='alert'>Invoice has been generated successfully.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          } elseif (isset($_GET["error"])) {
            $opStatus = "<div class='alert alert-danger alert-dismissible fade show position-absolute center-vertical' role='alert'><b>Error encountered:</b> " . $_GET["error"] . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          }
          if (isset($opStatus)) {echo $opStatus; unset($opStatus);}
        ?>
        <form class="needs-validation p-4" accept-charset="UTF-8" action="./imf_page_register.php" method="post" id="form-imf" name="form-imf" novalidate>
          <h3 class="text-center mb-4 text-white font-weight-bold">Invoice Master Form</h3>
          <div class="form-row">
            <!-- Project -->
            <div class="form-group col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-proj">Project:</label>
                </div>
                <input type="text" class="form-control" id="form-imf-proj" name="form-imf-proj" placeholder="Project's Name*" autofocus />
                <div class="input-group-append">
                  <span class="input-group-text no-border bg-white text-shadow-sm">&#128269;</span>
                </div>
              </div>
              <!-- Search List -->
              <div id="search-box" class="search-box p-3 rounded-lg" style="display: none;">
                <h5 class="text-primary">Search Results</h5>
                <hr>
                <div id="search-list" class="search-list"></div>
              </div>
              <input name="form-imf-projID" placeholder="Project ID" HIDDEN/>
            </div>
            <!-- Invoice -->
            <div class="form-group col-md-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-invoice">Invoice#</label>
                </div>
                <input class="form-control" id="form-imf-invoice" name="form-imf-invoice" readonly="readonly" placeholder="Invoice#" />
              </div>
            </div>
          </div>
          <div class="form-row">
            <!-- Customer -->
            <div class="form-group col-md-7">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-cust">Customer:</label>
                </div>
                <input class="form-control" id="form-imf-cust" name="form-imf-cust" required readonly="readonly" placeholder="Customer Name*" />
              </div>
              <input name="form-imf-custID" placeholder="Customer ID" HIDDEN/>
            </div>
            <!-- Account Manager -->
            <div class="form-group col-md-5">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-acct">Manager:</label>
                </div>
                <input class="form-control" id="form-imf-acct" name="form-imf-acct" required readonly="readonly" placeholder="Account Manager Name*" />
                <!-- <select class="custom-select" id="form-imf-acct" name="form-imf-acct" required>
                  <option class="" value="" selected>Select the Account Manager...</option>
                  <option class="" value="5">CS Sapna Malhotra (Asst. Director)</option>
                </select> -->
              </div>
              <input name="form-imf-acctID" placeholder="Account Manager ID" HIDDEN/>
            </div>
          </div>
          <div class="row">
            <!-- Separators -->
            <div class="col">
              <hr class="m-0 border-light">
              <hr class="mt-0 mb-3 border-light">
            </div>
          </div>
          <div class="form-row">
            <!-- Start Date -->
            <div class="form-group col-md-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-dtstrt">Start Date:</label>
                </div>
                <input type="date" class="form-control" id="form-imf-dtstrt" name="form-imf-dtstrt" readonly="readonly"/>
              </div>
            </div>
            <!-- End Date -->
            <div class="form-group col-md-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-dtend">End Date:</label>
                </div>
                <input type="date" class="form-control" id="form-imf-dtend" name="form-imf-dtend" readonly="readonly"/>
              </div>
            </div>
            <!-- Payment Date -->
            <div class="form-group col-md-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-dtpay">Paid Date:</label>
                </div>
                <input type="date" class="form-control" id="form-imf-dtpay" name="form-imf-dtpay" readonly="readonly"/>
              </div>
            </div>
          </div>
          <div class="form-row">
            <!-- Description -->
            <div class="form-group col-md-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-desc">Description:</label>
                </div>
                <textarea class="form-control" id="form-imf-desc" name="form-imf-desc" rows="3" placeholder="Project Description" style="resize: none" readonly="readonly"></textarea>
              </div>
            </div>
            <!-- Narration -->
            <div class="form-group col-md-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-narr">Narration:</label>
                </div>
                <textarea class="form-control" id="form-imf-narr" name="form-imf-narr" rows="3" placeholder="Internal Narration" style="resize: none" readonly="readonly"></textarea>
              </div>
            </div>
          </div>
          <div class="form-row">
            <!-- Change Request History -->
            <div class="form-group col-12">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-crfhistory">Change Request History:</label>
                </div>
                <textarea class="form-control" id="form-imf-crfhistory" name="form-imf-crfhistory" rows="3" placeholder="CRF Details" style="resize: none" readonly="readonly"></textarea>
              </div>
            </div>
          </div>
          <div class="form-row">
            <!-- CRF Calculations -->
            <div class="form-group col-md-4">
              <div class="row">
                <div class="col-12 mb-2">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-qprice">Quoted:</label>
                    </div>
                    <input type="text" class="text-right pr-5 form-control text-monospace" id="form-imf-qprice" name="form-imf-qprice" readonly="readonly" required="required"/>
                  </div>
                </div>
                <div class="col-12 mb-2">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-crftotal">CRFs:</label>
                    </div>
                    <input type="text" class="text-right pr-5 form-control text-monospace" id="form-imf-crftotal" name="form-imf-crftotal" readonly="readonly"/>
                  </div>
                </div>
                <div class="col-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-total">Total:</label>
                    </div>
                    <input type="text" class="text-right pr-5 form-control text-monospace font-weight-bold" id="form-imf-total" name="form-imf-total" readonly="readonly" required="required"/>
                  </div>
                </div>
              </div>
            </div>
            <!-- Billing Details -->
            <div class="form-group col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-imf-billing">Billing Details:</label>
                </div>
                <textarea class="form-control text-monospace" id="form-imf-billing" name="form-imf-billing" rows="5" placeholder="Final Display" style="resize: none" readonly="readonly" required="required"></textarea>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-3"><input type="text" name="form-imf-cgst" placeholder="form-imf-cgst" HIDDEN/></div>
            <div class="col-3"><input type="text" name="form-imf-sgst" placeholder="form-imf-sgst" HIDDEN/></div>
            <div class="col-3"><input type="text" name="form-imf-igst" placeholder="form-imf-igst" HIDDEN/></div>
            <div class="col-3"><input type="text" name="form-imf-gtot" placeholder="form-imf-gtot" HIDDEN/></div>
          </div>
          <div class="row">
            <!-- Buttons -->
            <div class="col-12">
              <button type="submit" name="payment" class="btn btn-danger" formaction="./imf_page_payment.php" disabled="disabled">Receive Payment</button>
              <button type="submit" name="generate" class="btn btn-success float-right" disabled="disabled">Generate</button>
              <button type="reset" name="reset" class="btn btn-outline-light float-right mr-2" onclick="fResetForm();">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>
<?php @include_once "footer.html" ?>
