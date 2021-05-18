<!--  RESOURCE: https://stackoverflow.com/questions/44278447/how-to-display-records-on-key-pressed-using-ajax-or-php -->
    <title>CRF : bluminvoice</title>
    <?php @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="container bl__home_crf-search">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <form class="p-1 mt-3 mb-0 bg-transparent shadow-sm" accept-charset="UTF-8" id="form-crf-searchform" name="form-crf" autocomplete="off" novalidate onkeydown="return event.key != 'Enter';">
              <!-- <label class="sr-only" for="form-crf-search">Project:</label> -->
              <div class="input-group">
                <input type="text" class="form-control" id="form-crf-search" name="form-crf-search" autofocus placeholder="Which assignment to search?" />
                <div class="input-group-append">
                  <span class="input-group-text no-border bg-white text-shadow-md">&#128269;</span>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div id="search-box" class="search-box p-3 rounded-lg" style="display: none;">
              <h5 class="text-primary">Search Results</h5>
              <hr>
              <div id="search-list" class="search-list"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="container bl__home_crf mb-5">
        <form class="needs-validation p-4" accept-charset="UTF-8" action="./crf_page.php" method="post" id="form-crf" name="form-crf" novalidate>
          <h3 class="text-center mb-4 text-white font-weight-bold">Change Request Form</h3>
          <div class="form-row">
            <div class="form-group col-12">
              <!-- CUSTOMER -->
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-crf-cust">Customer:</label>
                </div>
                <input class="form-control" id="form-crf-cust" name="form-crf-cust" required readonly placeholder="Customer Name" />
              </div>
                <input name="form-crf-custID" placeholder="custID" hidden />
                <input name="form-crf-projectID" placeholder="projectID" hidden />
            </div>
          </div>
          <div class="form-row">
            <!-- PROJECT -->
            <div class="form-group mb-1 mb-md-auto col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-crf-project">Project:</label>
                </div>
                <input type="text" class="form-control" id="form-crf-project" name="form-crf-project" readonly placeholder="Project's Name*" />
              </div>
            </div>
            <!-- DATE -->
            <div class="form-group col-md-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-crf-date">Date:</label>
                </div>
                <input type="date" class="form-control" id="form-crf-date" name="form-crf-date" aria-describedby="form-crf-date-help" required value="<?php echo date('Y-m-d'); ?>" />
              </div>
              <small id="form-crf-date-help" class="form-text text-muted text-right">CRF received date.</small>
            </div>
          </div>
          <div class="form-group">
            <!-- CHANGES -->
            <label class="sr-only" for="form-crf-desc">Change Requests</label>
            <textarea class="form-control" id="form-crf-desc" name="form-crf-desc" rows="6" required placeholder="Put the change request(s) here..." aria-describedby="form-crf-desc-help"></textarea>
            <small id="form-crf-desc-help" class="form-text text-muted text-right">Fill in the change request as
              detailed as possible.</small>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-crf-amount">Fin. Addition:</label>
                </div>
                <input type="text" class="form-control" id="form-crf-amount" name="form-crf-amount" placeholder="0" required pattern="^-?\d+$" />
              </div>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-success float-right">Create</button>
              <button type="reset" class="btn btn-info mr-3 float-right">Reset</button>
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
      </section>
    </main>
    <?php @include_once "footer.html" ?>
