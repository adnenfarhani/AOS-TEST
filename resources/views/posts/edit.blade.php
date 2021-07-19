@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            
            
                
                <form method="POST" action="{{ route('posts.update' , $post->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="body"></label>
    
                        <div class="col-12">
                            <textarea id="body" name="body" rows="5"  class="form-control @error('body') is-invalid @enderror"   required    autofocus>{{ old('body', $post->body )  }}</textarea>
    
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
                                Update it !
                            </button>
                        </div>
                    </div>
                </form>
                                        {{-- 

                <div class="comments-container mx-auto my-5">
                    <div class="comments">
                      
                        @foreach ($comments as $comment)
                        <div class="comment my-3">
                            <h1 class="comment-title fw-500">
                            <a href="/2021/06/22/bootstrap-5-0-2/">
                                Bootstrap 5.0.2
                            </a>
                        </h1>
                        <div class="d-flex align-items-center justify-content-between mb-2 text-muted author-info">
                            <a class="d-flex align-items-center text-muted text-decoration-none" href="#" target="_blank" rel="noopener">
                                <span>{{ $comment->user->name }}</span>
                            </a>
                            <span class="d-flex align-items-center ml-3" title="Tue, 22 Jun 2021 00:00:00 +0000">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="mr-2" viewBox="0 0 16 16" role="img" fill="currentColor">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"></path>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                                </svg>
                                
                                {{ $comment->created_at->format('M d Y'); }}
                            </span>
                        </div>
  
                        
                        <p class="ml-3" >
                            {{ $comment->body }}
                        </p>
                    </div>
    
                        @endforeach
                    </div>
            </div>
            --}}
        </div>
    </div>
</div>
@endsection
