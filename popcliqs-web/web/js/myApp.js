
var myApp;
myApp = myApp || (function () {
var pleaseWaitDiv = $('<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="basicModal" aria-hidden="true" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h1>Processing...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="progress-bar" style="width: 100%;"><span class="sr-only">60% Complete</span></div></div></div></div></div></div></div></div>');
return {
    showPleaseWait: function() {
    pleaseWaitDiv.modal();
    },
    
    hidePleaseWait: function () {
    pleaseWaitDiv.modal('hide');
    },

};
})();
