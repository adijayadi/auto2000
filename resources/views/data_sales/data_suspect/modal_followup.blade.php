
    {{-- Modal --}}
    <div class="modal" id="modal-follow-up" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h4 class="modal-title text-center">Follow Up</h4>
                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-sm-4 col-xs-12">
                            <label>Tanggal Rencana Follow Up</label>
                        </div>

                        <div class="col-sm-8 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm datepicker" name="">
                            </div>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label>Jam Rencana Follow Up</label>
                        </div>

                        <div class="col-sm-8 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm clockpicker" name="">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-primary" id="btn-simpan" type="button">Simpan</button>
                    <button class="btn btn-warning" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}