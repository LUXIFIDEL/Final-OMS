<div class="col-md-8">
    <div class="card">
        <div class="card-header p-2">

            <ul class="nav nav-pills gap-2 nav-fill pt-2 mx-auto"  role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pen-tab" data-bs-toggle="tab" data-bs-target="#pen" type="button" role="tab" aria-controls="pen" aria-selected="true"><i class="fa fa-clock" aria-hidden="true"></i> Pending </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pro-tab" data-bs-toggle="tab" data-bs-target="#pro" type="button" role="tab" aria-controls="pro" aria-selected="false"><i class="fa fa-spinner" aria-hidden="true"></i>  In-Processing</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="oinfo-tab" data-bs-toggle="tab" data-bs-target="#oinfo" type="button" role="tab" aria-controls="oinfo" aria-selected="false"><i class="fa fa-check-circle" aria-hidden="true"></i> Completed</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="can-tab" data-bs-toggle="tab" data-bs-target="#can" type="button" role="tab" aria-controls="can" aria-selected="false"><i class="fa fa-ban" aria-hidden="true"></i> Canceled</button>
                </li>
            </ul>
            
        </div><!-- /.card-header -->
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="pen" role="tabpanel" aria-labelledby="pen-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Trans No.</th>
                                    <th>Customer</th>
                                    <th>Rider</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($get_transaction->where('status','Pending') as $data)
                                <tr>
                                    <td>{{$data->trans_no}}</td>
                                    @foreach($get_user->where('id',$data->user_id)->take(1) as $data_user)
                                    <td>{{$data_user->name}}</td>
                                    @endforeach
                                    <td>Not Assigned</td>
                                    <td><span class="text-danger">Pending</span></td>
                                    <td>
                                    <div class="d-flex">
                                        <a href="{{route('admin.transaction.edit', $data->id)}}" class="btn btn-success shadow btn-xs sharp me-1">
                                            <i class="fas fa-thumbs-up"></i>
                                        </a>

                                        <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewModal"
                                            id="{{$data->id}}"
                                            trans_no="{{$data->trans_no}}"
                                            @foreach($get_user->where('id',$data->user_id)->take(1) as $data_user)
                                            customer="{{$data_user->name}}"
                                            @endforeach
                                            order="{{$data->order}}">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a class="btn btn-danger shadow btn-xs sharp me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#caModal"
                                            id="{{$data->id}}">
                                            <i class="fas fa-times-circle"></i>
                                        </a>
                                    </div>		
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pro" role="tabpanel" aria-labelledby="pro-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                <th>Trans No.</th>
                                <th>Customer</th>
                                <th>Rider</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($get_transaction->where('status','Inprocess') as $data)
                                <tr>
                                <td>{{$data->trans_no}}</td>
                                @foreach($get_user->where('id',$data->user_id)->take(1) as $data_user)
                                <td>{{$data_user->name}}</td>
                                @endforeach
                                @forelse($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                <td>{{$data_user_id->user->name}}</td>
                                @empty
                                <td>N/A</td>
                                @endforelse
                                <td>{{$data->prin_amount + $data->delivery_fee}}</td>
                                <td><span class="text-primary">Inprocess</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-success shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#coModal"
                                            id="{{$data->id}}">
                                            <i class="fas fa-check"></i>
                                        </a>

                                        <a href="{{route('admin.transaction.edit', $data->id)}}" 
                                            class="btn btn-secondary shadow btn-xs sharp me-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewModal"
                                            id="{{$data->id}}"
                                            trans_no="{{$data->trans_no}}"
                                            @foreach($get_user->where('id',$data->user_id)->take(1) as $data_user)
                                            customer="{{$data_user->name}}"
                                            @endforeach
                                            @foreach($get_customer->where('user_id',$data->user_id)->take(1) as $data_customer)
                                            address="{{$data_customer->address ?? 'N/A'}}"
                                            @endforeach
                                            prin_amount="{{$data->prin_amount ?? '0'}}"
                                            delivery_fee="{{$data->delivery_fee ?? '0'}}"
                                            order="{{$data->order}}">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a class="btn btn-danger shadow btn-xs sharp me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#caModal"
                                            id="{{$data->id}}">
                                            <i class="fas fa-times-circle"></i>
                                        </a>
                                    </div>		
                                </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="oinfo" role="tabpanel" aria-labelledby="oinfo-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                <th>Trans No.</th>
                                <th>Customer</th>
                                <th>Rider</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($get_transaction->where('status','Completed') as $data)
                                    <tr>
                                    <td>{{$data->trans_no}}</td>
                                    @foreach($get_user->where('id',$data->user_id)->take(1) as $data_user)
                                    <td>{{$data_user->name}}</td>
                                    @endforeach
                                    @forelse($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                    <td>{{$data_user_id->user->name}}</td>
                                    @empty
                                    <td>N/A</td>
                                    @endforelse
                                    <td>{{$data->prin_amount + $data->delivery_fee}}</td>
                                    <td><span class="text-success">Completed</span></td>
                                    <td>
                                        <div class="d-flex">

                                            <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#viewModal"
                                                id="{{$data->id}}"
                                                trans_no="{{$data->trans_no}}"
                                                @foreach($get_user->where('id',$data->user_id)->take(1) as $data_user)
                                                customer="{{$data_user->name}}"
                                                @endforeach
                                                @foreach($get_customer->where('user_id',$data->user_id)->take(1) as $data_customer)
                                                address="{{$data_customer->address ?? 'N/A'}}"
                                                @endforeach
                                                prin_amount="{{$data->prin_amount ?? '0'}}"
                                                delivery_fee="{{$data->delivery_fee ?? '0'}}"
                                                order="{{$data->order}}">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if($data->feedback_msg != null)
                                            <a class="btn btn-warning shadow btn-xs sharp me-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#feedModal"
                                                id="{{$data->id}}"
                                                feedback_msg="{{$data->feedback_msg}}">
                                                <i class="fas fa-comments"></i>
                                            </a>
                                            @endif

                                        </div>		
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="can" role="tabpanel" aria-labelledby="can-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                <th>Trans No.</th>
                                <th>Customer</th>
                                <th>Rider</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($get_transaction->where('status','Cancelled') as $data)
                                <tr>
                                    <td>{{$data->trans_no}}</td>
                                    @foreach($get_user->where('id',$data->user_id)->take(1) as $data_user)
                                    <td>{{$data_user->name}}</td>
                                    @endforeach
                                    @forelse($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                    <td>{{$data_user_id->user->name}}</td>
                                    @empty
                                    <td>N/A</td>
                                    @endforelse
                                    <td>{{$data->prin_amount + $data->delivery_fee}}</td>
                                    <td><span class="text-secondary">Cancelled</span></td>
                                    <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewcaModal"
                                            id="{{$data->id}}"
                                            trans_no="{{$data->trans_no}}"
                                            @foreach($get_user->where('id',$data->user_id)->take(1) as $data_user)
                                            customer="{{$data_user->name}}"
                                            @endforeach
                                            reason="{{$data->reason}}"
                                            order="{{$data->order}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>		
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>