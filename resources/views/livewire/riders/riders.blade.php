<div>
    
    <div class="row">
        <div class="col-md-12">
            <form action="" method="GET">
                <div class="input-group search-area mb-2">
                    <input wire:model.debounce.500ms="search" type="text" class="form-control" name="search" value="" placeholder="Search here Name or Email Address...">
                    <span class="input-group-text"><a><i class="flaticon-381-search-2"></i></a></span>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="form-validation">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="card-title">Rider</h4>
                    </div>
                    <div class="row p-4">
                        <div class="mb-3">
                            <label for="validationServer01" class="form-label">Full Name</label>
                            <input type="text" wire:model.lazy="fname" class="form-control w-100" id="validationServer01">
                            @error('fname')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validationServer02" class="form-label">Email Address</label>
                            <input type="email" wire:model.lazy="email" class="form-control w-100" id="validationServer02">
                            @error('email')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validationServer02" class="form-label">Password</label>
                            <input type="password" wire:model.lazy="password" class="form-control w-100" id="validationServer02">
                            @error('password')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validationServer02" class="form-label">Comfirmation</label>
                            <input type="password" wire:model.lazy="password_confirmation" class="form-control w-100" id="validationServer02">
                            @error('password_confirmation')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-dark" wire:click="resetFields" >Clear</button>
                                <button type="submit" wire:click="submitForm" class="text-black btn btn-warning float-end">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   <h3 class="card-title">Rider Record</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display" style="min-width: 400px">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Assigned</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Assigned</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
