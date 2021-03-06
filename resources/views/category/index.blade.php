@extends('layouts.app')
@section('title','Category')
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
	                            <h3 class="mb-0">Genres</h3>
	                        </div>
	                        <div class="col-4 text-right">
	                            <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Add Genres</a>
	                        </div>
	                    </div>
	                </div>

	                <div class="col-12"></div>

	                <div class="table-responsive">
                    	<table class="table align-items-center table-flush">
                        	<thead class="thead-light">
                            	<tr>
                            		<th>ID</th>
                            		<th>Name</th>
                            		<th></th>
                            	</tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $row)
                            	<tr>
                            		<td>{{ $row->id }}</td>
                            		<td>{{ $row->name }}</td>
                            		<td class="text-right">
                            			<div class="dropdown">
				                        	<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                          		<i class="fas fa-ellipsis-v"></i>
				                        	</a>
					                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
					                          	<a class="dropdown-item" href="{{ route('category.show', $row->id)}}">Show</a>
					                          	<a class="dropdown-item" href="{{ route('category.edit', $row->id)}}">Edit</a>
					                          	<form action="{{ route('category.destroy', $row->id)}}" method="post">
													@csrf
													@method('delete')
													<input type="submit" value="Delete" class="dropdown-item">
												</form>
					                        </div>
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
@endsection