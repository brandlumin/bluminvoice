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
    <title>CMF : bluminVoice</title>
  </head>

  <body class="bl__home d-flex flex-column justify-content-between">
    <?php @include_once "header.html" ?>
    <main role="main" class="customer-master container flex-fill d-flex flex-column justify-content-center mt-3">
      <section class="container bl__home_cmf">
        <div class="row">
          <div class="col">
            <form class="needs-validation p-4" accept-charset="UTF-8" action="./cmf_page.php" method="post" id="form-cmf" name="form-cmf" autocomplete="off" novalidate>
              <h3 class="text-center mb-4 text-white font-weight-bold">Customer Master Form</h3>
              <div class="form-row">
                <div class="form-group col-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-cmf-name">Customer:</label>
                    </div>
                    <input class="form-control" id="form-cmf-name" name="form-cmf-name" required autofocus placeholder="Customer Name" />
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-12">
                  <div class="input-group d-flex">
                    <div class="">
                      <label class="input-group-text bg-warning text-body h-100" for="form-cmf-addr1">Address:</label>
                    </div>
                    <div class="flex-grow-1">
                      <input class="form-control mb-1" id="form-cmf-addr1" name="form-cmf-addr1" required placeholder="Address 1" />
                      <input class="form-control mb-1" id="form-cmf-addr2" name="form-cmf-addr2" required placeholder="Address 2" />
                      <input class="form-control" id="form-cmf-addr3" name="form-cmf-addr3" required placeholder="Address 3" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row align-items-center">
                <div class="form-group mb-1 mb-md-auto col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-cmf-city">City:</label>
                    </div>
                    <input class="form-control" id="form-cmf-city" name="form-cmf-city" placeholder="City*" required />
                  </div>
                </div>
                <div class="form-group mb-1 mb-md-auto col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-cmf-state">State:</label>
                    </div>
                    <input class="form-control" id="form-cmf-state" name="form-cmf-state" placeholder="State*" required />
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-cmf-pin">PIN:</label>
                    </div>
                    <input class="form-control" id="form-cmf-pin" name="form-cmf-pin" placeholder="PIN*" pattern="\d{6}" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-warning text-body" for="form-cmf-gstin">GSTIN:</label>
                    </div>
                    <input class="form-control" id="form-cmf-gstin" name="form-cmf-gstin" required placeholder="GST Idendification Number*" />
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group-prepend">
                    <label class="input-group-text bg-warning text-body mr-3" for="form-cmf-gst-type">GST Type:</label>
                    <div class="form-check form-check-inline mr-3">
                      <input type="radio" id="form-cmf-scgst" name="form-cmf-gst-type" class="form-check-input" value="scgst" required />
                      <label class="form-check-label text-white" for="form-cmf-scgst"><b>S&C</b>-GST</label>
                    </div>
                    <div class="form-check form-check-inline mr-3">
                      <input type="radio" id="form-cmf-igst" name="form-cmf-gst-type" class="form-check-input" value="igst" required />
                      <label class="form-check-label text-white" for="form-cmf-igst"><b>I</b>-GST</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" id="form-cmf-utgst" name="form-cmf-gst-type" class="form-check-input" value="utgst" required />
                      <label class="form-check-label text-white" for="form-cmf-utgst"><b>UT</b>-GST</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <!-- BUTTONS -->
                  <a class="btn btn-secondary shadow-sm-dark no-shadow-hover mr-2">List</a>
                  <!-- <div class="text-right"> -->
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
          if (isset($_GET["success"])) {
            $opStatus = "<div class='alert alert-success alert-dismissible fade show position-absolute center-vertical' role='alert'>Customer has been added.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          } elseif (isset($_GET["error"])) {
            $opStatus = "<div class='alert alert-danger alert-dismissible fade show position-absolute center-vertical' role='alert'><b>Error encountered:</b> " . $_GET["error"] . "<br/>Please call your IT admin to attend to this error here.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          }
          if (isset($opStatus)) {echo $opStatus; unset($opStatus);}
        ?>
      </section>
      <section class="container bl__home_cmf-list">
        <div class="row">
          <div class="col">
            <h4 name="subtitle">List of Customers</h4>
            <div class="d-flex flex-row justify-content-between flex-wrap list">
              <!-- p-2 mb-2 bg-secondary text-white -->
              <?php
                @include "consql.php";
                $custlist = "SELECT `custName`, `custCity` FROM `customerMaster` ORDER BY `custName` ASC";
                $response = mysqli_query($connection, $custlist);
                mysqli_close($connection);
                if(mysqli_num_rows($response) > 0 ) {
                  $data = "";
                  while($row=mysqli_fetch_assoc($response)) {
                    echo "<div class='p-2 mb-2 small'>".$row['custName'].", ".$row['custCity']."</div>";
                 }
                } else {
                  echo "Customer not found in the system.";
                }
              ?>
            </div>
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