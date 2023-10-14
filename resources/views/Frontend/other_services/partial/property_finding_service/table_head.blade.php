<thead>
    <th>{{ $category_name }}</th>
    <th>
        Regular
        <span class="ptable-star green">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            {{-- <i class="fa fa-star-half-o"></i> --}}
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
        </span>
        <span class="ptable-price">£{{ $service_charge }}</span>
    </th>
    <th>
        Premium
        <span class="ptable-star lblue">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
        </span>
        <span class="ptable-price">£{{ $service_charge * 1.4 }}</span>
    </th>

</thead>
