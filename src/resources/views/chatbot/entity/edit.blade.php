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
                    <form method="POST" action="{{ route('admin.entity.update',['entity'=>$entity->id]) }}" class="">
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-lable">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$entity->title}}"/>
                        
                        </div>
                         <div class="form-group">
                            <label class="form-lable">Type</label>
                            <input type="text" class="form-control" name="type"  value="{{$entity->type}}"/>
                        </div>
                          <div class="form-group">
                            <label class="form-lable">Status</label>
                            <select class="form-control">
                               <option @if($entity->status=='A') selected @endif value="{{$entity->status}}">Active</option>
                               <option @if($entity->status=='IN') selected @endif value="{{$entity->status}}">Inactive</option>
                            </select>
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
                    <form method="POST" action="{{ route('admin.entity.update',['entity'=>$entity->id]) }}" class="">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="form-lable">Title</label>
                            <input type="text" class="form-control" name="title"  value="{{$entity->title}}"/>
                        </div>
                         <div class="form-group">
                            <label class="form-lable">Type</label>
                            <input type="text" class="form-control" name="type" value="{{$entity->type}}"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                           <select class="form-control">
                               <option @if($entity->status=='A')) selected @endif value="A" >Active</option>
                               <option @if($entity->status=='IN'))selected @endif value="IN" >Inactive</option>
                           </select>
                        </div>
                         <div class="form-group">
                           <input class="btn btn-success text-white" type="submit" value="Update" />
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
