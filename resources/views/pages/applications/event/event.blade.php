@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="project-progree-breadcrumb">
                    <div class="breadcrumb-main user-member justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">{{ trans('menu.event-title') }}</h4>
                                <span
                                    class="sub-title ms-sm-25 ps-sm-25">{{$activeEvents->count()}} Running events</span>
                            </div>
                        </div>


                        <div class="action-btn">
                            <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal"
                               data-bs-target="#new-member">
                                <i class="las la-plus fs-16"></i>create events</a>

                            @include('pages.applications.event.modal.create_modal')
                            @include('pages.applications.event.modal.edit_modal')
                            @include('pages.applications.event.modal.remove_modal')

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="project-top-wrapper project-top-progress d-flex justify-content-between flex-wrap">
                    <div
                        class="project-top-left d-flex flex-wrap justify-content-lg-between justify-content-center mt-n10">
                        <div class="project-tap global-shadow order-lg-1 order-2 my-10">
                            <ul class="nav px-1" id="ap-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="ap-overview-tab" data-bs-toggle="pill"
                                       href="#ap-overview" role="tab" aria-controls="ap-overview" aria-selected="true">all
                                        events</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="activity-tab" data-bs-toggle="pill" href="#activity"
                                       role="tab" aria-controls="activity" aria-selected="false">active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="late-tab" data-bs-toggle="pill" href="#late" role="tab"
                                       aria-controls="late" aria-selected="false">expired</a>
                                </li>

                            </ul>
                        </div>
                        <div
                            class="project-search project-search--height global-shadow ms-md-20 my-10 order-md-2 order-1">
                            <form action="{{route('event.event_list')}}"
                                  class="d-flex align-items-center user-member__form">
                                <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="search"
                                       v-model="search" onreset="console.log('reset')"
                                       placeholder="Search by Name/Detail" aria-label="Search">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="projects-tab-content projects-tab-content--progress">
            <div class="tab-content mt-25" id="ap-tabContent">
                <div class="tab-pane fade show active" id="ap-overview" role="tabpanel"
                     aria-labelledby="ap-overview-tab">
                    <div class="row">

                        @foreach($events as $event)

                            <div class="col-xl-4 mb-25 col-md-6">
                                <div class="user-group radius-xl bg-white media-ui media-ui--early pt-30 pb-25">
                                    <div class="border-bottom px-30">
                                        <div class="media user-group-media d-flex justify-content-between">
                                            <div
                                                class="media-body d-flex align-items-center flex-wrap text-capitalize my-sm-0 my-n2">
                                                <a href="{{route('event.event_detail')}}">
                                                    <h6 class="mt-0  fw-500 user-group media-ui__title">{{$event->name}}</h6>
                                                </a>

                                                @switch($event->status)
                                                    @case('active')
                                                        <span class="media-badge text-uppercase color-white bg-success">Active</span>
                                                        @break
                                                    @case('expired')
                                                        <span
                                                            class="my-sm-0 my-2 media-badge text-uppercase color-white bg-danger">expired</span>
                                                        @break

                                                @endswitch

                                            </div>
                                            <div class="mt-n15">
                                                <div class="dropdown dropleft">
                                                    <button class="btn-link border-0 bg-transparent p-0"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <img src="{{ asset('assets/img/svg/more-horizontal.svg') }}"
                                                             alt="more-horizontal" class="svg">
                                                    </button>
                                                    <div class="dropdown-menu dropdown-t-0">
                                                        {{--                                                  <a class="dropdown-item" href="#">view</a>--}}
                                                        <a class="dropdown-item"
                                                           href="{{ route('event.stall_list', ['id' => $event->id]) }}">Stalls</a>
                                                        <a class="dropdown-item" href="#"
                                                           @click="openEditModal({{$event->id}})">edit</a>
                                                        <a class="dropdown-item" href="#"
                                                           @click="openRemoveModal({{$event->id}})">remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-group-people mt-15 text-capitalize">
                                            <p>{{$event->detail}}</p>
                                            <div class="user-group-project">
                                                <div class="d-flex align-items-center user-group-progress-top">
                                                    <div class="media-ui__start">
                                                        <span class="color-light fs-12">Start Date</span>
                                                        <p class="fs-14 fw-500 color-dark mb-0">{{$event->start_date}}</p>
                                                    </div>
                                                    <div class="media-ui__end">
                                                        <span class="color-light fs-12">end date</span>
                                                        <p class="fs-16 fw-500 color-success mb-0">{{$event->end_date}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @endforeach


                    </div>
                    <div class="row">
                        <div class="col-lg-12">

{{--                            {{$events->links()}}--}}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-sm-end justify-content-star mt-1 mb-30">
                                <nav class="dm-page ">
                                    <ul class="dm-pagination d-flex">
                                        <li class="dm-pagination__item">


                                            <a href="#" class="dm-pagination__link pagination-control"><span
                                                    class="la la-angle-left"></span></a>
                                            <a href="#" class="dm-pagination__link"><span
                                                    class="page-number">1</span></a>
                                            <a href="#" class="dm-pagination__link active"><span
                                                    class="page-number">2</span></a>
                                            <a href="#" class="dm-pagination__link"><span
                                                    class="page-number">3</span></a>
                                            <a href="#" class="dm-pagination__link pagination-control"><span
                                                    class="page-number">...</span></a>
                                            <a href="#" class="dm-pagination__link"><span class="page-number">12</span></a>
                                            <a href="#" class="dm-pagination__link pagination-control"><span
                                                    class="la la-angle-right"></span></a>
                                            <a href="#" class="dm-pagination__option">
                                            </a>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                    <div class="row">
                        @foreach($activeEvents as $event)
                            <div class="col-xl-4 mb-25 col-md-6">
                                <div class="user-group radius-xl bg-white media-ui media-ui--completed pt-30 pb-25">
                                    <div class="border-bottom px-30">
                                        <div class="media user-group-media d-flex justify-content-between">
                                            <div class="media-body d-flex align-items-center text-capitalize">
                                                <a href="{{route('event.event_detail')}}">
                                                    <h6 class="mt-0  fw-500 media-ui__title">{{$event->name}}</h6>
                                                </a>
                                                <span
                                                    class="media-badge text-uppercase color-white bg-success">Active</span>
                                            </div>
                                            <div class="mt-n15">
                                                <div class="dropdown dropleft">
                                                    <button class="btn-link border-0 bg-transparent p-0"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <img src="{{ asset('assets/img/svg/more-horizontal.svg') }}"
                                                             alt="more-horizontal" class="svg">
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{--                                                    <a class="dropdown-item" href="#">view</a>--}}
                                                        <a class="dropdown-item" href="#">edit</a>
                                                        <a class="dropdown-item" href="#">remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-group-people mt-15 text-capitalize">
                                            <p>{{$event->detail}}</p>
                                            <div>
                                                <img src="{{ asset('assets/img/svg/more-horizontal.svg') }}"
                                                     alt="more-horizontal" class="svg">
                                            </div>
                                            <div class="user-group-project">
                                                <div class="d-flex align-items-center user-group-progress-top">
                                                    <div class="media-ui__start">
                                                        <span class="color-light fs-12">Start Date</span>
                                                        <p class="fs-14 fw-500 color-dark mb-0">{{$event->start_date}}</p>
                                                    </div>
                                                    <div class="media-ui__end">
                                                        <span class="color-light fs-12">end date</span>
                                                        <p class="fs-16 fw-500 color-success mb-0">{{$event->end_date}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-sm-end justify-content-star mt-1 mb-30">
                                <nav class="dm-page ">
                                    <ul class="dm-pagination d-flex">
                                        <li class="dm-pagination__item">
                                            <a href="#" class="dm-pagination__link pagination-control"><span
                                                    class="la la-angle-left"></span></a>
                                            <a href="#" class="dm-pagination__link"><span
                                                    class="page-number">1</span></a>
                                            <a href="#" class="dm-pagination__link active"><span
                                                    class="page-number">2</span></a>
                                            <a href="#" class="dm-pagination__link"><span
                                                    class="page-number">3</span></a>
                                            <a href="#" class="dm-pagination__link pagination-control"><span
                                                    class="page-number">...</span></a>
                                            <a href="#" class="dm-pagination__link"><span class="page-number">12</span></a>
                                            <a href="#" class="dm-pagination__link pagination-control"><span
                                                    class="la la-angle-right"></span></a>
                                            <a href="#" class="dm-pagination__option">
                                            </a>
                                        </li>
                                        <li class="dm-pagination__item">
                                            <div class="paging-option">
                                                <select name="page-number" class="page-selection">
                                                    <option value="20">20/page</option>
                                                    <option value="40">40/page</option>
                                                    <option value="60">60/page</option>
                                                </select>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="late" role="tabpanel" aria-labelledby="late-tab">
                    <div class="row">

                        @if($expiredEvents->count() > 0)
                            @foreach($expiredEvents as $event)
                                <div class="col-xl-4 mb-25 col-md-6">
                                    <div class="user-group radius-xl bg-white media-ui media-ui--late pt-30 pb-25">
                                        <div class="border-bottom px-30">
                                            <div class="media user-group-media d-flex justify-content-between">
                                                <div
                                                    class="media-body d-flex align-items-center flex-wrap text-capitalize my-sm-0 my-n2">
                                                    <a href={{route('event.event_detail')}}>
                                                        <h6 class="mt-0  fw-500 user-group media-ui__title">{{$event->name}}</h6>
                                                    </a>
                                                    <span
                                                        class="my-sm-0 my-2 media-badge text-uppercase color-white bg-danger">Expired</span>
                                                </div>
                                                <div class="mt-n15">
                                                    <div class="dropdown dropleft">
                                                        <button class="btn-link border-0 bg-transparent p-0"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <img src="{{ asset('assets/img/svg/more-horizontal.svg') }}"
                                                                 alt="more-horizontal" class="svg">
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            {{--<a class="dropdown-item" href="#">view</a>--}}
                                                            <a class="dropdown-item" href="#">edit</a>
                                                            <a class="dropdown-item" href="#">remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-group-people mt-15 text-capitalize">
                                                <p>{{$event->detail}}</p>
                                                <div class="user-group-project">
                                                    <div class="d-flex align-items-center user-group-progress-top">
                                                        <div class="media-ui__start">
                                                            <span class="color-light fs-12">Start Date</span>
                                                            <p class="fs-14 fw-500 color-dark mb-0">{{$event->start_date}}</p>
                                                        </div>
                                                        <div class="media-ui__end">
                                                            <span class="color-light fs-12">end date</span>
                                                            <p class="fs-16 fw-500 color-success mb-0">{{$event->end_date}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        @else



                        @endif


                    </div>
                    {{--                <div class="row">--}}
                    {{--                    <div class="col-lg-12">--}}
                    {{--                        <div class="d-flex justify-content-sm-end justify-content-star mt-1 mb-30">--}}
                    {{--                            <nav class="dm-page ">--}}
                    {{--                                <ul class="dm-pagination d-flex">--}}
                    {{--                                    <li class="dm-pagination__item">--}}
                    {{--                                        <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-left"></span></a>--}}
                    {{--                                        <a href="#" class="dm-pagination__link"><span class="page-number">1</span></a>--}}
                    {{--                                        <a href="#" class="dm-pagination__link active"><span class="page-number">2</span></a>--}}
                    {{--                                        <a href="#" class="dm-pagination__link"><span class="page-number">3</span></a>--}}
                    {{--                                        <a href="#" class="dm-pagination__link pagination-control"><span class="page-number">...</span></a>--}}
                    {{--                                        <a href="#" class="dm-pagination__link"><span class="page-number">12</span></a>--}}
                    {{--                                        <a href="#" class="dm-pagination__link pagination-control"><span class="la la-angle-right"></span></a>--}}
                    {{--                                        <a href="#" class="dm-pagination__option">--}}
                    {{--                                        </a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="dm-pagination__item">--}}
                    {{--                                        <div class="paging-option">--}}
                    {{--                                            <select name="page-number" class="page-selection">--}}
                    {{--                                                <option value="20">20/page</option>--}}
                    {{--                                                <option value="40">40/page</option>--}}
                    {{--                                                <option value="60">60/page</option>--}}
                    {{--                                            </select>--}}
                    {{--                                        </div>--}}
                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </nav>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        const {createApp} = Vue


        createApp({


            data() {
                return {
                    files: [],
                    eventFiles: [],
                    message: 'Hello Vue!',
                    selectedEvent: 0,
                    eventList: [],
                    search: '{{ $searchData }}',

                    editEventId: null,

                    editEventName: '',
                    editEventDetail: '',
                    editEventLocation: '',
                    editEventAddress1: '',
                    editEventAddress2: '',
                    editEventPostal: '',
                    editEventStartDate: '',
                    editEventEndDate: '',

                }
            },
            methods: {

                triggerUpload() {
                    this.$refs.uploadInput.click();
                },

                triggerEventImageUpload() {
                    this.$refs.uploadEventImageInput.click();
                },

                handleFileUpload(event) {
                    const selectedFiles = event.target.files;
                    for (let i = 0; i < selectedFiles.length; i++) {
                        const file = selectedFiles[i];
                        this.files.push({
                            name: file.name,
                            isError: false // You can add custom logic to set this to true
                        });
                    }
                },

                handleImageFileUpload(event) {
                    console.log('test')

                    const selectedFiles = event.target.files;
                    for (let i = 0; i < selectedFiles.length; i++) {
                        const file = selectedFiles[i];
                        this.eventFiles.push({
                            name: file.name,
                            isError: false // You can add custom logic to set this to true
                        });
                    }
                },


                removeFile(index) {
                    this.files.splice(index, 1);
                },
                removeEventImageFile(index) {
                    this.eventFiles.splice(index, 1);
                },

                searchEvent() {
                    axios.get('/event/search', {
                        params: {
                            search: this.search
                        }
                    })
                        .then(response => {
                            console.log(response.data)
                            this.eventList = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },

                openRemoveModal(id) {
                    $('#event-modal-delete').modal('show');
                    this.selectedEvent = id
                },
                openEditModal(id) {
                    $('#edit-event-modal').modal('show');
                    this.selectedEvent = id

                    axios.get('/event/info/' + id)
                        .then(response => {
                            console.log(response.data)
                            this.editEventId = response.data.id
                            this.editEventName = response.data.name
                            this.editEventDetail = response.data.detail
                            this.editEventLocation = response.data.location
                            this.editEventAddress1 = response.data.event_address_1
                            this.editEventAddress2 = response.data.event_address_2
                            this.editEventPostal = response.data.event_postal_code
                            this.editEventStartDate = response.data.start_date
                            this.editEventEndDate = response.data.end_date
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },
                updateEvent() {
                    axios.put('/event/info/' + this.selectedEvent, {
                        'event_name': this.editEventName,
                        'event_detail': this.editEventDetail,
                        'event_location': this.editEventLocation,
                        'event_address_1': this.editEventAddress1,
                        'event_address_2': this.editEventAddress2,
                        'event_postal_code': this.editEventPostal,
                        'start_date': this.editEventStartDate,
                        'end_date': this.editEventEndDate,
                    })
                        .then(response => {
                            console.log(response.data)
                            window.location.reload()
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },
                deleteEvent() {
                    axios.delete('/event/' + this.selectedEvent)
                        .then(response => {
                            console.log(response.data)
                            window.location.reload()
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },
                deleteEventImage(id) {
                    axios.post('/event/delete-image/' + id)
                        .then(response => {
                            console.log(response.data)
                            window.location.reload()
                        })
                        .catch(error => {
                            console.log(error)
                        })
                }
            }
        }).mount('#app')

    </script>

    <script>
        let timeSlotIndex = 1;
        let stallIndex = 1;

        function addTimeSlot() {
            const timeSlotsContainer = document.getElementById('time-slots');
            const newTimeSlot = document.createElement('div');
            newTimeSlot.classList.add('time-slot', 'mb-3', 'input-group');
            newTimeSlot.innerHTML = `
            <input type="date" class="form-control" name="time_slots[${timeSlotIndex}][date_from]" placeholder="Date From">
            <input type="date" class="form-control" name="time_slots[${timeSlotIndex}][date_to]" placeholder="Date To">
            <input type="time" class="form-control" name="time_slots[${timeSlotIndex}][time_from]" placeholder="Time From">
            <input type="time" class="form-control" name="time_slots[${timeSlotIndex}][time_to]" placeholder="Time To">
            <button type="button" class="btn btn-danger" onclick="removeTimeSlot(this)">Remove</button>
        `;
            timeSlotsContainer.appendChild(newTimeSlot);
            timeSlotIndex++;
        }

        function removeTimeSlot(button) {
            const timeSlot = button.parentNode;
            timeSlot.parentNode.removeChild(timeSlot);
        }

        function addStall() {
            const stallsContainer = document.getElementById('stalls');
            const newStall = document.createElement('div');
            newStall.classList.add('stall', 'mb-3', 'input-group');
            newStall.innerHTML = `
            <input type="text" class="form-control" name="stalls[${stallIndex}][category]" placeholder="Category">
            <input type="text" class="form-control" name="stalls[${stallIndex}][type]" placeholder="Type">
            <input type="number" class="form-control" name="stalls[${stallIndex}][count]" placeholder="Count">
            <input type="number" class="form-control" name="stalls[${stallIndex}][price]" placeholder="Price">
            <button type="button" class="btn btn-danger" onclick="removeStall(this)">Remove</button>
        `;
            stallsContainer.appendChild(newStall);
            stallIndex++;
        }

        function removeStall(button) {
            const stall = button.parentNode;
            stall.parentNode.removeChild(stall);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

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

            // Update time slots logic
            document.getElementById('time-slots').addEventListener('change', function (e) {
                if (e.target.name.includes('[date_from]') || e.target.name.includes('[date_to]')) {
                    let timeSlots = document.querySelectorAll('#time-slots .time-slot');
                    let timeSlotsArray = Array.from(timeSlots);
                    let overlappingError = false;

                    timeSlotsArray.forEach((slot, index) => {
                        let dateFrom = new Date(slot.querySelector('input[name*="[date_from]"]').value);
                        let dateTo = new Date(slot.querySelector('input[name*="[date_to]"]').value);

                        // Check for overlap with previous slots
                        for (let i = 0; i < index; i++) {
                            let prevDateFrom = new Date(timeSlotsArray[i].querySelector('input[name*="[date_from]"]').value);
                            let prevDateTo = new Date(timeSlotsArray[i].querySelector('input[name*="[date_to]"]').value);

                            if ((dateFrom >= prevDateFrom && dateFrom <= prevDateTo) ||
                                (dateTo >= prevDateFrom && dateTo <= prevDateTo) ||
                                (dateFrom <= prevDateFrom && dateTo >= prevDateTo)) {
                                overlappingError = true;
                                alert(`Time slot ${index + 1} overlaps with time slot ${i + 1}. Please correct it.`);
                                slot.querySelector('input[name*="[date_from]"]').value = '';
                                slot.querySelector('input[name*="[date_to]"]').value = '';
                                break;
                            }
                        }
                    });

                    if (overlappingError) {
                        // Prevent form submission or other necessary actions
                    }
                }
            });
        });
    </script>
@endsection
