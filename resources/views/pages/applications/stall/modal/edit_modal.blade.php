<!-- Modal -->
<div class="modal fade new-member " id="edit-stall-modal" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content  radius-xl">
            <div class="modal-header">
                <h6 class="modal-title fw-500" id="staticBackdropLabel">Edit stall</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg">
                </button>
            </div>
            <div class="modal-body">
                <div class="new-member-modal">

                    <form>
                        @csrf


                        <div class="form-group mb-20">
                            <select class="form-control px-15" id="exampleFormControlSelect1" name="event_id" v-model="editEventId">
                                <option v-for="event in eventList" :value="event.id">@{{ event.event_name }}</option>
                            </select>
                        </div>

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder="Stall Name" name="stall_name" v-model="editStallName">
                        </div>
                        <div class="form-group mb-20">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="stall_detail" rows="3" placeholder="Stall Detail" v-model="editStallDetail"></textarea>
                        </div>

                        <div class="form-group mb-20">
                            <input type="text" class="form-control" placeholder="Location" name="stall_location" v-model="editStallLocation">
                        </div>


                        <div class="form-group mb-20">
                            <div class="dm-tag-wrap">
                                <div class="dm-upload">
                                    <div class="dm-upload__button">
                                        <a href="javascript:void(0)" class="btn btn-lg btn-outline-lighten btn-upload" onclick="$('#upload-1').click()"> <img src="{{ asset('assets/img/svg/upload.svg') }}" alt="upload" class="svg"> Upload Stall Image </a>
                                        <input type="file" name="stall_image" class="upload-one" id="upload-1" accept="image/jpeg, image/png">
                                    </div>
                                    <div class="dm-upload__file">
                                        <ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-group d-flex pt-25">


                            <button type="submit" @click.prevent="updateStall()" class="btn btn-primary btn-default btn-squared text-capitalize">edit new stall
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
