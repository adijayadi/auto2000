    
    {{-- Modal --}}
    <div class="modal" id="modal-service" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h4 class="modal-title text-center">Follow Up</h4>
                    
                </div>
                    <form id="form_service">
                        <div class="modal-body">
                            <div class="row">
                                
                                <div class="col-sm-4 col-xs-12">
                                    <label>Type Pekerjaan</label>
                                </div>

                                <div class="col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-sm" name="typejob">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <div class="modal-footer text-right">
                    <button class="btn btn-primary" id="simpan_service" type="button">Simpan</button>
                     
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}