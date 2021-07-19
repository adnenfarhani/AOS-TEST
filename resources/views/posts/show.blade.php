@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="bg-white shadow-sm rounded-sm p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div class="d-flex align-items-center  text-muted author-info">
                        <a class="d-flex align-items-center text-muted text-decoration-none" href="#" rel="noopener">
                            <span>{{ $post->user->name }}</span>
                        </a>
                        <span class="d-flex align-items-center ml-3" title="Tue, 22 Jun 2021 00:00:00 +0000">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="mr-2"
                                viewBox="0 0 16 16" role="img" fill="currentColor">
                                <path
                                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z">
                                </path>
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z">
                                </path>
                            </svg>

                            {{ $post->created_at->format('M d Y'); }}
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        @can('edit-post', $post)

                        <a class="btn btn-light" href="{{ route('posts.edit' , $post->id) }}" rel="noopener">
                            <span>Edit</span>
                        </a>
                        @endcan
                        @can('delete-post', $post)
                        <form action="{{ route('posts.destroy' , $post->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-link text-danger ml-2" rel="noopener">
                                Delete
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>

                <p class="ml-3 display-5">
                    {{ $post->body }}
                </p>

            </div>

            {{-- comment section --}}





            <div class="comments-container mx-auto my-5 ">
                <form class="my-3" method="POST" action="{{ route('comments.store' , $post->id)}}">
                    @csrf
                    <div class="form-group row">
                        <label for="body"></label>

                        <div class="col-12">
                            <textarea id="body" name="body" rows="3"
                                class="form-control @error('body') is-invalid @enderror" value="{{ old('body') }}"
                                required autocomplete="body" autofocus></textarea>

                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ml-auto">
                                Post you comment !
                            </button>
                        </div>
                    </div>
                </form>
                <div class="comments">

                    @foreach ($comments as $comment)
                    <div class="comment my-2 bg-white shadow-sm rounded-sm px-4 py-2 ">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-center  text-muted author-info">
                                <a class="d-flex align-items-center text-muted text-decoration-none" href="#"
                                    rel="noopener">
                                    <span>{{ $comment->user->name }}</span>
                                </a>
                                <span class="d-flex align-items-center ml-3" title="Tue, 22 Jun 2021 00:00:00 +0000">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="mr-2"
                                        viewBox="0 0 16 16" role="img" fill="currentColor">
                                        <path
                                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z">
                                        </path>
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z">
                                        </path>
                                    </svg>

                                    {{ $comment->created_at->format('M d Y'); }}
                                </span>
                            </div>

                            <div class="d-flex align-items-center j">
                                {{-- @can('edit-comment', $comment)
        
                                <a class="btn btn-light" href="{{ route('comments.edit' , $comment->id) }}" rel="noopener">
                                <span>Edit</span>
                                </a>
                                @endcan

                                --}}
                                @can('delete-comment', $comment)
                                <form action="{{ route('comments.destroy' , $comment->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link text-danger ml-2" rel="noopener">
                                        Delete
                                    </button>
                                </form>
                                @endcan

                            </div>
                    </div>


                    <p class="ml-3">
                        {{ $comment->body }}
                    </p>
                </div>

                @endforeach
            </div>
            <div class="float-right">

                {{ $comments->links() }}
            </div>
            {{-- end! comment section --}}
        </div>


    </div>
</div>
</div>
@endsection
