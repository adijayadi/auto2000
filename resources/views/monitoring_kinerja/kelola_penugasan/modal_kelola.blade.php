
    {{-- Modal --}}
    <div class="modal" id="modal-kelola" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h4 class="modal-title text-center">Ganti Service Advisor Lama ke Baru</h4>
                    
                </div>
                <div class="modal-body" >
                    <div class="row">

                        <div class="col-sm-2 col-xs-12">
                            <label>Ganti Service Advisor?</label>
                        </div>

                        <div class="col-sm-10 col-xs-12">
                            <div class="form-group">
                                <select class=" form-control input-sm select2" name="advisor_baru">
                                    <option value="">~ Pilih Service Advisor Baru ~</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-12">
                            <label>Tanggal Follow Up</label>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm datepicker" name="">
                            </div>
                        </div>


                        <div class="col-sm-2 col-xs-12">
                            <label>Jam Follow Up</label>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm clockpicker" name="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-primary" type="button">Simpan</button>
                    <button class="btn btn-warning" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}