<div class="bg-light">
    <div class="container-fluid container-xl bg-light our-partners-section">
        <div class="row  justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 class="text-dark">Our Partners</h1>
                <hr class="mt-0" style="width: 24%; margin: 0 auto;">
            </div>
            <div class="col-12 row mb-5">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="col-md-3">
                        <img src="{{ asset('assets/front/images/partners/partner' . $i . '.jpeg') }}" width="300"
                            height="100" class="p-2" alt="">

                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
