<!-- Modal -->
<div class="modal fade new-member " id="new-member" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content  radius-xl">
            <div class="modal-header">
                <h6 class="modal-title fw-500" id="staticBackdropLabel">Create event</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg">
                </button>
            </div>
            <div class="modal-body">
                <div class="new-member-modal">
                    <form action="{{route('event.store_event')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder="Event Name" name="event_name">
                        </div>
                        <div class="form-group mb-20">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="event_detail" rows="3" placeholder="Event Detail"></textarea>
                        </div>

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder="Location" name="event_location">
                        </div>

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder="address1" name="event_address1">
                        </div>

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder="address2" name="event_address2">
                        </div>

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder=" postalcode" name="event_postal">
                        </div>


                        <div class="form-group mb-20">
                            <div class="dm-tag-wrap">
                                <div class="dm-upload">
                                    <div class="dm-upload__button">
                                        <a href="javascript:void(0)" class="btn btn-lg btn-outline-lighten btn-upload" onclick="$('#upload-1').click()"> <img src="{{ asset('assets/img/svg/upload.svg') }}" alt="upload" class="svg"> Upload Event Image </a>
                                        <input type="file" name="event_image" class="upload-one" id="upload-1" accept="image/jpeg, image/png">
                                    </div>
                                    <div class="dm-upload__file">
                                        <ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" name="start_date" id="start_date" onchange="setMinDate()">
                            </div>
                            <div class="col-md-6">
                                <input type="date" name="end_date" id="end_date" onchange="setMinDate()">
                            </div>
                        </div>

                        <div class="button-group d-flex pt-25">
                            <button class="btn btn-primary btn-default btn-squared text-capitalize">add new event</button>
                            <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light" data-bs-dismiss="modal">cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        const formatDateString = (date) => {
            const d = new Date(date);
            const day = (`0${d.getDate()}`).slice(-2);
            const month = (`0${d.getMonth() + 1}`).slice(-2);
            const year = d.getFullYear();
            return `${day}/${month}/${year}`;
        };

        const parseDateString = (dateString) => {
            const parts = dateString.split('/');
            return new Date(parts[2], parts[1] - 1, parts[0]);
        };

        const setCurrentDate = () => {
            const currentDate = new Date().toISOString().split('T')[0];
            startDateInput.value = currentDate;
            endDateInput.min = currentDate;
        };

        const setMinDate = () => {
            const startDate = startDateInput.value;
            endDateInput.min = startDate;

            if (endDateInput.value && endDateInput.value < startDate) {
                endDateInput.value = startDate;
                alert("End date should not be earlier than start date. It has been reset to the start date.");
            }
        };

        setCurrentDate();
        startDateInput.addEventListener('change', setMinDate);
        endDateInput.addEventListener('change', setMinDate);
    });
</script>
