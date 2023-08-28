<div class="row">

    <div class="col-md-12">
        <form action="" method="GET">
            <div class="input-group search-area mb-2">
                <input wire:model.debounce.500ms="search" type="text" class="form-control" name="search" value="" placeholder="Search here Name or Email Address...">
                <span class="input-group-text"><a><i class="flaticon-381-search-2"></i></a></span>
            </div>
        </form>
    </div>
    @forelse($user_customers->where('type','client') as $data)
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
   
        <div class="card bg-warning invoice-card">
            <!-- <div class="ms-auto pe-3 pt-2" style="z-index:999">
                <input type="checkbox" name="" id="">
            </div> -->
            <div class="card-body d-flex">
            
                <div class="icon me-3">
                    {{-- Profile Image Here  --}}
                </div>
                <div>
                    <h2 class="fs-20">{{$data->name}}</h2>
                    <!-- <span class="text-white fs-10">Email: {{$data->email}}</span> <br>
                    
                    <span class="text-white fs-10">Date of Birth: {{$data->birthdate}}</span>  <br>
                    <span class="text-white fs-10">Gender: {{$data->gender ?? ''}}</span>  <br> -->
                    <span class="text-black fs-10">Address: {{$data->address}}</span>  <br>
                    <span class="text-black fs-10">CP: (+63){{$data->cellphone_number}}</span> <br>
                </div>
                
            </div>
            <div class="d-flex gap-1 justify-content-center" style="z-index:10;">
                <a href="{{route('admin.customer.show')}}" class="btn btn-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="" class="btn btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    <span class="badge bg-primary">4</span>
                </a>
                <a href="" class="btn btn-warning" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a>
            </div>
            
        </div>
    </div>
    @empty
    <div class="row">

        <div class="alert alert-danger text-center" role="alert">
            <span class="w-100 bold">No Data Found!</span>
        </div>

    </div>
    @endforelse

    {{ $user_customers->links() }}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deleting data?..</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>    
            Are you sure you want to delete this data?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Yes</button>
        </div>
        </div>
    </div>
    </div>
</div>
