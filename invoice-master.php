    <?php @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="container bl__home_imf">
        <div class="row">
          <div class="col">
            <form class="needs-validation p-4" accept-charset="UTF-8" action="./imf_page.php" method="post" id="form-imf" name="form-imf" novalidate>
              <h3 class="text-center mb-4 text-white font-weight-bold">Invoice Master Form</h3>
              <div class="form-row">
                <!-- Customer -->
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-accm">Customer:</label>
                    </div>
                    <select class="custom-select" id="form-imf-cust" name="form-imf-cust" required aria-describedby="form-imf-cust-help" required>
                      <option class="" value="" selected>Choose...</option>
                      <option class="" value="1">ICSI CCGRT</option>
                      <option class="" value="2">ICSI CERT</option>
                      <option class="" value="3">ICSI WIRC</option>
                      <option class="" value="4">Locate365</option>
                    </select>
                  </div>
                  <small id="form-imf-cust-help" class="form-text text-muted text-right">Select the customer.</small>
                </div>
                <!-- Account Manager -->
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-accm">Manager:</label>
                    </div>
                    <select class="custom-select" id="form-imf-accm" name="form-imf-accm" required aria-describedby="form-imf-accm-help" required>
                      <option class="" value="" selected>Choose...</option>
                      <option class="" value="1">CS Ketan Bhalghamiya (Asst. Director)</option>
                      <option class="" value="2">Mr. Rakesh Goyal (Dept. Director)</option>
                      <option class="" value="3">Ms. Trupti Karkhanis (HOD)</option>
                      <option class="" value="4">Mr. Sudhanshu Tewari</option>
                      <option class="" value="5">CS Sapna Malhotra (Asst. Director)</option>
                      <option class="" value="6">Ms. Archana Sawant</option>
                    </select>
                  </div>
                  <small id="form-imf-accm-help" class="form-text text-muted text-right">Select Account Manager or Project SPOC.</small>
                </div>
              </div>
              <div class="form-row">
                <!-- Project -->
                <div class="form-group col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-crf-project">Project:</label>
                    </div>
                    <select class="custom-select" id="form-crf-project" name="form-crf-project" required aria-describedby="form-crf-project-help">
                      <option value="" selected>Choose...</option>
                      <option value="1">
                        Lorem ipsum dolor sit amet consectetur
                      </option>
                      <option value="2">
                        Reiciendis labore minima natus, sequi nobis
                      </option>
                      <option value="3">
                        Cumque, placeat iure natus, nulla itaque
                      </option>
                      <option value="4">Exercitationem quaerat quibusdam</option>
                    </select>
                  </div>
                  <small id="form-crf-project-help" class="form-text text-muted text-right">Select the project.</small>
                </div>
                <!-- Invoice -->
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-imf-city">Invoice#</label>
                    </div>
                    <input class="form-control" id="form-imf-city" name="form-imf-city" disabled="disabled" />
                  </div>
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
                    <input type="date" class="form-control" id="form-imf-dtend" name="form-imf-dtend" required />
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
