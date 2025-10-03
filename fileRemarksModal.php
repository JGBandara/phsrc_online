<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05
 */

?>
<div class="modal fade" id="fileRemarksBoxModal" tabindex="-1" role="dialog" aria-labelledby="messageBox" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fileRemarksBoxModalTitle">File Remarks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-sm-12">
            <label for="txtRemarks" class="col-form-label-sm">Remarks</label>
            <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
          </div>
        </div>
        <div class="row errorMsg" style="display: none;">
          <div class="form-group col-sm-12 text-danger">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success save">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
