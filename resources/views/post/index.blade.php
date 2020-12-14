@extends('layouts.app')
@section('title','Post')
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
	                            <h3 class="mb-0">Post</h3>
	                        </div>
	                        <div class="col-4 text-right">
	                            <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary">Add post</a>
	                        </div>
	                    </div>
	                </div>

	                <div class="col-12"></div>

	                <div class="table-responsive">
                    	<table class="table align-items-center table-flush">
                        	<thead class="thead-light">
                            	<tr>
                            		<th>Name</th>
                            		<th>Image</th>
                                    <th>View Count</th>
                            		<th></th>
                            	</tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $row)
                            	<tr>
                            		<td>{{ $row->title }}</td>
                                    <td><img src="{{asset('images/post')}}/{{$row->image}}" alt="" style="width:150px;"></td>
                            		<td>{{ $row->view_count }}</td>
                            		<td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
                                                <a class="dropdown-item" href="{{ route('post.edit', $row->id) }}">Edit</a>
												<form action="{{ route('post.destroy', $row->id)}}" method="post">
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