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
                                <h4 class="text-capitalize fw-500 breadcrumb-title">{{ trans('menu.stall-title') }}</h4>
                                <span
                                    {{--                                    class="sub-title ms-sm-25 ps-sm-25">{{$activeStalls->count()}} Running events</span>--}}
                                    class="sub-title ms-sm-25 ps-sm-25">0 Running stalls </span>
                            </div>
                        </div>
                        <div class="action-btn">
                            <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal"
                               data-bs-target="#new-member">
                                <i class="las la-plus fs-16"></i>create stalls</a>

                            @include('pages.applications.stall.modal.create_modal')
                            @include('pages.applications.stall.modal.edit_modal')
                            @include('pages.applications.stall.modal.remove_modal')

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
                                        stalls</a>
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
                            <form action="/" class="d-flex align-items-center user-member__form">
                                <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                <input class="form-control me-sm-2 border-0 box-shadow-none" type="search"
                                       placeholder="Search by Name" aria-label="Search">
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

                        @foreach($stalls as $stall)

                            <div class="col-xl-4 mb-25 col-md-6">
                                <div class="user-group radius-xl bg-white media-ui media-ui--early pt-30 pb-25">
                                    <div class="border-bottom px-30">
                                        <div class="media user-group-media d-flex justify-content-between">
                                            <div
                                                class="media-body d-flex align-items-center flex-wrap text-capitalize my-sm-0 my-n2">
                                                <a href="{{route('event.event_detail')}}">
                                                    <h6 class="mt-0  fw-500 user-group media-ui__title">{{$stall->name}}</h6>
                                                </a>

                                                @switch($stall->status)
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
{{--                                                        <a class="dropdown-item" href="#">view</a>--}}
                                                        <a class="dropdown-item" href="#" @click="openEditModal({{$stall->id}})">edit</a>
                                                        <a class="dropdown-item" href="#"
                                                           @click="openRemoveModal({{$stall->id}})">remove</a>


                                                        {{--                                                        <button type="button"--}}
                                                        {{--                                                                class="dropdown-item"--}}
                                                        {{--                                                                data-bs-toggle="modal"--}}
                                                        {{--                                                                data-bs-target="#modal-info-delete" @click.prevent="selectStall({{$stall->id}})">Delete--}}
                                                        {{--                                                        </button>--}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-group-people mt-15 text-capitalize">
                                            <p>{{$stall->detail}}</p>
                                            <div class="user-group-project">
                                                <div class="d-flex align-items-center user-group-progress-top">
                                                    <div class="media-ui__start">
                                                        <span class="color-light fs-12">Event Name</span>
                                                        {{--<p class="fs-14 fw-500 color-dark mb-0">{{$stall->event->name}}</p>--}}
                                                    </div>
                                                    <div class="media-ui__end">
                                                        <span class="color-light fs-12">Location</span>
                                                        <p class="fs-16 fw-500 color-success mb-0">{{$stall->location}}</p>
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


                <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                    <div class="row">
                        @foreach($activeStalls as $stall)
                            <div class="col-xl-4 mb-25 col-md-6">
                                <div class="user-group radius-xl bg-white media-ui media-ui--completed pt-30 pb-25">
                                    <div class="border-bottom px-30">
                                        <div class="media user-group-media d-flex justify-content-between">
                                            <div class="media-body d-flex align-items-center text-capitalize">
                                                <a href="{{route('event.event_detail')}}">
                                                    <h6 class="mt-0  fw-500 media-ui__title">{{$stall->name}}</h6>
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
{{--                                                        <a class="dropdown-item" href="#">view</a>--}}
                                                        <a class="dropdown-item" href="#">edit</a>
                                                        <a class="dropdown-item" href="#">remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-group-people mt-15 text-capitalize">
                                            <p>{{$stall->detail}}</p>
                                            <div class="user-group-project">
                                                <div class="d-flex align-items-center user-group-progress-top">
                                                    <div class="media-ui__start">
                                                        <span class="color-light fs-12">Start Date</span>
                                                        <p class="fs-14 fw-500 color-dark mb-0">{{$stall->start_date}}</p>
                                                    </div>
                                                    <div class="media-ui__end">
                                                        <span class="color-light fs-12">end date</span>
                                                        <p class="fs-16 fw-500 color-success mb-0">{{$stall->end_date}}</p>
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
                                <nav class="dm-page">
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

                        {{--                        @if($expiredStalls->count() > 0)--}}
                        @foreach($expiredStalls as $stall)
                            <div class="col-xl-4 mb-25 col-md-6">
                                <div class="user-group radius-xl bg-white media-ui media-ui--late pt-30 pb-25">
                                    <div class="border-bottom px-30">
                                        <div class="media user-group-media d-flex justify-content-between">
                                            <div
                                                class="media-body d-flex align-items-center flex-wrap text-capitalize my-sm-0 my-n2">
                                                <a href={{route('event.event_detail')}}>
                                                    <h6 class="mt-0  fw-500 user-group media-ui__title">{{$stall->name}}</h6>
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
{{--                                                        <a class="dropdown-item" href="#">view</a>--}}
                                                        <a class="dropdown-item" href="#">edit</a>
                                                        <a class="dropdown-item" href="#">remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-group-people mt-15 text-capitalize">
                                            <p>{{$stall->detail}}</p>
                                            <div class="user-group-project">
                                                <div class="d-flex align-items-center user-group-progress-top">
                                                    <div class="media-ui__start">
                                                        <span class="color-light fs-12">Start Date</span>
                                                        <p class="fs-14 fw-500 color-dark mb-0">{{$stall->start_date}}</p>
                                                    </div>
                                                    <div class="media-ui__end">
                                                        <span class="color-light fs-12">end date</span>
                                                        <p class="fs-16 fw-500 color-success mb-0">{{$stall->end_date}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                        {{--                        @else--}}
                        {{--                        @endif--}}


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
                    message: 'Hello Vue!',
                    selectedStall: 0,

                    eventList: [],

                    editEventId: null,

                    editStallName: '',
                    editStallDetail: '',
                    editStallLocation: '',
                }
            },
            methods: {



                openRemoveModal(id) {
                    $('#modal-info-delete').modal('show');
                    this.selectedStall = id
                },
                openEditModal(id) {
                    $('#edit-stall-modal').modal('show');
                    this.selectedStall = id

                    axios.get('/stall/info/' + id)
                        .then(response => {
                            console.log(response.data)
                            this.editEventId = response.data.event_id
                            this.editStallName = response.data.name
                            this.editStallDetail = response.data.detail
                            this.editStallLocation = response.data.location
                        })
                        .catch(error => {
                            console.log(error)
                        })


                    axios.get('/event/active-list')
                        .then(response => {
                            console.log(response.data)
                            this.eventList = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },
                updateStall() {

                    console.log(this.editEventId)

                    axios.put('/stall/info/' + this.selectedStall, {
                        event_id: this.editEventId,
                        stall_name: this.editStallName,
                        stall_detail: this.editStallDetail,
                        stall_location: this.editStallLocation,
                    })
                        .then(response => {
                            console.log(response.data)
                            // window.location.reload()
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },
                deleteStall() {
                    axios.delete('/stall/' + this.selectedStall)
                        .then(response => {
                            // this.$toast("I'm a toast!", {
                            //     position: "top-right",
                            //     timeout: 5000,
                            //     closeOnClick: true,
                            //     pauseOnFocusLoss: true,
                            //     pauseOnHover: true,
                            //     draggable: true,
                            //     draggablePercent: 0.6,
                            //     showCloseButtonOnHover: false,
                            //     hideProgressBar: true,
                            //     closeButton: "button",
                            //     icon: true,
                            //     rtl: false
                            // });

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
@endsection
