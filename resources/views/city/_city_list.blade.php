<div class="table-responsive " id="print_area">
  
    <table class="table table-bordered tbl_thin  table-hover">
        <thead class="bg-info">
            <th class="text-center" style="width: 3%;">SL</th>
            <th>Id</th>
            <th>City Name</th>
            <th>State Id</th>
            <th>County Name</th>
            <th>State </th>
            <th>Action </th>
            </th>
        </thead>
        <?php
        $counter = 0;
        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $counter = ($_GET['page'] - 1) * $dataset->perPage();
        }
        ?>
        @foreach ($dataset as $data)
            <?php $counter++; ?>
            <tr >
                <td class="text-center">{{ $counter }}</td>
                <td>{{ $data->city_id }}</td>
                <td>{{ $data->city }}</td>
                <td>{{ $data->state_id }}</td>
                <td>{{ $data->county_name }}</td>
                <td>{{ $data->state_name }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary" onclick="view_city({{$data->id}})">View</button>
                  
                </td>
               
            </tr>
        @endforeach
    </table>
</div>
    <div class="text-center" id="ajaxPaginate">
        {{ $dataset->links() }}
    </div>