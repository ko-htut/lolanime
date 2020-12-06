@extends('layouts.app')
@section('title','Admin')
@section('content')
   	@include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

   	<div class="container-fluid mt--7">
    	<div class="row">
       		<div class="col">
            	<div class="card shadow">
            		<div class="card-header border-0">
                    	<div class="row align-items-center">
	                        <div class="col-8">
	                            <h3 class="mb-0">
                                @if(Auth::user()->is_superadmin == 1)
                                    Super Admin
                                @else
                                    Admin
                                @endif
                                </h3>
	                        </div>
                            @if(Auth::user()->is_superadmin == 1)
	                        <div class="col-4 text-right">
	                            <a href="{{ route('admin.create') }}" class="btn btn-sm btn-primary">Add Admin</a>
	                        </div>
                            @endif
	                    </div>
	                </div>

	                <div class="col-12"></div>

	                <div class="table-responsive">
                    	<table class="table align-items-center table-flush">
                        	<thead class="thead-light">
                            	<tr>
                            		<th>ID</th>
                            		<th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                            		<th></th>
                            	</tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $row)
                            	<tr>
                            		<td>{{ $row->id }}</td>
                            		<td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        @if($row->is_superadmin == 1)
                                            <span class="badge badge-pill badge-success">Super Admin</span>
                                        @else
                                        <span class="badge badge-pill badge-info">Admin</span>
                                        @endif
                                    </td>
                                    @if(Auth::user()->is_superadmin == 1)
                            		<td class="text-right">
                            			<div class="dropdown">
				                        	<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                          		<i class="fas fa-ellipsis-v"></i>
				                        	</a>
					                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
					                          	<a class="dropdown-item" href="{{ route('admin.show', $row->id)}}">Show</a>
					                          	<a class="dropdown-item" href="{{ route('admin.edit', $row->id)}}">Edit</a>
					                          	<form action="{{ route('admin.destroy', $row->id)}}" method="post">
													@csrf
													@method('delete')
													<input type="submit" value="Delete" class="dropdown-item">
												</form>
					                        </div>
				                      	</div>
				                    </td>
                                    @else
                                        @if(Auth::user()->id == $row->id)
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
                                                    <a class="dropdown-item" href="{{ route('admin.show', $row->id)}}">Show</a>
                                                    <a class="dropdown-item" href="{{ route('admin.edit', $row->id)}}">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    @endif
                            	</tr>
                            	@endforeach
                            </tbody>
                        </table>
                    </div>

            	</div>
            </div>
        </div>
    </div>
@endsection