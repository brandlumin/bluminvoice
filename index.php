<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./site.webmanifest">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styles/bootstrap.css" />
    <link rel="stylesheet" href="styles/bluminvoice.css" />
    <title>home : bluminVoice</title>
  </head>

  <body class="bl__home d-flex flex-column justify-content-between">
    <?php @include_once "header.html" ?>
    <main role="main">
      <section class="jumbotron text-center rounded-0 bg-warning mb-0" style="box-shadow: 0 4px 4px rgba(0,0,0,.25)">
        <div class="container">
          <p class="h3">Welcome@bluminVoice</p>
          <p class="lead">
            You can choose the next step from the menu given on top-right side
            of the page.<br class="d-none d-lg-inline" /><span class="d-inline d-lg-none">&nbsp;</span>Two mostly used
            actions are given here just to help you work
            faster:
          </p>
          <p>
            <a href="./invoice-master" class="btn btn-success my-2 mr-3">Generate Invoice</a>
            <a href="./assignment-master" class="btn btn-primary my-2">New Assignment</a>
          </p>
        </div>
      </section>
      <section class="container bl__home_crf">
        <form class="needs-validation p-4" accept-charset="UTF-8" action="./crf_page.php" method="post" id="form-crf" name="form-crf" novalidate>
          <h3 class="text-center mb-4 text-white font-weight-bold">Change Request Form</h3>
          <div class="form-row">
            <!-- CUSTOMER -->
            <div class="form-group col-12">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-crf-cust">Customer:</label>
                </div>
                <select class="custom-select" id="form-crf-cust" name="form-crf-cust" required aria-describedby="form-crf-cust-help" required>
                  <option class="" value="" selected>Choose...</option>
                  <option class="" value="1">ICSI CCGRT</option>
                  <option class="" value="2">ICSI CERT</option>
                  <option class="" value="3">ICSI WIRC</option>
                  <option class="" value="4">Locate365</option>
                </select>
              </div>
              <small id="form-crf-cust-help" class="form-text text-muted text-right">Select the customer.</small>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6">
              <!-- PROJECT -->
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
            <div class="form-group col-lg-6">
              <!-- DATE -->
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-crf-date">Date:</label>
                </div>
                <input type="date" class="form-control" id="form-crf-date" name="form-crf-date" aria-describedby="form-crf-date-help" required />
              </div>
              <small id="form-crf-date-help" class="form-text text-muted text-right">form-CRF received date.</small>
            </div>
          </div>
          <div class="form-group">
            <!-- CHANGES -->
            <label class="sr-only" for="form-crf-desc">Change Requests</label>
            <textarea class="form-control" id="form-crf-desc" name="form-crf-desc" rows="6" required placeholder="Put the change request(s) here..." aria-describedby="form-crf-desc-help"></textarea>
            <small id="form-crf-desc-help" class="form-text text-muted text-right">Fill in the change request as detailed
              as possible.</small>
          </div>
          <div class="form-row">
            <!-- VIA, DESIGN & LAYOUT -->
            <div class="form-group col-md-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body" for="form-crf-via">Via:</label>
                </div>
                <select class="custom-select" id="form-crf-via" name="form-crf-via" required aria-describedby="form-crf-via-help">
                  <option value="" selected>Choose...</option>
                  <option value="1">Phone</option>
                  <option value="2">Email</option>
                  <option value="3">WhatsApp</option>
                  <option value="4">Other</option>
                </select>
              </div>
              <small id="form-crf-via-help" class="form-text text-muted text-right">Changes received via channel.</small>
            </div>
            <div class="form-group col-md-4 col-6">
              <div class="input-group mb-1 mb-md-0">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body">Design#</label>
                </div>
                <input type="text" class="form-control" id="form-crf-desg" placeholder="0" required pattern="\d+" />
              </div>
              <small id="form-crf-desg-help" class="form-text text-muted text-right">CRF Design Charge count.</small>
            </div>
            <div class="form-group col-md-4 col-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label class="input-group-text bg-warning text-body">Layout#</label>
                </div>
                <input type="text" class="form-control" id="form-crf-layout" placeholder="0" required pattern="\d+" />
              </div>
              <small id="form-crf-layout-help" class="form-text text-muted text-right">CRF Layout Charge count.</small>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="text-right">
                <!-- BUTTONS -->
                <button type="reset" class="btn btn-outline-light shadow-sm-dark no-shadow-hover mr-2">
                  Reset
                </button>
                <button type="submit" class="btn btn-success shadow-sm-dark no-shadow-hover">
                  Register
                </button>
              </div>
            </div>
          </div>
        </form>
      </section>
    </main>
    <?php @include_once "footer.html" ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="scripts/preload.js"></script>
    <script src="scripts/script6es.js"></script>
  </body>

</html>