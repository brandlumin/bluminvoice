    <title>IMF : bluminvoice</title>
    <?php @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="container bl__home_imf">
        <div class="row">
          <div class="col">
            <form class="needs-validation p-4" accept-charset="UTF-8" action="./imf_page.php" method="post" id="form-imf" name="form-imf" novalidate>
              <h3 class="text-center mb-4 text-white font-weight-bold">Invoice Master Form</h3>
              <div class="form-row">
                <!-- Project -->
                <div class="form-group col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-project">Project:</label>
                    </div>
                    <input type="text" class="form-control" id="form-imf-project" name="form-imf-project" placeholder="Project's Name*" />
                  </div>
                  <!-- Search List -->
                  <div id="search-box" class="search-box p-3 rounded-lg" style="display: none;">
                    <h5 class="text-primary">Search Results</h5>
                    <hr>
                    <div id="search-list" class="search-list"></div>
                  </div>
                  <input name="form-imf-projectID" placeholder="Project ID" hidden />
                </div>
                <!-- Invoice -->
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-city">Invoice#</label>
                    </div>
                    <input class="form-control" id="form-imf-city" name="form-imf-city" disabled="disabled" placeholder="Invoice#" />
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
                    <input class="form-control" id="form-imf-cust" name="form-imf-cust" required readonly placeholder="Customer Name*" />
                  </div>
                  <input name="form-imf-custID" placeholder="Customer ID" hidden />
                </div>
                <!-- Account Manager -->
                <div class="form-group col-md-5">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-accm">Manager:</label>
                    </div>
                    <input class="form-control" id="form-imf-accm" name="form-imf-accm" required readonly placeholder="Account Manager Name*" />
                    <!-- <select class="custom-select" id="form-imf-accm" name="form-imf-accm" required>
                      <option class="" value="" selected>Select the Account Manager...</option>
                      <option class="" value="5">CS Sapna Malhotra (Asst. Director)</option>
                    </select> -->
                  </div>
                  <input name="form-imf-accmID" placeholder="Account Manager ID" hidden />
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
                    <input type="date" class="form-control" id="form-imf-dtstrt" name="form-imf-dtstrt" disabled="disabled" />
                  </div>
                </div>
                <!-- End Date -->
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-dtend">End Date:</label>
                    </div>
                    <input type="date" class="form-control" id="form-imf-dtend" name="form-imf-dtend" required value="<?php echo date('Y-m-d'); ?>" />
                  </div>
                </div>
                <!-- Payment Date -->
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-dtpay">Paid Date:</label>
                    </div>
                    <input type="date" class="form-control" id="form-imf-dtpay" name="form-imf-dtpay" disabled="disabled" />
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
                    <textarea class="form-control" id="form-imf-desc" name="form-imf-desc" rows="3" placeholder="Project Description" style="resize: none"></textarea>
                  </div>
                </div>
                <!-- Narration -->
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-narr">Narration:</label>
                    </div>
                    <textarea class="form-control" id="form-imf-narr" name="form-imf-narr" rows="3" placeholder="Internal Narration" style="resize: none"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- Billing Details -->
                <div class="form-group col">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-billing">Billing Details:</label>
                    </div>
                    <textarea class="form-control" id="form-imf-billing" name="form-imf-billing" rows="5" placeholder="Details*" style="resize: none" required="required"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- Buttons -->
                <div class="col-12">
                  <button type="submit" class="btn btn-danger shadow-sm-dark no-shadow-hover" disabled="disabled">Receive Payment</button>
                  <button type="submit" class="btn btn-success shadow-sm-dark no-shadow-hover float-right">Generate</button>
                  <button type="reset" class="btn btn-outline-light shadow-sm-dark no-shadow-hover float-right mr-2">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>
    <?php @include_once "footer.html" ?>
