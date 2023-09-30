@extends('layouts.customer')

@section('title')
Profile
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
        
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{route('client.profile')}}">Profile</a></li>
            </ol>
        </div>

        <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded bg-warning"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                @if(isset(auth()->user()->image))
                                <img src="{{asset('storage/user_profile/'.auth()->user()->image)}}" class="img-fluid rounded-circle" alt="">
                                @else
                                <img src="{{asset('image/profile.png')}}" class="img-fluid rounded-circle" alt="">
                                @endif
                            </div>
                            <div class="profile-details">
                                <div class="dropdown ms-auto">
                                    <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> 
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#editModal">
                                                Edit profile
                                            </a>
                                        </li>
                                        <li class="dropdown-item"><i class="fa fa-key text-primary me-2"></i> 
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#changepassModal">
                                                Change Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationServer01" class="form-label">Full Name</label>
                                <input type="text" name="" class="form-control" value="{{auth()->user()->name}}" id="validationServer01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationServer01" class="form-label">Email Address</label>
                                <input type="text" name="" class="form-control" value="{{auth()->user()->email}}" id="validationServer01">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="validationServer01" class="form-label">Address</label>
                                <input type="text" name="" class="form-control" value="{{auth()->user()->customer->address ?? 'N/A'}}" id="validationServer01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationServer01" class="form-label">Date of Birth</label>
                                <input type="date" name="" class="form-control" value="{{auth()->user()->customer->birthdate?? 'N/A'}}" id="validationServer01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationServer01" class="form-label">Cellphone Number</label>
                                <input type="text" name="" class="form-control" value="{{auth()->user()->customer->cellphone_number ?? 'N/A'}}" id="validationServer01">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form action="{{route('client.profile.update')}}" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                </div>
                <div class="modal-body row">
                    <div class="mb-3 col-md-12">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Fullname
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="name" class="form-control" id="validationCustom01" placeholder="Enter your name.." value="{{auth()->user()->name}}" required="">
                            <div class="invalid-feedback">
                                Please enter your name.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="col-lg-12 col-form-label" for="validationCustom02">
                            Email
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="email" class="form-control" id="validationCustom02" placeholder="Enter your eamil.." value="{{auth()->user()->email}}" required="">
                            <div class="invalid-feedback">
                                Please enter your email.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="col-lg-12 col-form-label" for="validationCustom02">
                            Address
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="address" class="form-control" id="validationCustom02" placeholder="Enter your eamil.." value="{{auth()->user()->customer->address ?? 'N/A'}}" required="">
                            <div class="invalid-feedback">
                                Please enter your address.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="col-lg-12 col-form-label" for="validationCustom02">
                            Sex
                        </label>
                        <select class="form-control" name="gender" required="">  
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter your address.
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="col-lg-12 col-form-label" for="validationCustom02">
                            Date of Birth
                        </label>
                        <div class="col-lg-12">
                            <input type="date" name="dob" class="form-control" id="validationCustom02" placeholder="Enter your eamil.." value="{{auth()->user()->customer->birthdate ?? 'N/A'}}" required="">
                            <div class="invalid-feedback">
                                Please enter your date of birth.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="col-lg-12 col-form-label" for="validationCustom02">
                            Contact Number
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="contact" class="form-control" id="validationCustom02" placeholder="Enter your eamil.." value="{{auth()->user()->customer->cellphone_number ?? 'N/A'}}" required="">
                            <div class="invalid-feedback">
                                Please enter your contact.
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="form-file">
                            <input type="file" name="image" class="form-file-input form-control">
                        </div>
                        <span class="input-group-text">Profile Picture</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>  
            </form>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changepassModal" tabindex="-1" aria-labelledby="changepassModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form action="{{route('client.profile.update.password')}}" method="post" class="needs-validation" novalidate="">
            @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="changepassModalLabel">Change Password</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Old Password
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="old_password" class="form-control" id="validationCustom01" placeholder="Enter your current password.." required="">
                            <div class="invalid-feedback">
                                Please enter your old password.
                            </div>
                        </div>
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom02">
                            New Password
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="new_password" class="form-control" id="validationCustom02" placeholder="Enter your new password.." required="">
                            <div class="invalid-feedback">
                                Please enter your new password.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom03">
                            Confirmation Password
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="new_password_confirmation" class="form-control" id="validationCustom03" placeholder="Enter your new password.." required="">
                            <div class="invalid-feedback">
                                Please enter your new password.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

<script>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush