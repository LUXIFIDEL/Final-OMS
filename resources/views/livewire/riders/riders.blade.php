
@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

<div>
    <div class="row">
        
        <div class="col-md-4">
            <div class="form-validation">
                <div class="card">
                   
                    <div class="card-header bg-warning">
                        <h4 class="card-title">Rider's Registration</h4>
                    </div>
                    <div class="row p-4">
                        <input type="hidden" wire:model="rider_id">
                        <div class="mb-3">
                            <label for="validationServer01" class="form-label">Full Name</label>
                            <input type="text" wire:model.lazy="fname" class="form-control w-100 @error('fname') alert-danger @enderror" id="validationServer01">
                            @error('fname')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationServer02" class="form-label">Date of Birth</label>
                                <input type="date" wire:model.lazy="dob" class="form-control w-100 @error('dob') alert-danger @enderror" id="validationServer02">
                                @error('dob')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationServer03" class="form-label">Contact</label>
                                <input type="number" wire:model.lazy="cpnum" class="form-control w-100 @error('cpnum') alert-danger @enderror" id="validationServer03">
                                @error('cpnum')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="validationServer04" class="form-label">Email Address</label>
                            <input type="email" @if($updateMode == false) wire:model.lazy="email" @else disabled wire:model="email" @endif class="form-control w-100 @error('email') alert-danger @enderror" id="validationServer04">
                            @error('email')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validationServer05" class="form-label">Password</label>
                            <input type="password" wire:model.lazy="password" class="form-control w-100 @error('password') alert-danger @enderror" id="validationServer05">
                            @error('password')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validationServer06" class="form-label">Comfirmation</label>
                            <input type="password" wire:model.lazy="password_confirmation" class="form-control w-100 @error('password_confirmation') alert-danger @enderror" id="validationServer06">
                            @error('password_confirmation')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-dark" wire:click="resetFields" >Clear</button>
                                @if($updateMode == false)
                                <button type="submit" 
                                        wire:click="submitForm" 
                                        class="text-black btn btn-warning float-end">Save 
                                    <div wire:loading 
                                         wire:target="submitForm">
                                        <img src="{{asset('image/ajax-loader.gif')}}" height="20" alt="loading">
                                    </div>
                                </button>
                                @else
                                <button type="submit" 
                                        wire:click="updateForm" 
                                        class="text-black btn btn-primary float-end">Update 
                                    <div wire:loading 
                                         wire:target="updateForm">
                                        <img src="{{asset('image/ajax-loader.gif')}}" height="20" alt="loading">
                                    </div>
                                </button>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-header bg-warning">
                   <h3 class="card-title">Rider Record</h3>
                </div>
                <div class="mb-3 mb-md-0 input-group w-50 mx-auto mt-3">
                    <div class="input-group">
                        <input class="form-control border-1 rounded-pill" 
                                type="search" 
                                value="search" 
                                id="example-search-input"
                                wire:model.debounce.500ms="search"
                                placeholder="Search Here"
                                type="text">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" style="min-width: 400px">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($riders as $rider)
                                <tr>
                                    <td>{{ $rider->id }}</td>
                                    <td>{{ $rider->user->name }}</td>
                                    <td>{{ $rider->user->email }}</td>
                                    <td class=" {{($rider->user->is_not_available == false)? 'text-green' : 'text-red';}}">{{ ($rider->user->is_not_available == false)? 'Available' : 'Not-available'; }}</td>
                                    <td>
                                        <button wire:click="edit({{ $rider->id }})" class="btn btn-primary btn-sm"> <i class="fa fa-pencil-alt"></i></button>
                                        <button wire:click="delete({{ $rider->id }})" class="btn btn-danger btn-sm"> <i class="fa fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td disabled colspan="5">
                                        <div class="alert alert-danger text-center" role="alert">
                                            <span class="w-100 bold">No Data Found!</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                    {{ $riders->links() }}
                    </div>
                    @if (session()->has('deleted'))
                        <div class="alert alert-danger">
                            {{ session('deleted') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>

@push('script')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
@endpush
