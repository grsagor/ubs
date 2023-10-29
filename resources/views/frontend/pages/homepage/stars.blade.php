{{-- s trending categories --}}
@if (count($stars) > 0)
    <div class="container meetup-section p-4">
        <div class="row">
            <div class="col-12">
                <h3 class="text-dark text-center">Meet with Stars</h3>
                <hr class="mx-auto">
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($stars as $star)
                <div class="col-lg-3 col-md-4 col-sm-12 text-center py-2 ">
                    <a href="" class="text-decoration-none text-secondary">

                        <div class="flip-card ">
                            <div class="flip-card-inner position-relative">
                                <div class="flip-card-front ">
                                    <img src="{{ asset($star->image_url) }}" alt="Avatar"
                                        style="width:300px;height:300px;">
                                    <ul class="list-group border-0 position-absolute bottom-0 start-0">
                                        <li class="list-group-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                            </svg> <span class="fw-bold">{{ $star->name }} </span>
                                        </li>
                                        <li class="list-group-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                                <path
                                                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                                <path
                                                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                                            </svg>
                                            <span class="fw-bold">{{ $star->type }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flip-card-back p-2">
                                    <h5 class="text-white">{{ $star->name }}</h5>
                                    <p class="text-white">
                                        {{ $star->details }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            @endforeach


        </div>
    </div>
@endif

{{-- e trending categories --}}
