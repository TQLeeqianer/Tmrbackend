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
                        <form action="/" class="d-flex align-items-center user-member__form my-sm-0 my-2">
                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search"
                                   placeholder="Search by Customer Name" aria-label="Search" ng-model="searchQuery">
                        </form>
                    </div>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal"
                           data-bs-target="#new-sales-order">
                            <i class="las la-plus fs-16"></i>Add New Sales Order</a>
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
                            {{--                            <button--}}
                            {{--                                class="btn btn-primary btn-default btn-squared btn-transparent-primary ">Search Customer--}}
                            {{--                            </button>--}}

                        </div>

                        <form>
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer ID</label>
                                <input type="text" class="form-control" id="customer_id" readonly v-model="customer.id">
                            </div>

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" readonly v-model="customer.name">
                            </div>

                            {{--                            <div class="mb-3">--}}
                            {{--                                <label for="status" class="form-label">Order Status</label>--}}
                            {{--                                <input type="text" class="form-control" id="status" required>--}}
                            {{--                            </div>--}}
                            <div class="mb-3">
                                <label for="total_price" class="form-label">Total Price</label>
                                <input type="text" class="form-control" id="total_price" required>
                            </div>
                            <div class="mb-3">
                                <label for="event" class="form-label">Event</label>
                                <select class="form-control" id="event" required>
                                    <option value="" disabled selected>Select an Event</option>
                                    {{--                                    <option ng-repeat="event in events" value="@{{ event.id }}">@{{ event.name }}</option>--}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="timeslot" class="form-label">Timeslot</label>
                                <select class="form-control" id="timeslot" required>
                                    <option value="" disabled selected>Select a Timeslot</option>
                                    {{--                                    <option ng-repeat="timeslot in timeslots" value="@{{ timeslot.time_slot_id }}">--}}
                                    {{--                                        @{{ timeslot.date_from | date:'dd-MM-yyyy' }} @{{ timeslot.time_from | date:'HH:mm:ss' }} ---}}
                                    {{--                        @{{ timeslot.date_to | date:'dd-MM-yyyy' }} @{{ timeslot.time_to | date:'HH:mm:ss' }}--}}
                                    {{--                                    </option>--}}
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="event_stall" class="form-label">Event Stall</label>
                                <div id="stalls">
                                    <div class="stall mb-3 input-group">
                                        <select class="form-control" id="event_stall" required>
                                            <option value="" disabled selected>Select a Stall</option>
                                            {{--                                            <option ng-repeat="stall in eventStalls" value="@{{ stall.stall_id }}">--}}
                                            {{--                                                @{{ stall.stall_type }} - @{{ stall.stall_count }}--}}
                                            {{--                                            </option>--}}
                                        </select>
                                        <button type="button" class="btn btn-danger">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2">Add Stall</button>
                            </div>
                            <div class="mb-3">
                                <label for="stall_info" class="form-label">Stall Information</label>
                                {{--                                <textarea class="form-control" id="stall_info" ng-model="order.stall_info" rows="3" required></textarea>--}}
                                <textarea class="form-control" id="stall_info" rows="3" required></textarea>
                            </div>
                            {{--                            <button type="submit" class="btn btn-primary">@{{ order.id ? 'Update Order' : 'Save Order' }}</button>--}}
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
        @endsection

        @section('script')
            <script>
                const {createApp} = Vue


                createApp({


                    data() {
                        return {

                            searchCustomer: '',
                            searchedCustomerList: [],

                            customer: '',
                            selectedEvent: '',
                            selectedTimeslot: '',
                            selectedEventStall: [],
                            staffInfo: '',

                            events: [],
                            timeslots: [],
                            eventStalls: [],


                            message: 'Hello Vue!',


                        }
                    },
                    methods: {
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
