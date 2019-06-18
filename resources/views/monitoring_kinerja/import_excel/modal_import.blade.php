
    {{-- Modal --}}
    <div class="modal" id="modal-import" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h4 class="modal-title text-center">Import Excel</h4>
                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-sm-4 col-xs-12">
                            <label> File Excel</label>
                        </div>

                        <div class="col-sm-8 col-xs-12">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="file" class="form-control input-sm" name="excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    <span class="input-group-addon"><i class="fa fa-file-excel"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-primary" id="btn-upload" type="button">Upload</button>
                     
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}