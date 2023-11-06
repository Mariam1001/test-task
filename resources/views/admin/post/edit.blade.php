@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-plus"></i></div>
                                edit Post
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('posts.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Back to All Posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row gx-4">
                    <div class="col-lg-6">
                        <input type="hidden" name="id" value="{{ $post->id }}">

                        <div class="card mb-4">
                            <div class="card-header">Title</div>
                            <div class="card-body">
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title', $post->title) }}">
                            </div>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">Description</div>
                            <div class="card-body">
                                <textarea class="form-control" id="description"
                                          name="description">{{ old('description', $post->description) }}</textarea>
                            </div>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card mb-4">
                            <img width="" src="{{ $post->image }}" alt="">
                        </div>

                        <div>
                            <div class="card-d"><input type="checkbox" name="generate_new_img"> Generate new Image? </div>
                        </div>
                        <br>
                        <br>
                        <br>

                    </div>

                        <div class="d-grid"><button class="fw-500 btn btn-primary">Update</button></div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
