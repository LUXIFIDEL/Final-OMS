<div class="modal fade" style="z-index:999999999999" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form id="view_frm">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Order</h5>
                    <h6 id="prin_amount"></h6>
                    <h6 id="delivery_fee"></h6>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Customer Transaction Number:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="trans_no" class="form-control border-white" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Customer Name:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="customer" class="form-control border-white" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Customer Address:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="address" class="form-control border-white" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Customer Order:
                        </label>
                        <div class="col-lg-12">
                            <textarea name="order" class="form-control border-white"  id="validationCustom01" cols="20" rows="3" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>  
            </form>
        </div>
    </div>
  </div>
</div>


<div class="modal fade" style="z-index:999999999999" id="caModal" tabindex="-1" aria-labelledby="caModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form action="" 
                    method="post" 
                    class="needs-validation" 
                    novalidate="" 
                    enctype="multipart/form-data"
                    id="ca_frm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="caModalLabel">Cancelling..?</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" 
                            name="id">

                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" 
                                for="validationCustom01">
                            Reason for Cancelling
                        </label>
                        <div class="col-lg-12">
                            <textarea name="reason" 
                                        class="form-control" 
                                        id="validationCustom01"
                                        cols="30" 
                                        rows="5"></textarea>
                            @error('reason')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>  
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" style="z-index:999999999999" id="coModal" tabindex="-1" aria-labelledby="coModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form action="{{route('rider.transaction.update_co')}}" 
                    method="post" 
                    class="needs-validation" 
                    novalidate="" 
                    enctype="multipart/form-data"
                    id="co_frm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="coModalLabel">Completed..?</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" 
                            name="id">
                    <div class="modal-body">
                        <div class="flex text-center mb-2">
                        <i class="fa fa-question-circle fa-5x"></i>
                        </div>
                        Are you certain you want to mark this data as completed?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Later</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>  
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" style="z-index:999999999999" id="viewcaModal" tabindex="-1" aria-labelledby="viewcaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form id="viewca_frm">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewcaModalLabel">View Order</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Your Transaction Number:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="trans_no" class="form-control border-white" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Customer:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="customer" class="form-control border-white" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Customer Address:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="address" class="form-control border-white" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Customer Order:
                        </label>
                        <div class="col-lg-12">
                            <textarea name="order" class="form-control border-white"  id="validationCustom01" cols="20" rows="2" readonly></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Reason Cancelled Order:
                        </label>
                        <div class="col-lg-12">
                            <textarea name="reason" class="form-control border-white"  id="validationCustom01" cols="20" rows="2" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>  
            </form>
        </div>
    </div>
  </div>
</div>