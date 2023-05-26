@extends('backend.admin.layouts.app')

@section('styles')
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.chatbot.entity.create') }}</h1>
            <p class="mb-4">{{ __('backend.chatbot.entity.create_desc') }}</p>
        </div>
        <div class="col-3 text-right">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-backspace"></i>
                </span>
                <span class="text">{{ __('backend.shared.back') }}</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-6">
                    <form method="POST" action="{{ route('admin.entity.store') }}" class="">
                        @csrf
                        <div class="form-group">
                            <label class="form-lable">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Entity Title" value="{{old('title')}}"/>
                            @error('title')
                            <span class="text-danger font-bold">{{$message}}</span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label class="form-lable">Type</label>
                            <input type="text" class="form-control" name="type" placeholder="Entity Type" value="{{old('type')}}"/>
                            @error('type')
                            <span class="text-danger font-bold">{{$message}}</span>
                            @enderror
                        </div>
                         <div class="form-group">
                           <input class="btn btn-success text-white" type="submit" value="Create" />
                        </div>
                     @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
@extends('backend.admin.layouts.app')

@section('styles')
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.chatbot.entity.create') }}dasdasd</h1>
            <p class="mb-4">{{ __('backend.chatbot.entity.create_desc') }}</p>
        </div>
        <div class="col-3 text-right">
            <a href="{{ route('admin.entity.index') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-backspace"></i>
                </span>
                <span class="text">{{ __('backend.shared.back') }}</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-6">
                    <form method="POST" action="{{ route('admin.entity.store') }}" class="">
                        @csrf

                    
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
