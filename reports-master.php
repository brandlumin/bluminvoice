<title>APR : bluminvoice</title>
<?php @include "header.html"; ?>
<main role="main"  class="flex-fill d-flex flex-column justify-content-center">
  <section class="container bl__home_apr">
    <form class="needs-validation p-4" accept-charset="UTF-8" action="./apr_page_register.php" method="post" id="form-apr" name="form-apr" novalidate>
      <h3 class="text-center mb-4 text-white font-weight-bold">Project Reports</h3>
      <!-- Radio Buttons -->
      <div class="form-row mb-3 p-2 text-center font-weight-bold rounded-top shadow-sm-dark no-shadow-hover bl__home_apr-choice">
        <div class="col-4 offset-2 col-md-3 offset-md-0 mb-md-0 mb-1">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchByProject" name="searchBy" value="Project" class="custom-control-input" checked="checked">
            <label class="custom-control-label" for="searchByProject" pointer>by Project</label>
          </div>
        </div>
        <div class="col-4 col-md-3 offset-md-0 mb-md-0 mb-1">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchByInvoiceID" name="searchBy" value="Invoice" class="custom-control-input">
            <label class="custom-control-label" for="searchByInvoiceID" pointer>by Invoice</label>
          </div>
        </div>
        <div class="col-4 offset-2 col-md-3 offset-md-0 mb-md-0">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchByStartDate" name="searchBy" value="Started" class="custom-control-input">
            <label class="custom-control-label" for="searchByStartDate" pointer>by Start Date</label>
          </div>
        </div>
        <div class="col-4 col-md-3 offset-md-0 mb-md-0">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchByEndDate" name="searchBy" value="Ended" class="custom-control-input">
            <label class="custom-control-label" for="searchByEndDate" pointer>by End Date</label>
          </div>
        </div>
      </div>
      <div class="form-row">
        <!-- Project -->
        <div class="form-group col-md-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-proj">Project:</label>
            </div>
            <input type="text" class="form-control" id="form-apr-proj" name="form-apr-proj" placeholder="Project's Name*"/>
          </div>
          <!-- Search List -->
          <div id="search-box-project" class="search-box-project p-3 rounded-lg" style="display: none;">
            <h5 class="text-primary">Search Results</h5>
            <hr>
            <div id="search-list-project" class="search-list-project"></div>
          </div>
          <input name="form-apr-projID" placeholder="Project ID" HIDDEN/>
        </div>
        <!-- Invoice -->
        <div class="form-group col-md-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-invoice">Invoice#</label>
            </div>
            <input type="text" class="form-control" id="form-apr-invoice" name="form-apr-invoice" readonly="readonly" placeholder="BLYY/QN-NN"/>
          </div>
          <!-- Search List -->
          <div id="search-box-invoice" class="search-box-invoice p-3 rounded-lg" style="display: none;">
            <h5 class="text-primary">Search Results</h5>
            <hr>
            <div id="search-list-invoice" class="search-list-invoice"></div>
          </div>
        </div>
      </div>
      <div class="form-row">
        <!-- Customer -->
        <div class="form-group col-md-7">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-cust">Customer:</label>
            </div>
            <input type="text" class="form-control" id="form-apr-cust" name="form-apr-cust" required readonly="readonly" placeholder="Customer Name*" />
          </div>
          <?php /* echo <input name="form-apr-custID" placeholder="Customer ID" HIDDEN/> */ ?>
        </div>
        <!-- Account Manager -->
        <div class="form-group col-md-5">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-acct">Manager:</label>
            </div>
            <input type="text" class="form-control" id="form-apr-acct" name="form-apr-acct" required readonly="readonly" placeholder="Account Manager Name*" />
          </div>
          <?php /* echo <input name="form-apr-acctID" placeholder="Account Manager ID" HIDDEN/> */ ?>
        </div>
      </div>
      <div class="form-row">
        <!-- Start Date -->
        <div class="form-group col-md-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-dtstrt">Start Date:</label>
            </div>
            <input type="date" class="form-control" id="form-apr-dtstrt" name="form-apr-dtstrt" readonly="readonly"/>
          </div>
          <!-- Search List -->
          <div id="search-box-started" class="search-box-started p-3 rounded-lg" style="display: none;">
            <h5 class="text-primary">Search Results</h5>
            <hr>
            <div id="search-list-started" class="search-list-started" style="white-space: nowrap; overflow: hidden;"></div>
          </div>
        </div>
        <!-- End Date -->
        <div class="form-group col-md-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-dtend">End Date:</label>
            </div>
            <input type="date" class="form-control" id="form-apr-dtend" name="form-apr-dtend" readonly="readonly" max="<?php echo date('Y-m-d'); ?>"/>
          </div>
          <!-- Search List -->
          <div id="search-box-ended" class="search-box-ended p-3 rounded-lg" style="display: none;">
            <h5 class="text-primary">Search Results</h5>
            <hr>
            <div id="search-list-ended" class="search-list-ended" style="white-space: nowrap; overflow: hidden;"></div>
          </div>
        </div>
        <!-- Payment Date -->
        <div class="form-group col-md-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-dtpay">Paid Date:</label>
            </div>
            <input type="date" class="form-control" id="form-apr-dtpay" name="form-apr-dtpay" readonly="readonly" max="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
      </div>
      <div class="form-row">
        <!-- Description -->
        <div class="form-group col-md-6">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-desc">Description:</label>
            </div>
            <textarea class="form-control" id="form-apr-desc" name="form-apr-desc" rows="2" placeholder="Project Description" style="resize: none" readonly="readonly"></textarea>
          </div>
        </div>
        <!-- Narration -->
        <div class="form-group col-md-6">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-narr">Narration:</label>
            </div>
            <textarea class="form-control" id="form-apr-narr" name="form-apr-narr" rows="2" placeholder="Internal Narration" style="resize: none" readonly="readonly"></textarea>
          </div>
        </div>
      </div>
      <div class="form-row">
        <!-- Change Request History -->
        <div class="form-group col-12">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-crfhistory">Change Request History:</label>
            </div>
            <textarea class="form-control" id="form-apr-crfhistory" name="form-apr-crfhistory" rows="3" placeholder="CRF Details" style="resize: none" readonly="readonly"></textarea>
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
                  <label class="input-group-text bg-warning text-body" for="form-apr-qprice">Quoted:</label>
                </div>
                <input type="text" class="text-right pr-5 form-control text-monospace" id="form-apr-qprice" name="form-apr-qprice" readonly="readonly" required="required"/>
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-apr-crftotal">CRFs:</label>
                </div>
                <input type="text" class="text-right pr-5 form-control text-monospace" id="form-apr-crftotal" name="form-apr-crftotal" readonly="readonly"/>
              </div>
            </div>
            <div class="col-12">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-apr-total">Total:</label>
                </div>
                <input type="text" class="text-right pr-5 form-control text-monospace font-weight-bold" id="form-apr-total" name="form-apr-total" readonly="readonly" required="required"/>
              </div>
            </div>
          </div>
        </div>
        <!-- Billing Details -->
        <div class="form-group col-md-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text bg-warning text-body" for="form-apr-billing">Billing Details:</label>
            </div>
            <textarea class="form-control text-monospace" id="form-apr-billing" name="form-apr-billing" rows="5" placeholder="Final Display" style="resize: none" readonly="readonly" required="required"></textarea>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-3"><input type="text" name="form-apr-cgst" placeholder="form-apr-cgst" HIDDEN/></div>
        <div class="col-3"><input type="text" name="form-apr-sgst" placeholder="form-apr-sgst" HIDDEN/></div>
        <div class="col-3"><input type="text" name="form-apr-igst" placeholder="form-apr-igst" HIDDEN/></div>
        <div class="col-3"><input type="text" name="form-apr-gtot" placeholder="form-apr-gtot" HIDDEN/></div>
      </div>
      <!-- <div class="form-row">
        <div class="col-12">
          <button type="submit" name="payment" class="btn btn-danger" formaction="./apr_page_payment.php" disabled="disabled">Receive Payment</button>
          <button type="submit" name="generate" class="btn btn-success float-right" disabled="disabled">Generate</button>
          <button type="reset" name="reset" class="btn btn-info mr-3 float-right">Reset</button>
        </div>
      </div> -->
    </form>
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-success shadow-sm">
            <h5 class="modal-title text-white text-shadow-xs font-weight-bold" id="detailModalLabel">HEADING</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"></div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php @include "footer.html"; ?>
