<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-center">
            {{ __('City List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            
            <form action="{{route('city_list')}}" method="GET" id="frmSearch">
                <div class="row my-2">
                    <div class="col-md-11">
                        <input type="text" class="form-control" name="search" placeholder="State Or County Search">
                    </div>
                    <div class="col-md-1">
                        <input type="submit" class="btn btn-sm btn-success" value="Search">
                    </div>
                   
                </div>
            </form>
        
            <div id="ajax_content">
                @include('city._city_list')
            </div>
           
            
        </div>
    </div>
    <!-- Vertically centered modal -->
    <div class="modal fade modal-lg" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">City Details</h5>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                <div id="ajax_modal">

                </div>
            </div>
          </div>
        </div>
      </div>
 

</x-app-layout>
<script>
    
    function view_city(id) {
    $("#myModal").modal('show');
    $.ajax({
        url: "{{ url('city_show') }}/" + id,
        type: "get",
        success: function (data) {
            $('#ajax_modal').html(data);

            if (data.status == 'error') {
                toastr.error(data.message);
            }
        },
        error: function (xhr, status) {
            alert('There is some error. Try after some time.');
        }
    });
}

   
 </script>
