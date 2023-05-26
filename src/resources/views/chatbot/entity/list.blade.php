@extends('backend.admin.layouts.app')

@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.chatbot.entity.list') }}</h1>
            <p class="mb-4">{{ __('backend.chatbot.entity.list_desc') }}</p>
        </div>
        <div class="col-3 text-right">
            <a href="{{ route('admin.entity.create') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">{{ __('backend.chatbot.entity.create') }}</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>{{ __('backend.chatbot.entity.id') }}</th>
                                <th>{{ __('backend.chatbot.entity.title') }}</th>
                                <th>{{ __('backend.chatbot.entity.type') }}</th>
                                <th>{{ __('backend.chatbot.entity.status') }}</th>
                                <th>{{ __('backend.chatbot.entity.action') }}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                               <th>{{ __('backend.chatbot.entity.id') }}</th>
                                <th>{{ __('backend.chatbot.entity.title') }}</th>
                                <th>{{ __('backend.chatbot.entity.type') }}</th>
                                <th>{{ __('backend.chatbot.entity.status') }}</th>
                                <th>{{ __('backend.chatbot.entity.action') }}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($entites as $key => $entity)
                                <tr>
                                    <td>{{ $entity->id }}</td>
                                    <td>{{ $entity->title }}</td>
                                    <td>{{ $entity->type }}</td>
                                    <td>
                                       @if($entity->status=='A')
                                       <span class="badge badge-info">Active</span>
                                       @else
                                           <span class="badge badge-danger">InActive</span>
                                       @endif
                                    </td>
                                    <td class="row">
                                        <a href="{{ route('admin.entity.edit', $entity->id) }}" class="btn btn-primary btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="post" action="{{route('admin.entity.destroy',['entity'=>$entity->id])}}">
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
