@extends('layouts.app')
@section('content')

 <!-- Page Header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            {{ $title }}
        </div>
        <h2 class="page-title">
            {{ $title }}
        </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{ route('Admin.create.users') }}" class="btn btn-pill btn-outline-azure">
             <i class="fa fa-plus"> Create</i>
            </a>
        </div>
        </div>
    </div>
    </div>
</div>


<div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>
<div id="flashInfo" data-flash="{{ session('info') }}"></div>

<div class="page-body">
<div class="container-xl">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Master {{ $title }}</h3>
        </div>
        <div class="table-responsive mb-4 p-3">
              <table class="table card-table table-vcenter text-nowrap" id="UsersTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>FullName</th>
                        <th>UserName</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th style="width: 5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<meta name="Admin-users-management-get" content="{{ route('Admin.users.management.get') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">



@endsection
		