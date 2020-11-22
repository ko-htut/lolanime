@extends('layouts.app')
@section('title','Season')
@section('content')
   	@include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">

        	<div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">Add Season</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('season/create') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Season information</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            	<input type="hidden" name="series_id" value="{{$series_id}}">
                                <div class="form-group">
                                    <label class="form-control-label">Name <samll class="text-danger">*</samll></label>
                                    <input name="name" class="form-control form-control-alternative" placeholder="Season 01" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Review</label>
                                    <textarea name="review" class="form-control form-control-alternative"  style="height: 200px;"></textarea>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection