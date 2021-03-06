@extends('layouts.app')
@section('title','Movie')
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
	                            <h3 class="mb-0">Movie</h3>
	                        </div>
	                        <div class="col-4 text-right">
	                            <a href="{{ route('movie.create') }}" class="btn btn-sm btn-primary">Add movie</a>
	                        </div>
	                    </div>
	                </div>

	                <div class="col-12"></div>

	                <div class="table-responsive">
                    	<table class="table align-items-center table-flush">
                        	<thead class="thead-light">
                            	<tr>
                            		<th>Category</th>
                            		<th>Movie Name</th>
                            		<th>Poster</th>
                            		<th>Download</th>
                            		<th>Watch</th>
                            		<th></th>
                            	</tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $row)
                            	<tr>
                            		<td>{{ $row->category }}</td>
                            		<td>{{ $row->name }}</td>
                            		<td><img  src="{{asset('images')}}/{{$row->poster}}" class="img-responsive" style="height: 100px;" /></td>
                            		<td>{{ $row->download_count }}</td>
                            		<td>{{ $row->watch_count }}</td>
                            		<td>
                            			
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