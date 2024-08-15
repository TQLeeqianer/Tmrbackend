@section('title', $title)
@section('description', $description)
@extends('layout.app')
@section('content')
    <div class="container-fluid" ng-app="userApp" ng-controller="UserController">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-main user-member justify-content-sm-between">
                    <div class="d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <form action="/" class="d-flex align-items-center user-member__form my-sm-0 my-2">
                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Search by Name" aria-label="Search">
                        </form>
                    </div>
                    <div class="action-btn">
                        <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal" data-bs-target="#new-member" ng-click="resetUser()">
                            <i class="las la-plus fs-16"></i>Add New User</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($users as $user)
                <div class="cos-xl-2 col-lg-4 mb-30 col-sm-6">
                    <div class="card position-relative user-member-card">
                        <div class="card-body text-center p-30">
                            <div class="account-profile">
                                <div class="ap-img d-flex justify-content-center">
                                    <img class="ap-img__main rounded-circle mb-20 bg-opacity-primary wh-150" src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('user-profile.png') }}" alt="profile">
                                </div>
                                <div class="ap-nameAddress pb-3">
                                    <h6 class="ap-nameAddress__title">{{ $user->name }}</h6>
                                    <p class="ap-nameAddress__subTitle fs-13 pt-1 m-0">{{ $user->type == 0 ? 'Admin' : 'Stall Owner' }}</p>
                                </div>
                            </div>
                            <div class="tm-card-overlay position-absolute">
                                <div class="dropdown dropdown-click">
                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="svg" src="{{ asset('assets/img/svg/more-horizontal.svg') }}" alt="more-horizontal">
                                    </button>
                                    <div class="dropdown-default dropdown-bottomRight dropdown-menu">
                                        <a class="dropdown-item" href="#" ng-click="editUser({{ $user }})" data-bs-toggle="modal" data-bs-target="#new-member">Edit</a>
                                        <a class="dropdown-item" href="#" ng-click="deleteUser({{ $user->id }})">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal for Adding/Editing User -->
        <div class="modal fade" id="new-member" tabindex="-1" aria-labelledby="newMemberModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content radius-xl">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newMemberModalLabel">@{{ user.id ? 'Edit User' : 'Add New User' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" ng-model="user.name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" ng-model="user.email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" ng-model="user.password" ng-required="!user.id">
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="type" ng-model="user.type" required>
                                <option ng-value="0">Admin</option>
                                <option ng-value="1">Stall Owner</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" ng-click="saveUser()">@{{ user.id ? 'Update User' : 'Save User' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script>
    var app = angular.module('userApp', []);

    app.controller('UserController', ['$scope', '$http', function($scope, $http) {
        $scope.user = {
            name: '',
            email: '',
            password: '',
            type: '0', // Default to Admin
        };

        // Function to save or update user
        $scope.saveUser = function() {
            if ($scope.user.id) {
                // Update user
                $http.put('/user/update/' + $scope.user.id, $scope.user)
                    .then(function(response) {
                        alert('User updated successfully!');
                        location.reload();
                    }, function(error) {
                        alert('Error updating user.');
                    });
            } else {
                // Save new user
                $http.post('/user/store', $scope.user)
                    .then(function(response) {
                        alert('User saved successfully!');
                        location.reload();
                    }, function(error) {
                        alert('The Email already exists.');
                    });
            }
        };

        // Function to edit user
        $scope.editUser = function(user) {
            $scope.user = angular.copy(user);
            console.log($scope.user);
            $scope.user.password = ''; // Clear password for security reasons
        };

        // Function to reset user form
        $scope.resetUser = function() {
            $scope.user = {
                name: '',
                email: '',
                password: '',
                type: 0, // Reset to Admin by default
            };
        };

        // Function to delete user
        $scope.deleteUser = function(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $http.delete('/user/delete/' + id)
                    .then(function(response) {
                        alert('User deleted successfully!');
                        location.reload();
                    }, function(error) {
                        alert('Error deleting user.');
                    });
            }
        };

    }]);
</script>
