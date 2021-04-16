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
    <title>PMF : bluminVoice</title>
  </head>

  <body class="bl__home d-flex flex-column justify-content-between">
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
                    <select class="custom-select" id="form-pmf-cust" name="form-pmf-cust" required aria-describedby="form-pmf-cust-help" required>
                      <option class="" value="" selected>Choose...</option>
                      <option class="" value="1">ICSI CCGRT</option>
                      <option class="" value="2">ICSI CERT</option>
                      <option class="" value="3">ICSI WIRC</option>
                      <option class="" value="4">Locate365</option>
                    </select>
                  </div>
                  <small id="form-pmf-cust-help" class="form-text text-muted text-right">Select the customer.</small>
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
                      <option class="" value="" selected>Choose...</option>
                      <option class="" value="1">CS Ketan Bhalghamiya (Asst. Director)</option>
                      <option class="" value="2">Mr. Rakesh Goyal (Dept. Director)</option>
                      <option class="" value="3">Ms. Trupti Karkhanis (HOD)</option>
                      <option class="" value="4">Mr. Sudhanshu Tewari</option>
                      <option class="" value="5">CS Sapna Malhotra (Asst. Director)</option>
                      <option class="" value="6">Ms. Archana Sawant</option>
                    </select>
                  </div>
                  <small id="form-pmf-accm-help" class="form-text text-muted text-right">Select Account Manager or Project SPOC.</small>
                </div>
              </div>
              <div class="row">
                <!-- PROJECT -->
                <div class="form-group mb-1 mb-md-auto col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-name">Project:</label>
                    </div>
                    <input type="text" class="form-control" id="form-pmf-name" name="form-pmf-name" required placeholder="Project's Name*" pattern="\w+" />
                  </div>
                </div>
                <!-- INVOICE NUMBER -->
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-invoice">Invoice#</label>
                    </div>
                    <input type="text" class="form-control" id="form-pmf-invoice" name="form-pmf-invoice" disabled="" />
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
                    <textarea class="form-control" id="form-pmf-desc" name="form-pmf-desc" rows="3" placeholder="Project Description" style="resize: none"></textarea>
                  </div>
                </div>
                <!-- NARRATION -->
                <div class="form-group col-12 col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-narr">Narration:</label>
                    </div>
                    <textarea class="form-control" id="form-pmf-narr" name="form-pmf-narr" rows="3" placeholder="Internal Narration" style="resize: none"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- START DATE -->
                <div class="form-group mb-1 mb-md-auto col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-date">Start Date:</label>
                    </div>
                    <input type="date" class="form-control" id="form-pmf-date" name="form-pmf-date" required />
                  </div>
                </div>
                <!-- Quoted Amount -->
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-date">Quoted:</label>
                    </div>
                    <input type="text" class="form-control" id="form-pmf-date" name="form-pmf-date" placeholder="Project cost*" required pattern="\d+\.{0,1}\d{0,2}" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group mb-1 mb-md-auto col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-dsg">@ Design:</label>
                    </div>
                    <input type="text" class="form-control" id="form-pmf-dsg" name="form-pmf-dsg" placeholder="Design Rate*" required pattern="\d+\.{0,1}\d{0,2}" />
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-pmf-layt">@ Layout:</label>
                    </div>
                    <input type="text" class="form-control" id="form-pmf-layt" name="form-pmf-layt" placeholder="Layout Rate*" required pattern="\d+\.{0,1}\d{0,2}" />
                  </div>
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
                      Create Project
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>
    <?php @include_once "footer.html" ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="scripts/preload.js"></script>
    <script src="scripts/script6es.js"></script>
  </body>

</html>