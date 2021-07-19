@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <form method="POST" action="{{ route('posts.store')}}">
                @csrf
                <div class="form-group row">
                    <label for="body"></label>

                    <div class="col-12">
                        <textarea id="body" name="body" rows="5"  class="form-control @error('body') is-invalid @enderror"  value="{{ old('body') }}" required autocomplete="body" autofocus></textarea>

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
                            Post it !
                        </button>
                    </div>
                </div>
            </form>

            
            <div class="posts-container   my-5">
                <div class="posts">
                  
                    @foreach ($posts as $post)
                    <div class="my-3 bg-white shadow-sm rounded-sm p-4">

                    <a href="{{ route('posts.show' , $post->id) }}" class="post">

                            {{-- 
                        <h1 class="post-title fw-500">
                            <a href="/2021/06/22/bootstrap-5-0-2/">
                                Bootstrap 5.0.2
                            </a>dd
                        </h1> --}}
                        <div class="d-flex align-items-center justify-content-between mb-2 text-muted author-info">
                            <div class="d-flex align-items-center text-muted text-decoration-none" href="#" target="_blank" rel="noopener">
                                {{-- <img class="mb-0 mr-2" srcset="#.png?size=32, #.png?size=64 2x" src="#.png?size=32" alt="" width="32" height="32"> --}}
                                <span>{{ $post->user->name }}</span>
                            </div>
                            <span class="d-flex align-items-center ml-3" title="Tue, 22 Jun 2021 00:00:00 +0000">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="mr-2" viewBox="0 0 16 16" role="img" fill="currentColor">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"></path>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                                </svg>
                                
                                {{ $post->created_at->format('M d Y'); }}
                            </span>
                        </div>
                        {{-- <div class="embed-responsive embed-responsive-16by9">
                        </div> --}}
                        
                        
                        <p class="ml-3" >
                            {{ $post->body }}
                        </p>
                    </a>
                    <form method="POST" id="addCommentForm_{{ $post->id }}" class="mb-1 row px-2" action="{{ route('comments.store' , $post->id)}}">
                        @csrf
                        <div class=" col-lg-10 col-12 form-group row mx-0 ">
                            <label for="body"></label>
    
                            <div class="col-12">
                                <textarea id="body" name="body" rows="2"
                                    class="form-control @error('body') is-invalid @enderror" value="{{ old('body') }}"
                                    required autocomplete="body" autofocus></textarea>
    
                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
    
    
                        <div class="col-lg-2 col-12 form-group row mb-0 p-0">
                            <div class="col-12 d-flex justify-content-sretch align-items-start pl-0 ">
                                <button type="submit" class=" btn btn-primary ml-auto">
                                    comment
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="comments bg-white shadow-xs rounded-sm py-1 px-4 allComments">
                        @forelse ($post->comments as $comment)


                            <div class="comment" >
                                <div
                                class="d-flex align-items-center justify-content-between mb-1 text-muted author-info">
                                    <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center text-muted text-decoration-none" href="#"
                                                target="_blank" rel="noopener">
                                                <span>{{ $comment->user->name }}</span>
                                            </div>
                                            <span class="d-flex align-items-center ml-3"
                                                title="Tue, 22 Jun 2021 00:00:00 +0000">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" class="mr-2"
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
                                        <form  action="{{ route('comments.destroy' , $comment->id) }}" method="POST">
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
                        @empty
                        <span>
                            no comments yet
                        </span>
                        @endforelse
                    </div>
                </div>

                    @endforeach
                </div>
                <div class="float-right">

                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
