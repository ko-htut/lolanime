@extends('layouts.app')
@section('title','Series')
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
                            <h3 class="col-12 mb-0">Add Series</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('series.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Series information</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="form-control-label">Langauge</label>
                                        <select name="language_id" class="form-control form-control-alternative"required>
                                            @foreach($language as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4" id="app">
                                        <label class="form-control-label">Category</label>
                                        <multiselect v-model="selected" track-by="id" :options="options" placeholder="Search Class Code" label="name" :multiple="true">
                                        </multiselect>
                                        <input type="hidden" name="category_id[]" v-for="categories in selected" :value="categories.id">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-control-label">Is Feature</label>
                                        <select name="is_feature" class="form-control form-control-alternative"required>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <input name="name" class="form-control form-control-alternative" placeholder="Wall-E" required autofocus>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="form-control-label">Year</label>
                                        <input name="release_year" class="form-control form-control-alternative" placeholder="2007" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-control-label">Content Rating</label>
                                        <input name="content_rating" class="form-control form-control-alternative" placeholder="13" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-control-label">IMDB Rating</label>
                                        <input name="imdb_rating" class="form-control form-control-alternative" placeholder="85" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="form-control-label">Duration <small class="text-danger">*</small></label>
                                        <input name="duration" class="form-control form-control-alternative" placeholder="20mins" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="form-control-label">Status <small class="text-danger">*</small></label>
                                        <select name="status" class="form-control form-control-alternative">
                                            <option value="Complete">Complete</option>
                                            <option value="Ongoing">Ongoing</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label class="form-control-label">Episode Count</label>
                                        <input type="number" name="episode_count" class="form-control form-control-alternative">
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea name="description" class="form-control form-control-alternative"  style="height: 200px;" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Upload Poster</label>
                                    <input name="poster" type="file" class="form-control form-control-alternative"/>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Upload Cover</label>
                                    <input name="cover" type="file" class="form-control form-control-alternative"/>
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

@push('js')

<script type="text/javascript">
     new Vue ({
        el : '#app',
        components: {
            Multiselect: window.VueMultiselect.default
        },
        data () {
            return {
            selected: [],
            options: []
        }
    },
    methods : {
        read: function() {
        window.axios.get('https://lolanimm.fun/vue/category/search')
            .then(function (response) {
                this.options = response.data;
            }.bind(this));
        }
    },
    mounted(){
        this.read();
        }
    });


</script>

@endpush