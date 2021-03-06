    <title>HOME : bluminvoice</title>
    <?php @include_once "header.html" ?>
    <main role="main">
      <section class="jumbotron text-center rounded-0 bg-warning mt-n4" style="box-shadow: 0 5px 7px -5px rgba(0,0,0,.7)">
        <div class="container">
          <p class="h3">Welcome@bluminVoice</p>
          <p class="lead">
            You can choose the next step from the menu given on top-right side
            of the page.<br class="d-none d-lg-inline" /><span class="d-inline d-lg-none">&nbsp;</span>Two mostly used
            actions are given here just to help you work
            faster:
          </p>
          <p>
            <a href="./invoice-master.php" class="btn btn-success my-2 mr-3">Generate Invoice</a>
            <a href="./assignment-master.php" class="btn btn-primary my-2">New Assignment</a>
          </p>
        </div>
      </section>
      <section class="container bl__home_crf">
        <div class="row">
          <div class="col">
            <form class="needs-validation p-4" accept-charset="UTF-8" action="./crf_page.php" method="post" id="form-crf" name="form-crf" novalidate>
              <h3 class="text-center mb-4 text-white font-weight-bold">Change Request Form</h3>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <!-- Project NAME -->
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-crf-project">Project:</label>
                    </div>
                    <input type="text" class="form-control" id="form-crf-project" name="form-crf-project" placeholder="Project's Name*" autofocus/>
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
                </div>
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-crf-invoice">Invoice#</label>
                    </div>
                    <input class="form-control" id="form-crf-invoice" name="form-crf-invoice" readonly="readonly" placeholder="Invoice#" />
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-crf-cust">Customer:</label>
                    </div>
                    <input class="form-control" id="form-crf-cust" name="form-crf-cust" required readonly placeholder="Customer Name" />
                  </div>
                  <input name="form-crf-custID" placeholder="custID" hidden />
                  <input name="form-crf-projectID" placeholder="projectID" hidden />
                </div>
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-crf-date">Date:</label>
                    </div>
                    <input type="date" class="form-control" id="form-crf-date" name="form-crf-date" aria-describedby="form-crf-date-help" required max="<?php echo date('Y-m-d'); ?>" readonly="readonly"/>
                  </div>
                  <small id="form-crf-date-help" class="form-text text-muted text-right">CRF received date.</small>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <!-- CHANGES -->
                  <label class="sr-only" for="form-crf-desc">Change Requests</label>
                  <textarea class="form-control" id="form-crf-desc" name="form-crf-desc" rows="6" required placeholder="Put the change request(s) here..." aria-describedby="form-crf-desc-help" readonly="readonly"></textarea>
                  <small id="form-crf-desc-help" class="form-text text-muted text-right">Fill in the change request as
                    detailed as possible.</small>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-crf-amount">Fin. Addition:</label>
                    </div>
                    <input type="text" class="form-control" id="form-crf-amount" name="form-crf-amount" placeholder="0" required pattern="^-?\d+$" readonly="readonly"/>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <button type="submit" class="btn btn-success no-shadow-hover float-right">Create</button>
                  <button type="reset" class="btn btn-primary no-shadow-hover mr-3 float-right">Reset</button>
                  <!-- </div> -->
                </div>
              </div>
            </form>
            <?php
            /**
             *    This captures the response sent back from pmf_page.php
             *    and displays the success or failure result accordingly.
             */
              if (isset($_GET["success"])) {
                $opStatus = "<div class='alert alert-success alert-dismissible fade show position-absolute center-vertical' role='alert'>Project Change Request has been created.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
              } elseif (isset($_GET["error"])) {
                $opStatus = "<div class='alert alert-danger alert-dismissible fade show position-absolute center-vertical' role='alert'><b>Error encountered:</b> " . $_GET["error"] . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
              }
              if (isset($opStatus)) {echo $opStatus; unset($opStatus);}
            ?>
          </div>
        </div>
      </section>
    </main>
    <?php @include_once "footer.html" ?>
