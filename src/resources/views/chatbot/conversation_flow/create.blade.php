<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="row justify-content-between container">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.chatbot.conversation-flow.create') }}</h1>
            <p class="mb-4">{{ __('backend.chatbot.conversation-flow.create_desc') }}</p>
        </div>
        <div class="col-3 text-right">
            <a href="" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-backspace"></i>
                </span>
                <span class="text">{{ __('backend.shared.back') }}</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4 container">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-6">
                    <form method="POST" action="{{ route('conversationflow.store') }}" class="">
                        @csrf
                        <div class="form-group">
                          <label>Title of the conversation flow</label>
                          <input type="text" name="title" class="form-control" placeholder="Title of conversation flow" value="{{old('title')}}"/>

                        </div>
                         <div class="form-group">
                            <label>Type of conversation flow</label>
                            <input type="text" name="type" class="form-control" placeholder="Type of conversation flow" value="{{old('type')}}">

                        </div>
                         <div class="form-group">
                            <label class="form-label ">Steps of conversation flow </label>
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title m-2">Configure Steps for  the configuration flow</div>
                                </div>
                                <!--Step block start here-->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Type of step</label>
                                        <input type="text" class="form-control" name="step[type]" placeholder="Type of step"  />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-lable">Select Entity</label>
                                        <select name="step[entity_id]" class="form-control">
                                       <option value="">Select an Entity</option>
                                        {{-- @foreach($entites as $entity)
                                        <option value="{{$entity['id']}}">{{$entity['title']}}</option>
                                         @endforeach
                                       </select>   --}}
                                    </div>
                                     <div class="form-group">
                                         <div>
                                             <label class="form-label">List of message</label>
                                             <button class="btn btn-info btn-circle  m-1" type="button" id="add_message"><i class="fa fa-plus"></i></button>
                                         </div>
                                         <div class="message">
                                             <div class="row ml-2 mb-2 message_in" id="0">
                                           <input type="text" class="form-control col-11" name="step[message][0]" value="" placeholder="Step message" />
                                            <button type="button" class="btn btn-danger btn-circle float-right ml-2 delete_message"><i class="fa fa-trash"></i></button>
                                        </div>
                                         </div>

                                    </div>
                                </div>

                                <!--Step block end here-->
                            </div>

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
                                        <input type="text" class="form-control" name="condition[type]" placeholder="Type of step" />
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label">Condition Field</label>
                                        <input type="text" class="form-control" name="condition[title]" placeholder="Title of display" />
                                    </div> <div class="form-group">
                                        <label class="form-label">Data source</label>
                                        <input type="text" class="form-control" name="condition[button_text]"  placeholder="Button text" />
                                    </div>
                                </div>
                                <!--Step block end here-->
                            </div>

                        </div>
                         <div class="form-group">
                            <label class="form-label ">Display for  conversation flow </label>
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title m-2">Configure Display for  the configuration flow</div>
                                </div>
                                <!--Step block start here-->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Title of display</label>
                                        <input type="text" class="form-control" name="display[title]" placeholder="Title of display" />
                                    </div>
                                    <div class="form-group">
                                       <div class="row m-1">
                                        <label class="form-label m-1">Add buttons for display</label>
                                        <button type="button" id="add_display_button" class="btn btn-info btn-circle"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <div class="buttons">
                                        <div class="row m-1 add_dbutton"  id="0">
                                             <input type="text" class="form-control col-10" name="display[buttons][0]" placeholder="Buttons to display" />
                                            <button type="button" class="btn btn-danger btn-circle ml-1 remove_display_button"><i class="fa fa-trash"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Type of display[Must be equal to Button]</label>
                                        <button type="button" id="add_display_type" class="btn btn-info btn-circle"><i class="fa fa-plus"></i></button>
                                        <div class="display_type">
                                            <div class="row m-1 add_dtype" id="0">
                                              <input type="text" class="form-control col-11" name="display[type][0]" placeholder="Type of step" />
                                              <button type="button" class="btn btn-danger btn-circle ml-1 remove_display_type"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="row m-1">
                                             <label class="form-label">References for Buttons display[Must be equal to button]</label>
                                            <button type="button" class="btn btn-info btn-circle ml-1" id="add_references_button"><i class="fa fa-plus"></i></button>
                                        </div>

                                        <div class="references">
                                            <div class="row m-1 add_references" date-referenced-id="0">
                                                <input type="" class="form-control col-11" name="display[references][0]" placeholder="References to display"/>
                                                <button type="button" class="btn btn-danger btn-circle ml-1 remove_reference_button"><i class="fa fa-trash"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                        <div class="form-group">
                                          <div class="row m-1">
                                                <lable class="form-label">Add Model for Datasource</lable>
                                                <input name="display[datasource][model]" class="form-control" placeholder="Add Model "/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="row m-1">

                                                <lable class="form-label">Add Query parameter for Datasource</lable>
                                                <input name="display[datasource][query_parameter]"  class="form-control" placeholder="Add Query Parameter "/>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                          <div class="row m-1">
                                                <lable class="form-label">Add Templete Type for Datasource</lable>
                                                <input name="display[datasource][template_type]"  class="form-control" placeholder="Templete Type"/>
                                            </div>
                                        </div>



                                </div>
                                <!--Step block end here-->
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

                                      <select class="form-control" id="reaction_type" name="reaction[type]">
                                         <option value="">Select type reaction</option>
                                          <option value="acknowledgements">Acknowledgements</option>
                                           <option value="ambiguities">Ambiguities</option>
                                            <option value="suggestions">Suggestions</option>
                                             <option value="validation">Validation</option>
                                      </select>
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label">Message of reaction</label>
                                        <input type="text" class="form-control" name="reaction[message]" placeholder="Message of reaction"/>
                                    </div>
                                    <div class="validation_field"  style="display:none;">
                                       <div class="form-group">
                                        <label class="form-label">Type of validation</label>
                                        <input type="text" class="form-control" name="reaction[validation_type]" placeholder="Type of validation"/>
                                        </div>
                                         <div class="form-group">
                                        <label class="form-label">Validation Condition</label>
                                        <input type="text" class="form-control" name="reaction[validation_condition]" placeholder="Validation condition"/>
                                        </div>
                                         <div class="form-group">
                                        <label class="form-label">Validation Datsource</label>
                                        <input type="text" class="form-control" name="reaction[validation_datasource]" placeholder="Validation Datasource"/>
                                        </div>
                                          <div class="form-group">
                                        <label class="form-label">Validation Payload</label>
                                        <input type="text" class="form-control" name="reaction[validation_payload]" placeholder="Validation Payload"/>
                                        </div>
                                           <div class="form-group">
                                        <label class="form-label">Validation Message</label>
                                        <input type="text" class="form-control" name="reaction_validation_message" placeholder="Validation Message"/>
                                        </div>
                                    </div>
                                </div>
                                <!--Step block end here-->
                            </div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
   $(document).ready(function(){

        $(document).on('click','#add_message',function(){
           let latest_message=$(this).parent().parent().find('.message');
           let index=parseInt(latest_message.find('.message_in:last').attr('id'));
           let incr_index=index+1;
           const new_messaage=`<div class="row ml-2 mb-2 message_in" id="${incr_index}">
                                           <input type="text" class="form-control col-11" name="step[message][${incr_index}]" placeholder="Step message" />
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
          let incr_index=index+1;
          console.log(incr_index);
          let button=` <div class="row m-1 add_dbutton"  id="${incr_index}">
                                             <input type="text" class="form-control col-11" name="display[buttons][${incr_index}]" placeholder="Buttons to display" />
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
          console.log(index);
          let incr_index=index+1;
          let reference=` <div class="row m-1 add_references" date-referenced-id="${incr_index}">
                                                <input type="" class="form-control col-11" name="display[references][${incr_index}]" placeholder="References to display"/>
                                                <button type="button" class="btn btn-danger btn-circle ml-1 remove_reference_button"><i class="fa fa-trash"></i></button>
                                            </div>`;
          last_references.append(reference)
      });

      $(document).on('click','.remove_reference_button',function(){
          $(this).parent().remove();
      });

      $(document).on('click','#add_display_type',function(){
          let last_display_type=$(this).parent().parent().find('.display_type');

           let element_count=parseInt(last_display_type.find('.add_dtype:last').attr('id'));
              console.log(element_count);
           let element_incr=element_count+1;
          let type_element=`<div class="row m-1 add_dtype" id="${element_incr}">
                                              <input type="text" class="form-control col-11" name="display[type][${element_incr}]" placeholder="Type of step">
                                              <button type="button" class="btn btn-danger btn-circle ml-1 remove_display_type"><i class="fa fa-trash"></i></button>
                                            </div>`;
        last_display_type.append(type_element);
      });
       $(document).on('click','.remove_display_type',function(){
          $(this).parent().remove();
       });
   });

</script>

