<div class="modal-info-delete modal fade show" id="modal-info-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-info" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-info-body d-flex">
                    <div class="modal-info-icon warning">
                        <img src="{{ asset('assets/img/svg/alert-circle.svg') }} " alt="alert-circle" class="svg">
                    </div>

                    <div class="modal-info-text">
                        <h6>Do you Want to delete this stall?</h6>
                        <p>This action can't be reversed</p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-success btn-outlined btn-sm" data-bs-dismiss="modal" @click="deleteStall">Yes</button>

            </div>
        </div>
    </div>
</div>
