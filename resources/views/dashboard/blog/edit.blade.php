@extends('dashboard.blog._layout', ['title' => __('Blog posts management')])

@section('content')
    @include('dashboard.partials.page.header', ['title' => $post->title])


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                @include('dashboard.partials.alert')
            </div>

            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit post') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('blog.view', $post->slug) }}" class="btn btn-sm btn-primary" target="_blank">View on website</a>
                                <a href="{{ route('dashboard.blog.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('dashboard.blog.update', $post) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-control-label">{{ __('Post title') }}</label>
                                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                        <input type="text" name="title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Post title') }}"
                                               value="{{ old('title', $post->title) }}" required autofocus>

                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Markdown') }}</h6>
                                    <div>
                                        <div class="form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                                            <textarea name="body" style="height: 600px" id="markdown-input" class="form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                                      required>{{ old('body', $post->body) }}</textarea>

                                            @if ($errors->has('body'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('body') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Preview') }}</h6>
                                    <div>
                                        <div id="markdown-preview" style="height: 600px"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-center">
                                        <div class="form-check">
                                            <input type="checkbox" name="draft" value="1" @if($post->draft) checked @endif class="form-check-input" id="draftCheck">
                                            <label class="form-check-label" for="draftCheck">Save as draft</label>
                                            @if ($errors->has('draft'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('draft') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.layouts.footers.auth')
    </div>
@endsection
