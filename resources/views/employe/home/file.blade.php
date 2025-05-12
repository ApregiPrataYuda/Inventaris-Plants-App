@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Page
        </div>
        <h2 class="page-title">
            {{ $title }}
        </h2>
        </div>
    </div>
    </div>
</div>

 @php
    $user = dataUser();
    @endphp

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">

            <div class="alert alert-important alert-info alert-dismissible" role="alert">
                <div class="alert-icon">
                  <!-- Download SVG icon from http://tabler.io/icons/icon/info-circle -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-text-spellcheck"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 15v-7.5a3.5 3.5 0 0 1 7 0v7.5" /><path d="M5 10h7" /><path d="M10 18l3 3l7 -7" /></svg>
                </div>
                <div>
                  <h4 class="alert-heading"></h4>
                  <div class="alert-description">Wellcome back. {{ $user->fullname }}</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
              </div>
            </div>


        </div>
    </div>


@endsection
		