@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
    <div class="container-fluid" ng-app="stallApp" ng-controller="StallController">
        <div class="row">
            <div class="col-lg-12">
                <div class="project-progree-breadcrumb">
                    <div class="breadcrumb-main user-member justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Stall</h4>
                            </div>
                        </div>
                        <div class="action-btn">
                            @include('pages.applications.event.modal.create_modal')
                            @include('pages.applications.event.modal.remove_modal')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Slot Selection -->
        <div class="row mb-4">
            <div class="col-lg-4">
                <h5>Selected Time Slot:</h5>
                <select class="form-select" ng-model="currentTimeSlot" ng-change="selectTimeSlotData(currentTimeSlot)">
                    <option value="">Select Time Slot</option>
                    <option ng-repeat="time_slot in timeSlots"
                            ng-value="@{{time_slot.time_slot_id}}">
                        @{{ time_slot.date_from | date:'dd-MM-yyyy' }} @{{ time_slot.time_from | date:'HH:mm:ss' }} -
                        @{{ time_slot.date_to | date:'dd-MM-yyyy' }} @{{ time_slot.time_to | date:'HH:mm:ss' }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Display Time Slot Details -->
        <div class="row" ng-if="selectedTimeSlot">
            <div class="col-lg-12">
                <p><strong>Date:</strong> @{{ selectedTimeSlot.date_from | date:'dd-MM-yyyy' }} -
                    @{{ selectedTimeSlot.date_to | date:'dd-MM-yyyy' }}</p>
                <p><strong>Time:</strong> @{{ selectedTimeSlot.time_from | date:'HH:mm:ss' }} -
                    @{{ selectedTimeSlot.time_to | date:'HH:mm:ss' }}</p>

                @if($eventMapImage!= '')
                    <div>
                        <img src="http://fyp-diploma.test/images/{{ $eventMapImage }}" alt="Event Image"
                             style="width: 100%; height: 500px; object-fit: cover;">
                    </div>
                @endif
            </div>
        </div>

        <!-- Stall Display -->
        <div class="projects-tab-content projects-tab-content--progress">
            <div class="tab-content mt-25" id="ap-tabContent">
                <div class="tab-pane fade show active" id="ap-overview" role="tabpanel"
                     aria-labelledby="ap-overview-tab">
                    <div class="row">
                        <div class="col-xl-4 mb-25 col-md-6" ng-repeat="stall in stalls">
                            <div class="user-group radius-xl bg-white media-ui media-ui--early pt-30 pb-25">
                                <div class="border-bottom px-30">
                                    <div class="media user-group-media d-flex justify-content-between">
                                        <div
                                            class="media-body d-flex align-items-center flex-wrap text-capitalize my-sm-0 my-n2">
                                            <a href="#">
                                                <h6 class="mt-0  fw-500 user-group media-ui__title">
                                                    @{{stall.stall_type}}@{{stall.stall_count}}</h6>
                                            </a>

                                            <span class="media-badge text-uppercase color-white"
                                                  ng-class="{'bg-success': stall.status == '0', 'bg-danger': stall.status != '0'}">
                                                @{{stall.status == '0' ? 'Available' : (stall.status == '1' ? 'Sold' : 'Booked')}}
                                            </span>
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
                                                    <a class="dropdown-item" href="#"
                                                       ng-click="openEditModal(stall.stall_id)">edit</a>
                                                    <a class="dropdown-item" href="#"
                                                       ng-click="openRemoveModal(stall.stall_id)">remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-group-people mt-15 text-capitalize">
                                        <div class="user-group-project">
                                            <div class="d-flex align-items-center user-group-progress-top">
                                                <div class="media-ui__start">
                                                    <span class="color-light fs-12">Type</span>
                                                    <p class="fs-14 fw-500 color-dark mb-0">@{{stall.stall_type}}</p>
                                                </div>
                                                <div class="media-ui__start">
                                                    <span class="color-light fs-12">Price</span>
                                                    <p class="fs-14 fw-500 color-dark mb-0">RM @{{stall.price}}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center user-group-progress-top">
                                                <div class="media-ui__start">
                                                    <span class="color-light fs-12">Category</span>
                                                    <p class="fs-14 fw-500 color-dark mb-0">@{{stall.category}}</p>
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
        </div>

        <!--Edit Modal -->
        <div class="modal fade new-member " id="edit-stall-modal" role="dialog" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content  radius-xl">
                    <div class="modal-header">
                        <h6 class="modal-title fw-500" id="staticBackdropLabel">Edit Stall</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="new-member-modal">

                            <form>
                                @csrf

                                <div class="form-group mb-20">
                                    <input type="text" class="form-control" placeholder="Stall Type" name="stall_type"
                                           ng-model="editStall.stall_type">
                                </div>
                                <div class="form-group mb-20">
                                    <input type="number" class="form-control" placeholder="Stall Count"
                                           name="stall_count" ng-model="editStall.stall_count">
                                </div>
                                <div class="form-group mb-20">
                                    <input type="text" class="form-control" placeholder="Category" name="category"
                                           ng-model="editStall.category">
                                </div>

                                <div class="button-group d-flex pt-25">
                                    <button type="submit" ng-click="updateStall()"
                                            class="btn btn-primary btn-default btn-squared text-capitalize">Update Stall
                                    </button>
                                    <button type="button"
                                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light"
                                            data-bs-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->


        <div class="modal-info-delete modal fade show" id="stall-modal-delete" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-sm modal-info" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-info-body d-flex">
                            <div class="modal-info-icon warning">
                                <img src="{{ asset('assets/img/svg/alert-circle.svg') }} " alt="alert-circle"
                                     class="svg">
                            </div>

                            <div class="modal-info-text">
                                <h6>Do you Want to delete this stall?</h6>
                                <p>The selected stall will be deleted.</p>
                                <p>This action can't be reversed.</p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal">No
                        </button>
                        <button type="button" class="btn btn-success btn-outlined btn-sm" data-bs-dismiss="modal"
                                ng-click="confirmDeleteStall()">Yes
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection


@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script>
        const stallApp = angular.module('stallApp', []);

        stallApp.controller('StallController', function ($scope, $http) {
            $scope.stalls = @json($stalls);
            $scope.timeSlots = @json($timeSlot);
            $scope.search = '';

            $scope.selectedTimeSlot = $scope.timeSlots[0];
            $scope.currentTimeSlot = $scope.timeSlots[0]['time_slot_id'];

            $scope.editStall = {};
            $scope.selectedStallId = null;

            $scope.selectTimeSlotData = function (slot) {
                $scope.selectedTimeSlot = $scope.timeSlots.find(time_slot => time_slot.time_slot_id === slot);
                $scope.stalls = $scope.selectedTimeSlot.stalls;
            };

            $scope.openRemoveModal = function (id) {
                $('#stall-modal-delete').modal('show');
                $scope.selectedStallId = id;
            };

            $scope.openEditModal = function (id) {
                $('#edit-stall-modal').modal('show');
                const stall = $scope.stalls.find(s => s.stall_id === id);
                if (stall) {
                    $scope.editStall = angular.copy(stall);
                }
            };

            $scope.updateStall = function () {
                // Perform the PUT request to update the stall information
                $http.put('/event/event_stall/update/' + $scope.editStall.stall_id, $scope.editStall)
                    .then(function (response) {
                        // Handle success response
                        if (response.status === 200) {
                            // Optionally, display a success message or handle response data
                            alert('Stall updated successfully!');
                            // Reload the page or refresh the data to reflect changes
                            window.location.reload();
                        } else {
                            // Handle unexpected response status
                            console.error('Unexpected response:', response);
                            alert('An error occurred. Please try again.');
                        }
                    })
                    .catch(function (error) {
                        // Handle error response
                        console.error('Error occurred:', error);
                        // Optionally, display an error message to the user
                        alert('Failed to update stall. Please check your input and try again.');
                    });
            };

            $scope.confirmDeleteStall = function () {
                if ($scope.selectedStallId) {
                    // Perform the DELETE request to remove the stall
                    $http.delete('/event/event_stall/remove/' + $scope.selectedStallId)
                        .then(function (response) {
                            if (response.status === 200) {
                                alert('Stall removed successfully!');
                                // Reload the page or refresh the data to reflect changes
                                window.location.reload();
                            } else {
                                console.error('Unexpected response:', response);
                                alert('An error occurred. Please try again.');
                            }
                        })
                        .catch(function (error) {
                            console.error('Error occurred:', error);
                            alert('Failed to remove stall. Please try again.');
                        });
                }
            };


            $scope.deleteEvent = function () {
                $http.delete('/event/' + $scope.selectedEvent)
                    .then(function (response) {
                        window.location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            };

            $scope.deleteEventImage = function (id) {
                $http.post('/event/delete-image/' + id)
                    .then(function (response) {
                        window.location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            };
        });
    </script>
@endsection
