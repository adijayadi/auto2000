
    {{-- Modal --}}
    <div class="modal" id="detail_tindakan_2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h4 class="modal-title text-center">Tindakan Service Advisor ke 2</h4>
                    
                </div>
                <div class="modal-body">
                    <div class="tabs-container">
                        
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Hasil Tindakan</label>
                            </div>
                            <div class="col-lg-8 col-lg-8 col-sm-8 col-xs-12">
                                
                                    <select class="form-control input-sm" name="tindakan-2">
                                        <option selected="" value="ya" >Bersedia Service</option>
                                        <option value="tidak" data-toggle="tab" data-target="#tab-modal-2-3">Tidak Bersedia Service</option>
                                    </select>
                                
                            </div>
                        </div>

                        <hr>

                        <form id="form_tindakan2">
                            @csrf
                            <input type="hidden" id="id2" name="id2">
                            <div class="tab-content">
                                <div id="tab-modal-2-1" class="tab-pane animated fadeIn active">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Tanggal Melakukan Booking</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm datepicker" name="tanggalbooking2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-modal-2-3" class="tab-pane animated fadeIn">
                                    
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Alasan</label>
                                        </div>
                                        <div class="col-lg-8 col-lg-8 col-sm-8 col-xs-12">
                                            
                                                <select class="form-control input-sm" name="alasan2">
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
                    <button class="btn btn-primary" id="fu2" type="button">Simpan</button>
                     
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}