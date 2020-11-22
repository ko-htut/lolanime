@extends('layouts.app')
@section('title','Visitor')
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
	                            <h3 class="mb-0">Visitor</h3>
	                        </div>
	                        {{-- <div class="col-4 text-right">
	                            <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Add category</a>
	                        </div> --}}
	                    </div>
	                </div>

	                <div class="col-12"></div>

	                <div class="table-responsive">
                    	<table class="table align-items-center table-flush">
                        	<thead class="thead-light">
                            	<tr>
                            		<th>ID</th>
                            		<th>Manufacturer</th>
                            		<th>Model</th>
                            		<th>Android ID</th>
                            		<th>Status</th>
                            		<th></th>
                            	</tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $row)
                            	<tr>
                            		<td>{{ $row->id }}</td>
                            		<td>{{ $row->manufacturer }}</td>
                            		<td>{{ $row->model }}</td>
                            		<td>{{ $row->android_id }}</td>
                            		<td>{{ $row->status }}</td>
                            		<td class="text-right">
                            			<div class="dropdown">
				                        	<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                          		<i class="fas fa-ellipsis-v"></i>
				                        	</a>
					                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
					                          	<a class="dropdown-item" href="{{ route('visitor.show', $row->id)}}">Show</a>
					                          	<a class="dropdown-item" href="{{ route('visitor.edit', $row->id)}}">Change Status</a>
					                          	<a class="dropdown-item" href="#">Delete</a>
					                        </div>
				                      	</div>
				                    </td>
                            	</tr>
                            	@endforeach
                            </tbody>
                        </table>
                        {{$data->links()}}
                    </div>

            	</div>
            </div>
        </div>
    </div>
@endsection