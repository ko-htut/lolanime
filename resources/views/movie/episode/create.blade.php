@extends('layouts.app')
@section('title','Episode')
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
                            <h3 class="col-12 mb-0">Add Episode</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('movie/episode/store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Episode information</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                            	<input type="hidden" name="item_id" value="{{$movie->id}}">
                                <div class="form-group">
                                    <label class="form-control-label">Name <small class="text-danger">*</small></label>
                                    <input name="name" class="form-control form-control-alternative" placeholder="Wall-E" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Duration <small class="text-danger">*</small></label>
                                    <input name="duration" class="form-control form-control-alternative" placeholder="20mins" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Status <small class="text-danger">*</small></label>
                                    <select name="status" class="form-control form-control-alternative">
                                        <option value="Complete">Complete</option>
                                        <option value="Ongoing">Ongoing</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Link <small class="text-danger">*</small></label>
                                    <textarea name="link" class="form-control form-control-alternative"  style="height: 200px;" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Quality <small class="text-danger">*</small></label>
                                    <textarea name="quality" class="form-control form-control-alternative"  style="height: 200px;" required></textarea>
                                </div> 

                                <div class="form-group">
                                    <label class="form-control-label">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control form-control-alternative">
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