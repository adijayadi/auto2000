
    {{-- Modal --}}
    <div class="modal" id="modal-ganti-satu" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h4 class="modal-title text-center">Ganti Service Advisor</h4>
                    
                </div>
                <form id="modaladv">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-sm-4 col-xs-12">
                                <label>Service Advisor Baru</label>
                            </div>

                            <div class="col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <select class=" form-control input-sm select2" name="newadvisor">
                                        <option value="" hidden>~ Pilih Service Advisor Baru ~</option>
                                        @foreach($advisor as $row)
                                            <option value="{{$row->u_code}}">{{$row->u_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer text-right">
                    <button class="btn btn-primary" id="gantib" type="button">Simpan</button>
                     
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}