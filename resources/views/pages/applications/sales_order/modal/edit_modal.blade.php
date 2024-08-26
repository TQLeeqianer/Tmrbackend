<!-- Modal -->
<div class="modal fade new-member " id="edit-event-modal" role="dialog" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content  radius-xl">
            <div class="modal-header">
                <h6 class="modal-title fw-500" id="staticBackdropLabel">Edit event</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg">
                </button>
            </div>
            <div class="modal-body">
                <div class="new-member-modal">

                    <form>
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="event_name">Event Name</label>
                                <input type="text" class="form-control" id="event_name" name="event_name" v-model="editEventName"
                                       placeholder="Event Name">
                            </div>
                            <div class="col-md-6">
                                <label for="event_location">Location</label>
                                <input type="text" class="form-control" id="event_location" name="event_location" v-model="editEventLocation"
                                       placeholder="Location">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="event_address1">Address 1</label>
                                <input type="text" class="form-control" id="event_address1" name="event_address1" v-model="editEventAddress1"
                                       placeholder="Address 1">
                            </div>
                            <div class="col-md-6">
                                <label for="event_address2">Address 2</label>
                                <input type="text" class="form-control" id="event_address2" name="event_address2" v-model="editEventAddress2"
                                       placeholder="Address 2">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="event_postal">Postal Code</label>
                                <input type="text" class="form-control" id="event_postal" name="event_postal" v-model="editEventPostal"
                                       placeholder="Postal Code">
                            </div>
                            <div class="col-md-6">
                                <label for="event_detail">Event Detail</label>
                                <textarea class="form-control" id="event_detail" name="event_detail" rows="3" v-model="editEventDetail"
                                          placeholder="Event Detail"></textarea>
                            </div>
                        </div>

                        <div class="row mb-20">
                            <div class="col-md-6">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" v-model="editEventStartDate"
                                       onchange="setMinDate()">
                            </div>
                            <div class="col-md-6">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" v-model="editEventEndDate"
                                       onchange="setMinDate()">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="event_image">Event Image</label>

                            </div>
                            <div class="col-md-6">
                                <label for="stall_map_image">Stall Map Image</label>

                            </div>
                        </div>

                        <div class="form-group mb-20">
                            <div class="dm-tag-wrap">
                                <div class="dm-upload">
                                    <div class="dm-upload__button">
                                        {{-- <a href="javascript:void(0)" class="btn btn-lg btn-outline-lighten btn-upload" onclick="$('#upload-1').click()"> <img src="{{ asset('assets/img/svg/upload.svg') }}" alt="upload" class="svg"> Upload Event Image </a>
                                        <input type="file" name="event_image" class="upload-one" id="upload-1" accept="image/jpeg, image/png">
                                    </div> --}}
                                        <div class="dm-upload__file">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="button-group d-flex pt-25">


                                <button type="submit" @click.prevent="updateEvent()"
                                        class="btn btn-primary btn-default btn-squared text-capitalize">edit new event
                                </button>


                                <button type="button"
                                        class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light"
                                        data-bs-dismiss="modal">cancel
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->




