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
                            <h3 class="col-12 mb-0">Edit Episode</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('episode') }}/{{$data->id}}/edit" autocomplete="off" enctype="multipart/form-data">
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
                            	<input type="hidden" name="season_id" value="{{$data->season_id}}">
                            	<input type="hidden" name="item_id" value="{{$data->item_id}}">
                                <div class="form-group">
                                    <label class="form-control-label">Name <small class="text-danger">*</small></label>
                                    <input name="name" class="form-control form-control-alternative" value="{{$data->name}}" placeholder="Wall-E" required autofocus>
                                </div>

                                


                                <div class="form-group">
                                    <label class="form-control-label">Link <small class="text-danger">*</small></label>
                                    <textarea name="link" class="form-control form-control-alternative"  style="height: 200px;" required>{{$data->link}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Quality <small class="text-danger">*</small></label>
                                    <textarea name="quality" class="form-control form-control-alternative"  style="height: 200px;" required>{{$data->quality}}</textarea>
                                </div>                         

                                <div class="form-group">
                                    <label class="form-control-label">Subtitle</label>
                                    <input type="text" name="subtitle" value="{{$data->subtitle}}" class="form-control form-control-alternative">
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