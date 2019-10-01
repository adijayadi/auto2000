
    {{-- Modal --}}
    <div class="modal" id="tindakan-detail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                    <h4 class="modal-title text-center">Detail Tindakan Service Advisor</h4>
                    
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <br>
                        <span id="staff"></span>
                    </div>

                    <hr>

                    <div class="table-responsive-x">
                        
                        <table class="table table-hover table-bordered" id="list">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Summary Tindakan</th>
                                    <th width="1%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center">1</td>
                                    <td>Data FU</td>
                                    <td align="center" id="satu"></td>
                                </tr>
                                <tr>
                                    <td align="center">2</td>
                                    <td>Data Process</td>
                                    <td align="center" id="dua"></td>
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td>Not Yet</td>
                                    <td align="center" id="tiga"></td>
                                </tr>
                                <tr>
                                    <td align="center">4</td>
                                    <td>Booking</td>
                                    <td align="center" id="empat"></td>
                                </tr>
                                <tr>
                                    <td align="center">5</td>
                                    <td>Not Booking</td>
                                    <td align="center" id="lima"></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}