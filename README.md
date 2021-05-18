# bluminvoice
It is a custom 'personal' project for internal use.

RESOURCE:
How to call a specific function in a PHP script via Ajax?
https://stackoverflow.com/questions/6371857/how-to-call-a-specific-function-in-a-php-script-via-ajax


>> Assignment Master Form <<
Customer: borrow from Account Master.
Manager: Make it from AccountMaster table using Customer dropdown code.
Project: Name of the project.
Invoice: Serial number to be booked using excel calculation.
Description: Highlights of the project, acts as Invoice byline
Narration: In-house notes to keep in mind.
Start Date: Should be filled with today's date.
Quoted: Cost that was agreed upon by both the parties.

-- Make @Design and @Layout rates "Hidden" to extend it to WebApp Developments --

<div class="row" hidden> <!-- TRASHED FIELDS -->
  <div class="form-group mb-1 mb-md-auto col-md-6">
    <div class="input-group">
      <div class="input-group-prepend">
        <label class="input-group-text bg-warning text-body" for="form-pmf-dsg">@ Design:</label>
      </div>
      <input type="text" class="form-control" id="form-pmf-dsg" name="form-pmf-dsg" placeholder="Design Rate*" pattern="\d+\.{0,1}\d{0,2}" /> <!-- required -->
    </div>
  </div>
  <div class="form-group col-md-6">
    <div class="input-group">
      <div class="input-group-prepend">
        <label class="input-group-text bg-warning text-body" for="form-pmf-layt">@ Layout:</label>
      </div>
      <input type="text" class="form-control" id="form-pmf-layt" name="form-pmf-layt" placeholder="Layout Rate*" pattern="\d+\.{0,1}\d{0,2}" /> <!-- required -->
    </div>
  </div>
</div>


>> Change Request Form <<

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
    <small id="form-crf-via-help" class="form-text text-muted text-right">Changes received via
      channel.</small>
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