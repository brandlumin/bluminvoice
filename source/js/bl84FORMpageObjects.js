/**
 *      Creates "$page" Object to traverse 
 *                      in the IMF and APR forms
 *      @param  {Object} sBox   Search Box
 *      @param  {Object} sList  Search List
 *      @param  {String} frmName  target form name
 *      @return {Object}        The created object
 */
function IMFAPRpageObject(sBox, sList, frmName = "apr") {
  return {
    $_form: $("form"),
    $_acct: $("#form-" + frmName + "-acct", this.$_form),
    $_billing: $("#form-" + frmName + "-billing", this.$_form),
    $_crfhistory: $("#form-" + frmName + "-crfhistory", this.$_form),
    $_crftotal: $("#form-" + frmName + "-crftotal", this.$_form),
    $_cust: $("#form-" + frmName + "-cust", this.$_form),
    $_desc: $("#form-" + frmName + "-desc", this.$_form),
    $_dtend: $("#form-" + frmName + "-dtend", this.$_form),
    $_dtpay: $("#form-" + frmName + "-dtpay", this.$_form),
    $_dtstrt: $("#form-" + frmName + "-dtstrt", this.$_form),
    $_invoice: $("#form-" + frmName + "-invoice", this.$_form),
    $_narr: $("#form-" + frmName + "-narr", this.$_form),
    $_project: $("#form-" + frmName + "-proj", this.$_form),
    $_qprice: $("#form-" + frmName + "-qprice", this.$_form),
    $_total: $("#form-" + frmName + "-total", this.$_form),
    $_detailModal: $("#detailModal", "body"),
    $_modalBody: $("#detailModal .modal-body", "body"),
    $_modalTitle: $("#detailModal .modal-title", "body"),
    $_searchBox: $(sBox, this.$_form),
    $_searchList: $(sList, this.$_form)
  };
}


function AMFpageObject() {
  return {
    $_form: $("form"),
    $_cust: $("select#form-amf-cust", this.$_form),
    $_name: $("input#form-amf-name", this.$_form),
    $_desig: $("input#form-amf-desig", this.$_form),
    $_usecustaddr: $("input#form-amf-usecustaddr", this.$_form),
    $_addr1: $("input#form-amf-addr1", this.$_form),
    $_addr2: $("input#form-amf-addr2", this.$_form),
    $_addr3: $("input#form-amf-addr3", this.$_form),
    $_city: $("input#form-amf-city", this.$_form),
    $_state: $("input#form-amf-state", this.$_form),
    $_pin: $("input#form-amf-pin", this.$_form),
    $_phones: $("input#form-amf-phones", this.$_form),
    $_email: $("input#form-amf-email", this.$_form),
    $_toggleBtn: $("a#toggleBtn", this.$_form),
    $_btnReset: $("button.btn-primary", this.$_form),
    $_btnSave: $("button.btn-success", this.$_form)
  };
}