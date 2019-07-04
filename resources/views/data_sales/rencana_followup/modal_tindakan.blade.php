
    {{-- Modal --}}
    <div class="modal" id="detail_tindakan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h4 class="modal-title text-center">Tindakan Service Advisor ke 1</h4>
                    
                </div>
                <div class="modal-body">
                    <div class="tabs-container">
                        
                        <form id="form_tindakan">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Hasil Tindakan</label>
                            </div>
                            <div class="col-lg-8 col-lg-8 col-sm-8 col-xs-12">
                                
                                    <select class="form-control input-sm" name="tindakan">
                                        <option {{-- data-toggle="tab" data-target="#tab-modal-1" --}} selected="" value="ya">Bersedia Service</option>
                                        <option {{-- data-toggle="tab" data-target="#tab-modal-2" --}} value="ntar">Minta Dihubungi Kembali</option>
                                        <option {{-- data-toggle="tab" data-target="#tab-modal-3" --}} value="tidak">Tidak Bersedia Service</option>
                                    </select>
                                
                            </div>
                        </div>

                        <hr>
                            @csrf
                            <input type="hidden" id="id" name="id">
                            <div class="tab-content">
                                <div id="tab-modal-1" class="tab-pane animated fadeIn active">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Tanggal Melakukan Booking</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm datepicker" name="tanggalbooking">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-modal-2" class="tab-pane animated fadeIn">
                                    
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Tanggal di Follow Up lagi</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm datepicker" name="tanggalrefollowup">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Jam di Follow Up lagi</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm clockpicker" name="timerefollowup">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div id="tab-modal-3" class="tab-pane animated fadeIn">
                                    
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Alasan</label>
                                        </div>
                                        <div class="col-lg-8 col-lg-8 col-sm-8 col-xs-12">
                                            
                                                <select class="form-control input-sm" name="alasan">
                                                    <option value="" disabled="" selected="">~ Pilih Alasan ~</option>
                                                    @foreach($alasan as $row)
                                                        <option value="{{$row->r_reason}}">{{$row->r_reason}}</option>
                                                    @endforeach
                                                </select>
                                            
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-primary" id="fu1" type="button">Simpan</button>
                     
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}