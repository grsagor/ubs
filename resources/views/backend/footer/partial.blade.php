<h3 class="text-success text-center"><u>{{ $title }}</u></h3>
<table class="table table-bordered table-striped table-hover">
    <!-- Table header -->
    <thead>
        <tr>
            <th style="width: 5%">No.</th>
            <th style="width: 25%">Category</th>
            <th style="width: 62%">Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
            <tr style="{{ $item->slug === 'partner-boarding' ? 'background-color: #defa78;' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->category_name }}</td>
                <td>{{ ucwords(str_replace('-', ' ', $item->slug)) }}</td>
                <td>
                    <a href="{{ route('footer.edit', $item->id) }}" class="btn btn-xs btn-primary">
                        <i class="glyphicon glyphicon-edit"></i> Edit
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No data available</td>
            </tr>
        @endforelse
    </tbody>
</table>
