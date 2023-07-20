{{-- s trending categories --}}
<div class="container popular-categories-section p-4">
    <div class="row">
        <div class="col-12">
            <h3 class="text-dark text-center">Popular Categories</h3>
            <hr class="mx-auto">
        </div>

        @foreach ($categories as $category)

        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
            <ul class="list-group border-0">
        
                    <li class="list-group-item"><a
                            href=""
                            class="text-dark">{{ $category->name }}</a></li>
                
            </ul>
        </div>
            
        @endforeach

        

        


    </div>
</div>
{{-- e trending categories --}}