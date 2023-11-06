@extends('frontend.layout.layout')
@section('title', 'posts')
@section('content')
    <main class="news-articles">
        <div class="wrapper content">
            <div class="tabs_wrap">
                <ul>

                </ul>
            </div>
            <div class="tab-items-article">

                <div class="card mb-4">
                    <div class="card-header">Post list</div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Text</th>
                                <th>Media</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post['title']  }}</td>
                                    <td>{{ $post['description']  }}</td>
                                    <td><img width="400px" src="{{ $post['image']  }}" alt=""></td>
                                    <td>
                                        <span>{{ $post['created_at'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
