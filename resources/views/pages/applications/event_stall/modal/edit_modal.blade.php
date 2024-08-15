<!-- Modal -->
<div class="modal fade new-member " id="edit-event-modal" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder="Event Name" name="event_name" v-model="editEventName">
                        </div>
                        <div class="form-group mb-20">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="event_detail" rows="3" placeholder="Event Detail" v-model="editEventDetail"></textarea>
                        </div>

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder="Location" name="event_location" v-model="editEventLocation">
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

                        <div class="d-flex new-member-calendar">
                            <div class="form-group w-100 me-sm-15 form-group-calender">
                                <label for="datepicker">start Date</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="datepicker" placeholder="dd/MM/yyyy" name="start_date" v-model="editStartDate">
                                    <a href="#">
                                        <img class="svg" src="{{ asset('assets/img/svg/chevron-right.svg') }}" alt="chevron-right.svg"></a>
                                </div>
                            </div>
                            <div class="form-group w-100 form-group-calender">
                                <label for="datepicker2">End Date</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="datepicker2" placeholder="dd/MM/yyyy" name="end_date" v-model="editEndDate">
                                    <a href="#">
                                        <img class="svg" src="{{ asset('assets/img/svg/chevron-right.svg') }}" alt="chevron-right.svg"></a>
                                </div>
                            </div>





                        </div>
                        <div class="button-group d-flex pt-25">


                            <button type="submit" @click.prevent="updateEvent()" class="btn btn-primary btn-default btn-squared text-capitalize">edit new event
                            </button>





                            <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light" data-bs-dismiss="modal">cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
