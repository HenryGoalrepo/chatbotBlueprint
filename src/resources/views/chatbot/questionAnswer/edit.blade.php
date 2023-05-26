@extends('backend.admin.layouts.app')

@section('styles')
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.chatbot.trigger.create') }}</h1>
            <p class="mb-4">{{ __('backend.chatbot.triggers.create_desc') }}</p>
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
                    <form method="POST" action="{{ route('admin.triggers.update',['trigger'=>$trigger->id]) }}" class="">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="form-lable">Select Conversation</label>
                             <select class="form-control" name="conversation_id">
                             <option value="" >Conversation that will be trigger</option>
                             @foreach($conversations as $conversation)
                             <option @if($trigger->conversation->id == $conversation->id) selected @endif value="{{$conversation->id}}">{{$conversation->title}}--{{$conversation->type}}</option>
                             @endforeach
                             </select>
                            @error('conversation_id')
                            <span class="text-danger font-bold">{{$message}}</span>
                            @enderror
                        </div>
                          <div class="form-group">
                            <label class="form-lable">Enter the expressions for conversation</label>
                            <div class="form-group">
                                <label class="form-lable col-10">Add more expressions for conversation</label>
                                <button type="button" class="btn btn-info btn-circle" id="add_expression"><i class="fa fa-plus"></i></button>
                            </div>
                            <div class="expression ml-2" >
                                @foreach($trigger->expression as $key=>$exp)
                                <div class="exp-block row " data-exp-id="{{$key}}">
                                    <input type="text" class="form-control col-11" name="expression[{{$key}}]" placeholder="Expression Type" value="{{$exp}}"/> 
                                 <button type="button" class="btn btn-danger btn-circle ml-1 remove_expression"><i class="fa fa-trash"></i></button>
                                </div>
                                @endforeach
                            </div>
                            @error('expression.*')
                            <span class="text-danger font-bold">{{$message}}</span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label class="form-lable">Enter the instant response for conversation</label>
                            <div class="form-group">
                                <label class="form-lable">Add more instant response for conversation</label>
                                <button type="button" class="btn btn-info btn-circle" id="add_response"><i class="fa fa-plus"></i></button>
                            </div>
                                <div class="instant ml-2">
                                    @php
                                      $i=0;
                                    @endphp
                                    @if(isset($trigger->instant_response[0]["e_key"]))
                                    @foreach($trigger->instant_response as $key=>$ins_res)
                                    <div class="inst_block row " data-exp-id="{{$i}}">
                                     <input type="text" class="form-control col-4" name="instant_response[e_key][{{$i}}]" value="{{$key}}" placeholder="Instant Response Key" /> 
                                     <input type="text" class="form-control col-7 ml-2" name="instant_response[e_value][{{$i}}]" value="{{$ins_res}}"placeholder="Instant Response Value" />   
                                    <button type="button" class="btn btn-danger btn-circle ml-2 remove_response"><i class="fa fa-trash"></i></button>   
                                    </div>
                                     @php
                                      $i++;
                                    @endphp
                                    @endforeach
                                    @else
                                     <div class="inst_block row " data-exp-id="0">
                                     <input type="text" class="form-control col-4" name="instant_response[e_key][0]" value="" placeholder="Instant Response Key" /> 
                                     <input type="text" class="form-control col-7 ml-2" name="instant_response[e_value][0]" value=""placeholder="Instant Response Value" />   
                                    <button type="button" class="btn btn-danger btn-circle ml-2 remove_response"><i class="fa fa-trash"></i></button>   
                                    </div>
                                    @endif
                                </div>
                          
                            @error('expression')
                            <span class="text-danger font-bold">{{$message}}</span>
                            @enderror
                        </div>
                         <div class="form-group">
                           <input class="btn btn-success text-white " type="submit" value="Update" />
                        </div>
                     @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#add_expression').on('click',function(){
            let parent=$(this).parent().parent().find('.expression');
            console.log(parent.find('.exp-block:last').length);
            let index=parseInt(parent.find('.exp-block:last').attr('data-exp-id'));
            let incr_index=index+1;
            let expression= `<div class="exp-block row "data-exp-id="${incr_index}">
                                    <input type="text" class="form-control col-11" name="expression[${incr_index}]" placeholder="Expression Type" /> 
                                 <button type="button" class="btn btn-danger btn-circle ml-1 remove_expression"><i class="fa fa-trash"></i></button>
                                </div>`;
        
             parent.append(expression);
           
            
        });
          $('#add_response').on('click',function(){
              let parent=$(this).parent().parent().find('.instant');
              let index=parseInt(parent.find('.inst_block:last').attr('data-exp-id'));
              let incr_index=index+1;
              console.log(incr_index);
                let  instant=`<div class="inst_block row" data-exp-id="${incr_index}">
                                     <input type="text" class="form-control col-4" name="instant_response[e_key][${incr_index}]" placeholder="Instant Response Key" /> 
                                     <input type="text" class="form-control col-7 ml-2" name="instant_response[e_value][${incr_index}]" placeholder="Instant Response Value" />   
                                    <button type="button" class="btn btn-danger btn-circle ml-2 remove_response"><i class="fa fa-trash"></i></button>   
                                    </div>`;    
            parent.append(instant);
        })
        
        $(document).on('click','.remove_expression',function(){
            $(this).parent().remove();
        });
        
          $(document).on('click','.remove_response',function(){
             $(this).parent().remove();
        });
            
    });
</script>
@endsection

