@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}   {{ auth()->user()->name }}
                </div>

                <section>
                    <div class="container py-5">

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-4">

                                <div class="card" id="chat1" style="border-radius: 15px;">
                                    <div
                                        class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0"
                                        style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <i class="fas fa-angle-left"></i>
                                        <p class="mb-0 fw-bold">Live chat</p>
                                        <i class="fas fa-times"></i>
                                    </div>
                                    <div class="card-body">

{{--                                        <div class="d-flex flex-row justify-content-start mb-4">--}}
{{--                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"--}}
{{--                                                 alt="avatar 1" style="width: 45px; height: 100%;">--}}
{{--                                            <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">--}}
{{--                                                <p class="small mb-0">Hello and thank you for visiting MDBootstrap. Please click the video--}}
{{--                                                    below.</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="d-flex flex-row justify-content-end mb-4">--}}
{{--                                            <div class="p-3 me-3 border bg-body-tertiary" style="border-radius: 15px;">--}}
{{--                                                <p class="small mb-0">Thank you, I really like your product.</p>--}}
{{--                                            </div>--}}
{{--                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"--}}
{{--                                                 alt="avatar 1" style="width: 45px; height: 100%;">--}}
{{--                                        </div>--}}

{{--                                        <div class="d-flex flex-row justify-content-start mb-4">--}}
{{--                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"--}}
{{--                                                 alt="avatar 1" style="width: 45px; height: 100%;">--}}
{{--                                            <div class="ms-3" style="border-radius: 15px;">--}}
{{--                                                <div class="bg-image">--}}
{{--                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/screenshot1.webp"--}}
{{--                                                         style="border-radius: 15px;" alt="video">--}}
{{--                                                    <a href="#!">--}}
{{--                                                        <div class="mask"></div>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="d-flex flex-row justify-content-start mb-4">--}}
{{--                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"--}}
{{--                                                 alt="avatar 1" style="width: 45px; height: 100%;">--}}
{{--                                            <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">--}}
{{--                                                <p class="small mb-0">...</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div data-mdb-input-init class="form-outline">
                                            <textarea class="form-control bg-body-tertiary" id="textAreaExample" rows="4"></textarea>
                                            <div style="text-align: right" class="mt-2">
                                                <button class="btn btn-info text-white btn-sm"> send </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @vite('resources/js/app.js')

    <script type="module">
        Echo.channel('chat-group')
        .listen('MessageSent', (e) => {
          // console.log(e.message);

            if(e.message != null)
            {
                $('#chat').append("
                    <div>
                         <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                         alt="avatar 1" style="width: 45px; height: 100%;">
                                                        <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                                                            <p class="small mb-0"> ${e.message.message} </p>
                                                        </div>
                   </div>

                ");

            }
        });

    </script>

    <script>
        $(document).ready(function () {
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
              });

              $('').click(function () {

              });
        });

    </script>
@endsection
