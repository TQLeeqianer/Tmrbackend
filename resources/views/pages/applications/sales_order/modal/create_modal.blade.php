<!-- Modal -->
<div class="modal fade new-member" id="new-member" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-xl">
            <div class="modal-header">
                <h6 class="modal-title fw-500" id="staticBackdropLabel">Create Event</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg">
                </button>
            </div>
            <div class="modal-body">
                <div class="new-member-modal">
                    <form action="{{ route('event.store_event') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="event_name">Event Name</label>
                                    <input type="text" class="form-control " id="event_name" name="event_name"
                                           placeholder="Event Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="event_location">Location</label>
                                    <input type="text" class="form-control" id="event_location" name="event_location"
                                           placeholder="Location">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="event_address1">Address 1</label>
                                    <input type="text" class="form-control" id="event_address1" name="event_address1"
                                           placeholder="Address 1">
                                </div>
                                <div class="col-md-6">
                                    <label for="event_address2">Address 2</label>
                                    <input type="text" class="form-control" id="event_address2" name="event_address2"
                                           placeholder="Address 2">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="event_postal">Postal Code</label>
                                    <input type="text" class="form-control" id="event_postal" name="event_postal"
                                           placeholder="Postal Code">
                                </div>
                                <div class="col-md-6">
                                    <label for="event_detail">Event Detail</label>
                                    <textarea class="form-control" id="event_detail" name="event_detail" rows="3"
                                              placeholder="Event Detail"></textarea>
                                </div>
                            </div>


                            <div class="form-group mb-20">
                                <div class="dm-tag-wrap">
                                    <div class="dm-upload">
                                        <div class="dm-upload__button">
                                            <button @click.prevent="triggerEventImageUpload"
                                                    class="btn btn-lg btn-outline-lighten btn-upload">
                                                <img src="{{asset('assets/img/svg/upload.svg')}}" alt="upload"
                                                     class="svg"/> Upload Event Image
                                            </button>
                                            <input type="file" name="upload-event-image" class="upload-event-image"
                                                   id="upload" accept="image/png, image/jpeg"
                                                   @change="handleImageFileUpload" ref="uploadEventImageInput"
                                                   style="display: none"/>
                                        </div>
                                        <div class="dm-upload__file" v-if="eventFiles.length > 0">
                                            <ul>
                                                <li v-for="(file, index) in eventFiles" :key="index"
                                                    :class="{ 'danger': file.isError }">
                                                    <a href="#" class="file-name"><i class="las la-paperclip"></i> <span
                                                            class="name-text">@{{ file.name }}</span></a>
                                                    <button @click.prevent="removeEventImageFile(index)"
                                                            class="btn-delete"><i
                                                            class="la la-trash"></i></button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--Event Map Image--}}
                            <div class="form-group mb-20">
                                <div class="dm-tag-wrap">
                                    <div class="dm-upload">
                                        <div class="dm-upload__button">
                                            <button @click.prevent="triggerUpload"
                                                    class="btn btn-lg btn-outline-lighten btn-upload">
                                                <img src="{{asset('assets/img/svg/upload.svg')}}" alt="upload"
                                                     class="svg"/> Upload Stall Map Image
                                            </button>
                                            <input type="file" name="upload-event-map-image"
                                                   class="upload-event-map-image" id="upload"
                                                   accept="image/png, image/jpeg"
                                                   @change="handleFileUpload" ref="uploadInput" style="display: none"/>
                                        </div>
                                        <div class="dm-upload__file" v-if="files.length > 0">
                                            <ul>
                                                <li v-for="(file, index) in files" :key="index"
                                                    :class="{ 'danger': file.isError }">
                                                    <a href="#" class="file-name"><i class="las la-paperclip"></i> <span
                                                            class="name-text">@{{ file.name }}</span></a>
                                                    <button @click.prevent="removeFile(index)" class="btn-delete"><i
                                                            class="la la-trash"></i></button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-20">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                           onchange="setMinDate()">
                                </div>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="end_date" id="end_date"
                                           onchange="setMinDate()">
                                </div>
                            </div>
                            <div class="form-group mb-20">
                                <label>Time Slots</label>
                                <div id="time-slots">
                                    <div class="time-slot mb-3 input-group">
                                        <input type="date" class="form-control" name="time_slots[0][date_from]"
                                               placeholder="Date From">
                                        <input type="date" class="form-control" name="time_slots[0][date_to]"
                                               placeholder="Date To">
                                        <input type="time" class="form-control" name="time_slots[0][time_from]"
                                               placeholder="Time From">
                                        <input type="time" class="form-control" name="time_slots[0][time_to]"
                                               placeholder="Time To">
                                        <button type="button" class="btn btn-danger" onclick="removeTimeSlot(this)">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" onclick="addTimeSlot()">Add Time
                                    Slot
                                </button>
                            </div>
                            <div class="form-group mb-20">
                                <label>Stalls</label>
                                <div id="stalls">
                                    <div class="stall mb-3 input-group">
                                        <input type="text" class="form-control" name="stalls[0][category]"
                                               placeholder="Category">
                                        <input type="text" class="form-control" name="stalls[0][type]"
                                               placeholder="Type">
                                        <input type="number" class="form-control" name="stalls[0][count]"
                                               placeholder="Count">
                                        <input type="number" class="form-control" name="stalls[0][price]"
                                               placeholder="Price">
                                        <button type="button" class="btn btn-danger" onclick="removeStall(this)">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" onclick="addStall()">Add Stall
                                </button>
                            </div>
                            <div class="button-group d-flex pt-25">
                                <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize">
                                    Add New Event
                                </button>
                                <button type="button"
                                        class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light"
                                        data-bs-dismiss="modal">Cancel
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
