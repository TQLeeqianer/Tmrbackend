@section('title', $title)
@section('description', $description)
@extends('layout.app')
@section('content')
    {{--    <div class="container-fluid" ng-app="salesOrderApp" ng-controller="SalesOrderController">--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between">
                    <div class="d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        {{--                        <form action="/" class="d-flex align-items-center user-member__form my-sm-0 my-2">--}}
                        {{--                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">--}}
                        {{--                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search"--}}
                        {{--                                   placeholder="Search by Customer Name" aria-label="Search" ng-model="searchQuery">--}}
                        {{--                        </form>--}}
                    </div>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal"
                           data-bs-target="#new-sales-order">
                            <i class="las la-plus fs-16"></i>Add New Sales Order</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-30">
                <div class="support-ticket-system support-ticket-system--search">
                    <div class="breadcrumb-main m-0 breadcrumb-main--table justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div
                                class="d-flex align-items-center ticket__title justify-content-center me-md-25 mb-md-0 mb-20">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Sales Order Data Table</h4>
                            </div>
                        </div>
                        {{--                        <div class="action-btn">--}}
                        {{--                            <a href="#" class="btn btn-primary">--}}
                        {{--                                Export--}}
                        {{--                                <i class="las la-angle-down"></i>--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}
                    </div>
                    <div
                        class="support-form datatable-support-form d-flex justify-content-xxl-between justify-content-center align-items-center flex-wrap">
                        <div class="support-form__input">
                            <div class="d-flex flex-wrap">
                                {{--                                <div class="support-form__input-id">--}}
                                {{--                                    <label>Id:</label>--}}
                                {{--                                    <div class="dm-select ">--}}
                                {{--                                        <select name="select-search" class="select-search form-control ">--}}
                                {{--                                            <option value="01">All</option>--}}
                                {{--                                            <option value="02">Option 2</option>--}}
                                {{--                                            <option value="03">Option 3</option>--}}
                                {{--                                            <option value="04">Option 4</option>--}}
                                {{--                                            <option value="05">Option 5</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="support-form__input-status">
                                    <label>status:</label>
                                    <div class="dm-select ">
                                        <select v-model="filterData" name="select-search" class="select2 form-control ">
                                            <option value="all" selected>All</option>
                                            <option value="pending">Pending</option>
                                            <option value="cancel">Cancel</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="support-form__input-button">search</button>
                            </div>
                        </div>
                        <div class="support-form__search">
                            <div class="support-order-search">
                                <form action="/" class="support-order-search__form">
                                    <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                    <input class="form-control border-0 box-shadow-none" type="search"
                                           placeholder="Search" aria-label="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="userDatatable userDatatable--ticket userDatatable--ticket--2 mt-1">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title">ID</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Buyer Name</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Order Number</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Total Price</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Status</span>
                                    </th>
                                    <th class="actions">
                                        <span class="userDatatable-title">Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                <!-- If there are no sales orders -->
                                <tr v-if="orders.length === 0">
                                    <td colspan="6" class="text-center">No sales orders found.</td>
                                </tr>

                                <tr v-for="(order, index) in orders">
                                    <td>#@{{ index }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="userDatatable-inline-title">
                                                <h6 class="text-dark fw-500">@{{ order.customer_name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content--subject">
                                            @{{ order.order_number }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="userDatatable-content--subject">
                                            RM @{{ order.total_price }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="userDatatable-content d-inline-block">
                                            <!--Cancel -->
                                            <span v-if="order.status === 'cancel'"
                                                  class="bg-opacity-danger  color-danger userDatatable-content-status">Cancel</span>

                                            <!--Pending -->
                                            <span v-else-if="order.status === 'pending'"
                                                  class="bg-opacity-warning  color-warning userDatatable-content-status">Pending</span>

                                            <!--Paid -->
                                            <span v-else-if="order.status === 'paid'"
                                                  class="bg-opacity-success  color-success userDatatable-content-status active">Paid</span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">

                                            <li v-if="order.status === 'pending'">
                                                <!-- Button to edit the order -->
                                                <a href="#" class="edit" @click.prevent="updateStatus(order)"
                                                   data-bs-toggle="modal" data-bs-target="#update-sales-order-status">
                                                    <i class="uil uil-edit"></i>
                                                </a>
{{--                                                <a href="#" class="edit">--}}
{{--                                                    <i class="uil uil-edit">--}}
{{--                                                        --}}
{{--                                                    </i>--}}
{{--                                                </a>--}}
                                            </li>

                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {{--                        <div class="d-flex justify-content-end pt-30">--}}
                        {{--                            <nav class="dm-page ">--}}
                        {{--                                <ul class="dm-pagination d-flex">--}}
                        {{--                                    <li class="dm-pagination__item">--}}
                        {{--                                        <a href="#" class="dm-pagination__link pagination-control"><span--}}
                        {{--                                                class="la la-angle-left"></span></a>--}}
                        {{--                                        <a href="#" class="dm-pagination__link"><span class="page-number">1</span></a>--}}
                        {{--                                        <a href="#" class="dm-pagination__link active"><span--}}
                        {{--                                                class="page-number">2</span></a>--}}
                        {{--                                        <a href="#" class="dm-pagination__link"><span class="page-number">3</span></a>--}}
                        {{--                                        <a href="#" class="dm-pagination__link pagination-control"><span--}}
                        {{--                                                class="page-number">...</span></a>--}}
                        {{--                                        <a href="#" class="dm-pagination__link"><span class="page-number">12</span></a>--}}
                        {{--                                        <a href="#" class="dm-pagination__link pagination-control"><span--}}
                        {{--                                                class="la la-angle-right"></span></a>--}}
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
                    </div>
                </div>
            </div>
        </div>

        {{--        <div class="row">--}}
        {{--            <div class="cos-xl-2 col-lg-4 mb-30 col-sm-6" ng-repeat="order in orders">--}}
        {{--                <div class="card position-relative user-member-card">--}}
        {{--                    <div class="card-body text-center p-30">--}}
        {{--                        <div class="account-profile">--}}
        {{--                            <div class="ap-nameAddress pb-3">--}}
        {{--                                <h6 class="ap-nameAddress__title">@{{ order.customer_name }}</h6>--}}
        {{--                                <p class="ap-nameAddress__subTitle fs-13 pt-1 m-0">Order Number: @{{ order.order_number }}</p>--}}
        {{--                                <p class="ap-nameAddress__subTitle fs-13 pt-1 m-0">Status: @{{ order.status }}</p>--}}
        {{--                                <p class="ap-nameAddress__subTitle fs-13 pt-1 m-0">Total Price: RM @{{ order.total_price }}</p>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <div class="tm-card-overlay position-absolute">--}}
        {{--                            <div class="dropdown dropdown-click">--}}
        {{--                                <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
        {{--                                    <img class="svg" src="{{ asset('assets/img/svg/more-horizontal.svg') }}" alt="more-horizontal">--}}
        {{--                                </button>--}}
        {{--                                <div class="dropdown-default dropdown-bottomRight dropdown-menu">--}}
        {{--                                    <a class="dropdown-item" href="#" ng-click="editOrder(order)" data-bs-toggle="modal" data-bs-target="#new-sales-order">Edit</a>--}}
        {{--                                    <a class="dropdown-item" href="#" ng-click="deleteOrder(order.id)">Delete</a>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}




        <!-- Modal for Adding/Editing Sales Order -->
        <div class="modal fade" id="new-sales-order" tabindex="-1" aria-labelledby="newSalesOrderModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content radius-xl">
                    <div class="modal-header">
                        {{--                        <h5 class="modal-title" id="newSalesOrderModalLabel">@{{ order.id ? 'Edit Sales Order' : 'Add New Sales Order' }}</h5>--}}
                        <h5 class="modal-title" id="newSalesOrderModalLabel">Add New Sales Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <!-- Button trigger search customer modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#search-customer">
                                Search Customer
                            </button>

                            <p v-if="!isValidateCustomer" class="text-danger">Please select customer first</p>

                        </div>

                        <form>
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer ID</label>
                                <input type="text" class="form-control" id="customer_id" readonly v-model="customer.id">
                            </div>

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" readonly
                                       v-model="customer.name">
                            </div>

                            {{--                            <div class="mb-3">--}}
                            {{--                                <label for="status" class="form-label">Order Status</label>--}}
                            {{--                                <input type="text" class="form-control" id="status" required>--}}
                            {{--                            </div>--}}

                            <div class="mb-3">
                                <label for="event" class="form-label">Event</label>
                                <select class="form-control" id="event" v-model="selectedEvent" required>
                                    <option value="" disabled selected>Select an Event</option>
                                    <option v-for="event in events" :value="event.id">
                                        @{{ event.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="timeslot" class="form-label">Timeslot</label>
                                <select class="form-control" id="timeslot" v-model="selectedTimeslot" required>
                                    <option value="" disabled selected>Select a Timeslot</option>

                                    <option v-for="timeslot in timeslots" :value="timeslot.time_slot_id">
                                        @{{ customDateFormat(timeslot.date_from) }} @{{ timeslot.time_from }} ---
                                        @{{ customDateFormat(timeslot.date_to) }} @{{ timeslot.time_to }}
                                    </option>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="event_stall" class="form-label">Event Stall</label>
                                <p v-if="!isValidation" class="text-danger">Please select stall first</p>


                                {{--                                    <div class="stall mb-3 input-group" v-for="(stall, index) in selectedEventStall">--}}
                                {{--                                        <select class="form-control" id="event_stall" required v-model="stall.stall_id">--}}
                                {{--                                            <option value="" disabled selected>Select a Stall</option>--}}

                                {{--                                            <option v-for="stall in eventStalls" :value="stall.stall_id">--}}
                                {{--                                                @{{ stall.stall_type }} - @{{ stall.stall_count }}--}}
                                {{--                                            </option>--}}
                                {{--                                        </select>--}}
                                {{--                                        <button type="button" class="btn btn-danger" @click.prevent="removeSelectedStall(index)">--}}
                                {{--                                            Remove--}}
                                {{--                                        </button>--}}
                                {{--                                    </div>--}}

                                {{--                                <div class="stall mb-3 input-group" v-for="(stall, index) in selectedEventStall"--}}
                                {{--                                     :key="index">--}}
                                {{--                                    <select class="form-control" id="event_stall" required v-model="stall.stall_id">--}}
                                {{--                                        <option value="" disabled>Select a Stall</option>--}}
                                {{--                                        <!-- 使用计算属性过滤 eventStalls -->--}}
                                {{--                                        <option v-for="availableStall in filteredEventStalls(index)"--}}
                                {{--                                                :key="availableStall.stall_id" :value="availableStall.stall_id">--}}
                                {{--                                            @{{ availableStall.stall_type }} - @{{ availableStall.stall_count }}--}}
                                {{--                                        </option>--}}
                                {{--                                    </select>--}}
                                {{--                                    <button type="button" class="btn btn-danger"--}}
                                {{--                                            @click.prevent="removeSelectedStall(index)">--}}
                                {{--                                        Remove--}}
                                {{--                                    </button>--}}
                                {{--                                </div>--}}

                                <div class="stall mb-3 input-group" v-for="(stall, index) in selectedEventStall"
                                     :key="index">
                                    <select class="form-control" id="event_stall" required
                                            v-model="selectedEventStall[index]">
                                        <option :value="null" disabled>Select a Stall</option>
                                        <!-- 使用计算属性过滤 eventStalls -->
                                        <option v-for="availableStall in filteredEventStalls(index)"
                                                :key="availableStall.stall_id" :value="availableStall">
                                            @{{ availableStall.stall_type }} - @{{ availableStall.stall_count }}
                                        </option>
                                    </select>
                                    <button type="button" class="btn btn-danger"
                                            @click.prevent="removeSelectedStall(index)">
                                        Remove
                                    </button>
                                </div>


                                {{--                                <div id="stalls">--}}
                                {{--                                    <div class="stall mb-3 input-group">--}}
                                {{--                                        <select class="form-control" id="event_stall" required>--}}
                                {{--                                            <option value="" disabled selected>Select a Stall</option>--}}

                                {{--                                            <option v-for="stall in eventStalls" :value="stall.stall_id">--}}
                                {{--                                                @{{ stall.stall_type }} - @{{ stall.stall_count }}--}}
                                {{--                                            </option>--}}
                                {{--                                        </select>--}}
                                {{--                                        <button type="button" class="btn btn-danger" @click.prevent="">--}}
                                {{--                                            Remove--}}
                                {{--                                        </button>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <button type="button" class="btn btn-secondary mt-2" @click.prevent="addNewStall">Add
                                    Stall
                                </button>
                            </div>

                            <div class="mb-3">
                                <label for="total_price" class="form-label">Total Price</label>
                                <input type="text" class="form-control" id="total_price" :value="totalPrice" readonly
                                       required>
                            </div>

                            {{--                            <div class="mb-3">--}}
                            {{--                                <label for="stall_info" class="form-label">Stall Information</label>--}}
                            {{--                                --}}{{--                                <textarea class="form-control" id="stall_info" ng-model="order.stall_info" rows="3" required></textarea>--}}
                            {{--                                <textarea class="form-control" id="stall_info" rows="3" required></textarea>--}}
                            {{--                            </div>--}}
                            <button type="submit" class="btn btn-primary" @click.prevent="saveSalesOrder"
                                    v-if="!isLoading">Save Order
                            </button>
                            <button type="submit" class="btn btn-primary" v-else
                                    disabled>Processing...
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for search customer -->
        <div class="modal fade" id="search-customer" tabindex="-1" aria-labelledby="searchCustomerModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content radius-xl">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchCustomerModalLabel">Search Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        {{--                        <form>--}}
                        {{--                            <div class="mb-3">--}}
                        {{--                                <label for="customer_name" class="form-label--}}
                        {{--                                ">Customer Name or Customer Email</label>--}}
                        {{--                                <input type="text" class="form-control" id="customer_name" v-model="searchCustomer" required>--}}
                        {{--                            </div>--}}
                        {{--                            <button type="submit" @click.prevent="searchCustomerFunction" class="btn btn-primary">Search</button>--}}
                        {{--                        </form>--}}

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 mb-30">
                                    <div class="support-ticket-system support-ticket-system--search">

                                        <div
                                            class="support-form datatable-support-form d-flex justify-content-xxl-between justify-content-right align-items-right flex-wrap">
                                            <div class="support-form__input">
                                                <div class="d-flex flex-wrap">
                                                    <button class="support-form__input-button"
                                                            @click.prevent="searchCustomerFunction">Search
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="support-form__search">
                                                <div class="support-order-search">
                                                    <form class="support-order-search__form">
                                                        <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search"
                                                             class="svg">
                                                        <input class="form-control border-0 box-shadow-none"
                                                               type="search" v-model="searchCustomer"
                                                               placeholder="Search Name or Email" aria-label="Search">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="userDatatable userDatatable--ticket userDatatable--ticket--2 mt-1">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-borderless">
                                                    <thead>
                                                    <tr class="userDatatable-header">
                                                        <th>
                                                            <span class="userDatatable-title">ID</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">User</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Email</span>
                                                        </th>
                                                        <th class="actions">
                                                            <span class="userDatatable-title">Actions</span>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <!-- If there are no search results -->
                                                    <tr v-if="searchedCustomerList.length === 0">
                                                        <td colspan="4" class="text-center">No search results found.
                                                        </td>
                                                    </tr>

                                                    <tr v-for="(customer, index) in searchedCustomerList">
                                                        <td>#@{{ index }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="userDatatable-inline-title">
                                                                    <h6 class="text-dark fw-500">@{{ customer.name
                                                                        }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="userDatatable-content--subject">
                                                                @{{ customer.email }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                                <li>
                                                                    <!-- Button to select the customer -->
                                                                    <a href="#" class="view"
                                                                       @click.prevent="selectCustomer(customer)"
                                                                       data-bs-dismiss="modal">
                                                                        <i class="uil uil-check"></i>
                                                                    </a>
                                                                    {{--                                                                    <a href="#" class="view">--}}
                                                                    {{--                                                                        <i class="uil uil-setting"></i>--}}
                                                                    {{--                                                                    </a>--}}
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for update sales order status -->
        <div class="modal fade" id="update-sales-order-status" tabindex="-1"
             aria-labelledby="updateSalesOrderStatusModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content radius-xl">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateSalesOrderStatusModalLabel">Update Sales Order Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        <form>
                            <div class="mb-3">
                                <label for="status" class="form-label">Order Status</label>
                                <select class="form-control" id="status" required v-model="selectedStatus">
                                    <option value="" disabled selected>Select a Status</option>
                                    <option value="cancel">Cancel</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" @click.prevent="confirmUpdateStatus">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endsection

        @section('script')
            <script>
                const {createApp} = Vue


                createApp({

                    mounted() {
                        this.getSalesOrder();
                        this.getEvents();
                    },
                    watch: {
                        selectedEvent: function (newVal, oldVal) {
                            this.getTimeSlots(newVal)
                        },
                        selectedTimeslot: function (newVal, oldVal) {
                            this.getAvailableStalls()
                        }
                    },
                    computed: {
                        filteredEventStalls() {
                            return (currentIndex) => {
                                // 获取所有已选择的 stall_id
                                const selectedStallIds = this.selectedEventStall.map(stall => stall ? stall.stall_id : null);
                                // 过滤 eventStalls 使得不包括已经选择的 stall_id
                                return this.eventStalls.filter(stall => !selectedStallIds.includes(stall.stall_id) || (this.selectedEventStall[currentIndex] && this.selectedEventStall[currentIndex].stall_id === stall.stall_id));
                            };
                        },
                        totalPrice() {
                            // 确保 price 是数值类型，并计算总和
                            let price = this.selectedEventStall.reduce((sum, stall) => sum + (stall ? Number(stall.price) : 0), 0).toFixed(2);
                            return 'RM ' + price;
                        }
                    },


                    data() {
                        return {
                            selectedSalesOrder: '',
                            selectedStatus: '',

                            isLoading: false,
                            isValidation: true,
                            isValidateCustomer: true,
                            filterData: '',

                            searchCustomer: '',
                            searchedCustomerList: [],

                            customer: '',
                            selectedEvent: '',
                            selectedTimeslot: '',
                            selectedEventStall: [],
                            staffInfo: '',


                            orders: [],
                            events: [],
                            timeslots: [],
                            eventStalls: [],


                            message: 'Hello Vue!',


                        }
                    },
                    methods: {
                        updateStatus(order) {
                            this.selectedSalesOrder = order
                        },
                        confirmUpdateStatus() {
                            if (this.selectedStatus === '') {
                                alert('Please select a status')
                                return
                            }

                            axios.post('{{ route('sales_orders.update_status') }}', {
                                _token: '{{ csrf_token() }}',
                                order_id: this.selectedSalesOrder.id,
                                status: this.selectedStatus
                            })
                                .then(response => {
                                    alert('Sales order status updated successfully!');
                                    location.reload();
                                })
                                .catch(error => {
                                    console.error('Error:', error)
                                })
                        },

                        saveSalesOrder() {
                            if (this.customer === '') {
                                this.isValidateCustomer = false;
                                return
                            }

                            this.isValidateCustomer = true;


                            //Filter out the null values
                            this.selectedEventStall = this.selectedEventStall.filter(stall => stall.stall_id !== null);

                            if (this.selectedEventStall.length === 0) {
                                this.isValidation = false;
                                return;
                            }


                            this.isValidation = true;

                            this.isLoading = true;

                            axios.post('{{ route('sales_orders.save') }}', {
                                _token: '{{ csrf_token() }}',
                                customer_id: this.customer.id,
                                event_id: this.selectedEvent,
                                timeslot_id: this.selectedTimeslot,
                                event_stalls: this.selectedEventStall,
                            })
                                .then(response => {
                                    this.isLoading = false;
                                    alert('Sales order saved successfully!');
                                    location.reload();
                                })
                                .catch(error => {
                                    this.isLoading = false;
                                    console.error('Error:', error)
                                })


                        },

                        removeSelectedStall(index) {
                            this.selectedEventStall.splice(index, 1)
                        },

                        addNewStall() {
                            this.selectedEventStall.push({
                                stall_id: null
                            })
                        },

                        getAvailableStalls() {
                            axios.get('{{ route('sales_orders.stalls') }}', {
                                params: {
                                    {{--_token: '{{ csrf_token() }}',--}}
                                    timeslot_id: this.selectedTimeslot
                                }
                            })
                                .then(response => {
                                    this.eventStalls = response.data
                                })
                                .catch(error => {
                                    console.error('Error:', error)
                                })
                        },

                        customDateFormat(dateString) {
                            return new Date(dateString).toLocaleDateString('en-GB', {
                                day: 'numeric', month: 'short', year: 'numeric'
                            });
                        },

                        getTimeSlots(eventId) {
                            axios.get('{{ route('sales_orders.timeslots') }}', {
                                params: {
                                    {{--_token: '{{ csrf_token() }}',--}}
                                    event_id: eventId
                                }
                            })
                                .then(response => {
                                    this.timeslots = response.data
                                })
                                .catch(error => {
                                    console.error('Error:', error)
                                })
                        },
                        getEvents() {
                            axios.get('{{ route('sales_orders.events') }}')
                                .then(response => {
                                    this.events = response.data
                                })
                                .catch(error => {
                                    console.error('Error:', error)
                                })
                        },

                        getSalesOrder() {
                            axios.post('{{ route('sales_orders.list') }}', {

                                _token: '{{ csrf_token() }}',
                                filterData: this.filterData,
                            })
                                .then(response => {
                                    this.orders = response.data
                                })
                                .catch(error => {
                                    console.error('Error:', error)
                                })
                        },

                        selectCustomer(customer) {
                            this.customer = customer

                        },

                        searchCustomerFunction() {
                            // if (this.searchCustomer === '') {
                            //     alert('Please enter a search query')
                            //     return
                            // }

                            axios.post('{{route('sales_orders.search_customer')}}', {
                                _token: '{{ csrf_token() }}',
                                search: this.searchCustomer
                            })
                                .then(response => {
                                    this.searchedCustomerList = response.data
                                })
                                .catch(error => {
                                    console.error('Error:', error)
                                })

                        },

                    }
                }).mount('#app')

            </script>

@endsection



{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>--}}
{{--<script>--}}
{{--    var app = angular.module('salesOrderApp', []);--}}

{{--    app.controller('SalesOrderController', ['$scope', '$http', function($scope, $http) {--}}
{{--    $scope.orders = @json($salesOrders);--}}
{{--    $scope.events = @json($events);--}}
{{--    $scope.timeslots = [];--}}
{{--    $scope.eventStalls = [];--}}

{{--    $scope.order = {--}}
{{--        customer_name: '',--}}
{{--        customer_id: '',--}}
{{--        status: '',--}}
{{--        total_price: '',--}}
{{--        event: '',--}}
{{--        timeslot: '',--}}
{{--        event_stalls: [--}}
{{--            { stall_id: null },--}}
{{--        ],  // Initialize as an empty array--}}
{{--        stall_info: '',--}}
{{--    };--}}

{{--    // Load timeslots for the selected event--}}
{{--    $scope.loadTimeslots = function(eventId) {--}}
{{--        if (eventId) {--}}
{{--            $http.get('/sales_orders/events/' + eventId + '/timeslots')--}}
{{--                .then(function(response) {--}}
{{--                    $scope.timeslots = response.data;--}}
{{--                }, function(error) {--}}
{{--                    alert('Error loading timeslots.');--}}
{{--                });--}}
{{--        }--}}
{{--    };--}}

{{--    // Load event stalls for the selected timeslot--}}
{{--    $scope.loadEventStall = function(timeslotId) {--}}
{{--        if (timeslotId) {--}}
{{--            $http.get('/sales_orders/timeslots/' + timeslotId + '/event_stalls')--}}
{{--                .then(function(response) {--}}
{{--                    $scope.eventStalls = response.data;--}}
{{--                }, function(error) {--}}
{{--                    alert('Error loading event stalls.');--}}
{{--                });--}}
{{--        }--}}
{{--    };--}}

{{--    // Function to add a new stall to the order--}}
{{--    $scope.addStall = function() {--}}
{{--        $scope.order.event_stalls.push({--}}
{{--            stall_id: null  // Add a new stall object with a null id--}}
{{--        });--}}
{{--    };--}}

{{--    // Function to remove a stall from the order--}}
{{--    $scope.removeStall = function(index) {--}}
{{--        $scope.order.event_stalls.splice(index, 1);--}}
{{--    };--}}

{{--    // // Filter sales orders based on the search query--}}
{{--    // $scope.filteredSalesOrders = function() {--}}
{{--    //     return $scope.orders.filter(function(order) {--}}
{{--    //         return order.customer_name.toLowerCase().includes($scope.searchQuery.toLowerCase());--}}
{{--    //     });--}}
{{--    // };--}}

{{--    // Save the order--}}
{{--    $scope.saveOrder = function() {--}}
{{--        if ($scope.order.id) {--}}
{{--            $http.post('/sales_orders/update', $scope.order)--}}
{{--                .then(function(response) {--}}
{{--                    alert('Sales order updated successfully!');--}}
{{--                    location.reload();--}}
{{--                }, function(error) {--}}
{{--                    alert('Error updating sales order.');--}}
{{--                });--}}
{{--        } else {--}}
{{--            $http.post('/sales_orders/store', $scope.order)--}}
{{--                .then(function(response) {--}}
{{--                    alert('Sales order saved successfully!');--}}
{{--                    location.reload();--}}
{{--                }, function(error) {--}}
{{--                    alert('Error saving sales order.');--}}
{{--                });--}}
{{--        }--}}
{{--    };--}}

{{--    // Edit the order--}}
{{--    $scope.editOrder = function(order) {--}}
{{--        $scope.order = angular.copy(order);--}}
{{--        if ($scope.order.event) {--}}
{{--            $scope.loadTimeslots($scope.order.event);--}}
{{--            $scope.loadEventStall($scope.order.timeslot);--}}
{{--        }--}}
{{--    };--}}

{{--    // Reset the order form--}}
{{--    $scope.resetOrder = function() {--}}
{{--        $scope.order = {--}}
{{--            customer_name: '',--}}
{{--            customer_id: '',--}}
{{--            status: '',--}}
{{--            total_price: '',--}}
{{--            event: '',--}}
{{--            timeslot: '',--}}
{{--            event_stalls: [--}}
{{--                { stall_id: null },--}}
{{--            ],  // Initialize as an empty array--}}
{{--            stall_info: '',--}}
{{--        };--}}
{{--        $scope.timeslots = [];--}}
{{--        $scope.eventStalls = [];--}}
{{--    };--}}

{{--    // Delete the order--}}
{{--    $scope.deleteOrder = function(id) {--}}
{{--        if (confirm('Are you sure you want to delete this sales order?')) {--}}
{{--            $http.get('/sales_orders/remove/' + id)--}}
{{--                .then(function(response) {--}}
{{--                    alert('Sales order deleted successfully!');--}}
{{--                    location.reload();--}}
{{--                }, function(error) {--}}
{{--                    alert('Error deleting sales order.');--}}
{{--                });--}}
{{--        }--}}
{{--    };--}}
{{--}]);--}}


{{--</script>--}}
