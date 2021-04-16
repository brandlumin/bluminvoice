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
    <title>AMF : bluminVoice</title>
  </head>

  <body class="bl__home d-flex flex-column justify-content-between">
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
                      <option class="" value="" selected>Choose...</option>
                      <option class="" value="1">ICSI CCGRT</option>
                      <option class="" value="2">ICSI CERT</option>
                      <option class="" value="3">ICSI WIRC</option>
                      <option class="" value="4">Locate365</option>
                    </select>
                  </div>
                  <small id="form-amf-cust-help" class="form-text text-muted text-right">Select the customer.</small>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-7">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-name">Name:</label>
                    </div>
                    <input class="form-control" id="form-amf-name" name="form-amf-name" required placeholder="Account Person's Name*" pattern="\w+" />
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
                <div class="form-group col-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-amf-addr">Address:</label>
                    </div>
                    <textarea class="form-control" id="form-amf-addr" name="form-amf-addr" rows="3" placeholder="Address 1*&#10;Address 2*&#10;Address 3" style="resize: none" required></textarea>
                  </div>
                </div>
              </div>
              <div class="row align-items-center">
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
              <div class="row">
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
                  <div class="text-right">
                    <!-- BUTTONS -->
                    <button type="reset" class="btn btn-outline-light shadow-sm-dark no-shadow-hover mr-2">
                      Reset
                    </button>
                    <button type="submit" class="btn btn-success shadow-sm-dark no-shadow-hover">
                      Create
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