@extends('frontend.layout.layout')
@section('title', 'posts')
@section('content')
    <main class="news-articles">
        <div class="wrapper content">
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

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row gx-4">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">Email</div>
                                <div class="card-body">
                                    <input class="form-control" name="email" id="inputLoginAddress" type="login" value="{{ old('email', $user->email) }}" placeholder="Enter user email" />
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">Name</div>
                                <div class="card-body">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name', $user->name) }}">
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">Password</div>
                                <div class="card-body">
                                    <input name="password" class="form-control" id="inputPassword" type="password" value="" placeholder="Enter password" />
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">Image</div>

                                <div class="card-body">
                                    <img width="100px" src="{{ URL::to('storage/' . $user->image) }}" alt="">
                                </div>
                                <div class="card-body">
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>
                                @error('file')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="d-grid"><button class="fw-500 btn btn-primary">Update</button></div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
