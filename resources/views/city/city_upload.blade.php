<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('City Upload') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('upload')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="file" name="dataset" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <input type="submit" class="btn btn-sm btn-success" value="Upload">
                            </div>
                        </div>
                    </form>

                    {{-- Handle form submission in the same view --}}
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
