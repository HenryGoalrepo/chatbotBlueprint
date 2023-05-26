@extends('backend.admin.layouts.app')

@section('styles')
<style>
    .navs-postition{
        position:absolute;top:74px; left:0;width: 100%;
    }
</style>
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.chatbot.conversation-flow.edit') }}</h1>
            <p class="mb-4">{{ __('backend.chatbot.conversation-flow.edit_desc') }}</p>
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
                    <form method="POST" action="{{ route('admin.conversationflow.update',['conversationflow'=>$conversation->id]) }}" class="">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                          <label>Title of the conversation flow</label>
                          <input type="text" name="title" class="form-control" placeholder="Title of conversation flow" value="{{$conversation->title}}"/>
                          @error('title')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                         <div class="form-group">
                            <label>Type of conversation flow</label>
                            <input type="text" name="type" class="form-control" placeholder="Type of conversation flow" value="{{$conversation->type}}">
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                         <div class="form-group" style="position:relative;">
                            <label class="form-label ">Steps of conversation flow </label>
                               <ul class="nav nav-tabs">
                               @foreach($conversation->steps() as $i=>$step)
                                 <li class="nav-item">
                                 <a class="nav-link active" data-toggle="tab" href="#step{{$i}}">Step1</a>
                                 </li>
                               @endforeach
                                </ul>
                            @foreach($conversation->steps() as $i=>$step)
                             <div id="step{{$i}}" class="tab-pane  fade show @if($i==0) active @else navs-postition @endif" role="tab">
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title m-2">Configure Steps for  the configuration flow</div>
                                </div>
                                <!--Step block start here-->
                                <div class="card-body">
                                    <input type="hidden" name="step[{{$i}}][ids]" value="{{$step->id}}"/>
                                    <div class="form-group">
                                        <label class="form-label">Type of step</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][type]" placeholder="Type of step" value="{{$step->type}}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-lable">Select Entity</label>
                                        <select name="step[{{$i}}][entity_id]" class="form-control">
                                       <option value="">Select an Entity</option>
                                        @foreach($entites as $entity)
                                        <option @if($entity->id==$step['entity_id']) selected @endif value="{{ $entity->id}}">{{$entity['title']}}</option>
                                         @endforeach
                                       </select>  
                                    </div>
                                     <div class="form-group">
                                         <div>
                                             <label class="form-label">List of message</label>
                                             
                                             <button class="btn btn-info btn-circle  m-1" type="button" id="add_message"><i class="fa fa-plus"></i></button>
                                            
                                         </div>
                                         <div class="message">
                                                 @foreach($step->message as $key=>$message)
                                                  <div class="row ml-2 mb-2 message_in" id="{{$key}}">
                                           <input type="text" class="form-control col-11 " name="step[{{$i}}][message][{{$key}}]" value="{{$message}}" placeholder="Step message" /> 
                                            <button type="button" class="btn btn-danger btn-circle float-right ml-2 delete_message"><i class="fa fa-trash"></i></button>
                                             
                                             </div>
                                           @endforeach
                                           <span data-step-value="{{$i}}"></span>
                                            
                                         </div>
                                     
                                    </div>
                                </div>
                             
                                <!--Step block end here-->
                            </div>
                            <div class="form-group">
                            <label class="form-label ">Condition for  conversation flow </label>
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title m-2">Configure Condition for  the configuration flow</div>
                                </div>
                                <!--Step block start here-->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Condition Message</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][condition][type]" placeholder="Type of step" />
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label">Condition Field</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][condition][title]" placeholder="Title of display" />
                                    </div> <div class="form-group">
                                        <label class="form-label">Data source</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][condition][button_text]" placeholder="Button text" />
                                    </div>
                                </div>
                                <!--Step block end here-->
                            </div>
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                            <div class="form-group">
                            <label class="form-label">Display for  conversation flow </label>
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title m-2">Configure Display for  the configuration flow</div>
                                </div>
                                <!--Step block start here-->
                                <div class="card-body">
                                     <div class="form-group">
                                        <label class="form-label">Title of display</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][display][title]" placeholder="Title of display" value="{{$step->displays->title}}" />
                                    </div> 
                                    <div class="form-group">
                                       <div class="row m-1">
                                        <label class="form-label m-1">Add buttons for display</label>
                                        <button type="button" id="add_display_button" class="btn btn-info btn-circle"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <div class="buttons">
                                        @foreach($step->displays->buttons as $btn_key=>$button)
                                        <div class="row m-1 add_dbutton"  id="{{$btn_key}}">
                                             <input type="text" class="form-control col-11" name="step[{{$i}}][display][buttons][{{$btn_key}}]" placeholder="Buttons to display" value="{{$button}}" />
                                            <button type="button" class="btn btn-danger btn-circle ml-1 remove_display_button"><i class="fa fa-trash"></i></button>
                                              
                                        </div> 
                                        @endforeach
                                        <span data-step-value="{{$i}}"></span>
                                    </div>
                                      <div class="form-group">
                                        <label class="form-label">Type of display[Must be equal to Button]</label>
                                        <button type="button" id="add_display_type" class="btn btn-info btn-circle"><i class="fa fa-plus"></i></button>
                                        <div class="display_type">
                                            @foreach($step->displays->type as $type_key=>$type)
                                            <div class="row m-1 add_dtype" id="{{$type_key}}">
                                              <input type="text" class="form-control col-11" name="step[{{$i}}][display][type][{{$type_key}}]" value="{{$type}}" placeholder="Type of step" />
                                              <button type="button" class="btn btn-danger btn-circle ml-1 remove_display_type"><i class="fa fa-trash"></i></button>    
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="row m-1">
                                             <label class="form-label">References for Buttons display[Must be equal to button]</label>
                                            <button type="button" class="btn btn-info btn-circle ml-1" id="add_references_button"><i class="fa fa-plus"></i></button>
                                        </div>
                                       
                                        <div class="references">
                                             @foreach($step->displays->references as $ref_key=>$refer)
                                            <div class="row m-1 add_references" date-referenced-id="{{$ref_key}}">
                                                <input type="text" class="form-control col-11" name="step[{{$i}}][display][references][{{$ref_key}}]" value="{{$refer}}" placeholder="References to display"/>
                                                <button type="button" class="btn btn-danger btn-circle ml-1 remove_reference_button"><i class="fa fa-trash"></i></button>
                                                 
                                            </div>
                                            @endforeach
                                             <span data-step-value="{{$i}}"></span>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                          <div class="row m-1">
                                                <lable class="form-label">Add Model for Datasource</lable>
                                                <input name="step[{{$i}}][display][datasource][model]" class="form-control" @if(!empty($step->displays->datasource['model'])) value="{{$step->displays->datasource['model']}}" @endif placeholder="Add Model "/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="row m-1">
                                              
                                                <lable class="form-label">Add Query parameter for Datasource</lable>
                                                <input name="step[{{$i}}][display][datasource][query_parameter]"  class="form-control" @if(!empty($step->displays->datasource['query_parameter'])) value="{{$step->displays->datasource['query_parameter']}}" @endif placeholder="Add Query Parameter "/>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                          <div class="row m-1">
                                                <lable class="form-label">Add Templete Type for Datasource</lable>
                                                <input name="step[{{$i}}][display][datasource][template_type]"  class="form-control" @if(!empty($step->displays->datasource['template_type'])) value="{{$step->displays->datasource['template_type']}}" @endif placeholder="Templete Type"/>
                                            </div>
                                        </div>
                                     
                                    
                                      
                                </div>
                                <!--Step block end here-->
                            </div>
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                            </div>
                            <div class="form-group">
                            <label class="form-label">Reactions for  conversation flow </label>
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title m-2">Configure Reactions for  the configuration flow</div>
                                </div>
                                <!--Step block start here-->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Type of reaction</label>
    
                                      <select class="form-control" id="reaction_type" name="step[{{$i}}][reaction][type]">
                                         <option @if(isset($step->reactions['type'])=='') selected @endif value="">Select type reaction</option>
                                          <option  @if(isset($step->reactions['type'])=='acknowledgements') selected @endif value="acknowledgements">Acknowledgements</option>
                                           <option  @if(isset($step->reactions['type'])=='ambiguities') selected @endif value="ambiguities">Ambiguities</option>
                                            <option  @if(isset($step->reactions['type'])=='suggestions') selected @endif value="suggestions">Suggestions</option>
                                             <option  @if(isset($step->reactions['type'])=='validation') selected @endif value="validation">Validation</option>
                                      </select>
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label">Message of reaction</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][reaction][message]" @if($step->reactions) value="{{$step->reactions['message']}}" @endif />
                                    </div> 
                                    <div class="validation_field" @if(isset($step->reactions['type'])=='validation') style="display:block;" @else style="display:none;" @endif >
                                       <div class="form-group">
                                        <label class="form-label">Type of validation</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][reaction][validation_type]" @if(isset($step->reactions['validation_type'])) value="{{$step->reactions['validation_type']}}" @endif placeholder="Type of validation"/>
                                        </div>    
                                         <div class="form-group">
                                        <label class="form-label">Validation Condition</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][reaction][validation_condition]" @if(isset($step->reactions['validation_type'])) value="{{$step->reactions['validation_condition']}}" @endif placeholder="Validation condition"/>
                                        </div>    
                                         <div class="form-group">
                                        <label class="form-label">Validation Datsource</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][reaction][validation_datasource]" @if(isset($step->reactions['validation_type'])) value="{{$step->reactions['validation_datasource']}}" @endif placeholder="Validation Datasource"/>
                                        </div>    
                                          <div class="form-group">
                                        <label class="form-label">Validation Payload</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][reaction][validation_payload]"  @if(isset($step->reactions['validation_type'])) value="{{$step->reactions['validation_payload']}}" @endif placeholder="Validation Payload"/>
                                        </div> 
                                           <div class="form-group">
                                        <label class="form-label">Validation Message</label>
                                        <input type="text" class="form-control" name="step[{{$i}}][reaction][validation_message]" @if(isset($step->reactions['validation_type'])) value="{{$step->reactions['validation_message']}}" @endif placeholder="Validation Message"/>
                                        </div> 
                                    </div>
                                </div>
                                <!--Step block end here-->
                            </div>
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>  
                            </div>
                         
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                             </div>  
                            </div>
                            @endforeach
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
<script>
   $(document).ready(function(){
      
        $(document).on('click','#add_message',function(){
           let latest_message=$(this).parent().parent().find('.message');
           let index=parseInt(latest_message.find('.message_in:last').attr('id'));
           let step_index=$(this).parent().parent().find('span').attr('data-step-value');
           let incr_index=index+1;
           const new_messaage=`<div class="row ml-2 mb-2 message_in" id="${incr_index}">
                                           <input type="text" class="form-control col-11" name="step[${step_index}][message][${incr_index}]" placeholder="Step message" /> 
                                            <button type="button" class="btn btn-danger btn-circle float-right ml-2 delete_message"><i class="fa fa-trash"></i></button>
                                        </div> `;
          latest_message.append(new_messaage);
      });
      
      $(document).on('click','.delete_message',function(){
          $(this).parent().remove();
      });
      
      $(document).on('change','#reaction_type',function(){
          let type=$(this).val();
          if(type=='validation'){
            $('.validation_field').css('display','block');
          }else{
               $('.validation_field').css('display','none'); 
          }
      });
      
      $(document).on('click','#add_display_button',function(){
          let last_button=$(this).parent().parent().find('.buttons');
          let index=parseInt(last_button.find('.add_dbutton:last').attr('id'));
          let step_index=$(this).parent().parent().find('span').attr('data-step-value');
          let incr_index=index+1;
          console.log(incr_index);
          let button=` <div class="row m-1 add_dbutton"  id="${incr_index}">
                                             <input type="text" class="form-control col-11" name="step[${step_index}][display][buttons][${incr_index}]" placeholder="Buttons to display" />
                                            <button type="button" class="btn btn-danger btn-circle ml-1 remove_display_button"><i class="fa fa-trash"></i></button>
                                        </div> `;
          last_button.append(button)
      });
      
      $(document).on('click','.remove_display_button',function(){
          $(this).parent().remove();
      });
      
        $(document).on('click','#add_references_button',function(){
          let last_references=$(this).parent().parent().find('.references');
          console.log(last_references);
          let index=parseInt(last_references.find('.add_references:last').attr('date-referenced-id'));
          let step_index=$(this).parent().parent().find('span').attr('data-step-value');
          console.log(index);
          let incr_index=index+1;
          let reference=` <div class="row m-1 add_references" date-referenced-id="${incr_index}">
                                                <input type="" class="form-control col-11" name="step[${step_index}][display][references][${incr_index}]" placeholder="References to display"/>
                                                <button type="button" class="btn btn-danger btn-circle ml-1 remove_reference_button"><i class="fa fa-trash"></i></button>
                                            </div>`;
          last_references.append(reference)
      });
      
      $(document).on('click','.remove_reference_button',function(){
          $(this).parent().remove();
      });
        $(document).on('click','#add_display_type',function(){
          let last_display_type=$(this).parent().parent().find('.display_type');
         let step_index=$(this).parent().parent().find('span').attr('data-step-value');
           let element_count=parseInt(last_display_type.find('.add_dtype:last').attr('id'));
              console.log(element_count);
           let element_incr=element_count+1;
          let type_element=`<div class="row m-1 add_dtype" id="${element_incr}">
                                              <input type="text" class="form-control col-11" name="step[${step_index}][display][type][${element_incr}]" placeholder="Type of step">
                                              <button type="button" class="btn btn-danger btn-circle ml-1 remove_display_type"><i class="fa fa-trash"></i></button>    
                                            </div>`;
        last_display_type.append(type_element);
      });
       $(document).on('click','.remove_display_type',function(){
          $(this).parent().remove();
       });
   });
  
</script>
@endsection

