<?php
namespace ChatBot\Blueprint\Http\Controllers;
use App\Http\Controllers\Controller;
use App\ConversationFlow;
use App\Trigger;
use App\Entity;
use App\Step;
use App\User;
use App\Category;
use App\Reaction;

use App\State;
use App\City;
use App\Country;
use App\Item;
use App\Display;
use BOT;
use Cookie;
use App\BotLog;
use App\BotInquiry;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use App\ThreadItem;
use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
class ChatBotController extends Controller
{

     public $user_selection="<li>
                            <div class=\"row human\">
                                <div class=\"col-md-8 col-8\"><p class=\"replyp\"> * </p></div>
                            </div>
                        </li>";
                            public $coming_soon="<li style=\"margin-top:10px;\">
<div class=\"row\">
<div class=\"col-md-2 col-2\">
    <img src=\"https://blkzone.org/laravel_project/public/frontend/images/chatbot/wu_icon.png\" alt=\"bot icon\">
</div>
<div class=\"col-md-8 col-8\">
<p class=\"normalp\">This option will be avialable in the near future.Though, you can try other options. </p>
</div>
</div>
</li>";
 public $optimize="<li style=\"margin-top:10px;\">
<div class=\"row\">
<div class=\"col-md-2 col-2\">
    <img src=\"https://blkzone.org/laravel_project/public/frontend/images/chatbot/wu_icon.png\" alt=\"bot icon\">
</div>
<div class=\"col-md-8 col-8\">
<p class=\"normalp\">Sorry.i did not get what you searching for.You should optimize your serch query,or add some important keyword(like country,catgory,listing etc).Zak follow grammer rule.I’m glad to be of service.

</p>
<p class=\"normalp\">The search pattern is designed in such a way that no naming confict will occur.Means a country has various state and city with same name.By keeping this confilct in mind,You must configure your search query like this.

</p>
<p class=\"normalp\">The search pattern is:- <span style=\"color:#ff0018\">category_name country_name state_name city_name</span> only in this pattern.

</p>
<p class=\"normalp\">And you can also get the all listing of country.Using only country name.If still not able to find ,try advance search.

</p>
</div>
</div>
</li>";



    public function fetchConversation(Request $request){
        if($request->ajax()){
            $conversation=ConversationFlow::where('title',$request->title)->get();
             $template="";
            foreach( $conversation as $convo){
                $convo->steps=$convo->steps();
            }
            $template=view('frontend.chatbot.templates.static.welcome',compact('conversation'))->render();
            $bot=BOT::generateLog($template,$conversation->first()->id);
            return response()->json([
                'code'=>'200',
                'message'=>'Conversation Fetched successfully',
                'data'=>$conversation,
                'template'=> $template,
                'bot'=>$bot
                ]);
        }
    }

    public function fetchDisplayConversation(Request $request){
         //return $request->all();
         $categories_array=[];
        if($request->ajax()){
           $conversations=null;
            if($request->type=="quick_reply"){
                $conversations=$this->quickReply($request);
            }
           if($request->type=="datasource"){
                $conversations=$this->dataReply($request);
            }
            //  $categories_array=explode(',',$request->source);
            //                 $categories_array=array_filter( $categories_array);
            //                 return  $categories_array;
            //If Error occur un comment all value just below this line
           // return $conversations;
           if($conversations['data']!=null){
             return response()->json([
                'code'=>'200',
                'message'=>'Conversation Fetched successfully',
                'data'=>$conversations['data'],
                'template'=>$conversations['template'],
                'res'=>$conversations
                ]);
           }else{
                return response()->json([
                'code'=>'500',
                'message'=>$conversations['message'],
                'data'=>$conversations['data'],
                'template'=>$conversations['template'],
                'res'=>$conversations
                ]);
           }

        }
    }

    public function quickReply($request){
            $response=[];
           $item=null;
        try{
             $entity=Entity::where('title',$request->ref)->first();
             if(empty($entity)){
                 throw new Exception('No Entity Found.');
             }
           if($request->ref=='chat_with_owner'){
               if(Auth::check()||Auth::guard('customer')->check()){
                    $entity=Entity::where('title','start_chat')->first();
               }
           }
           if($request->ref=='chat_with_excutive'){
               if(Auth::check()){
                $entity=Entity::where('title','start_chat')->first();
               }
           }
           $step=Step::where('entity_id',$entity->id)->first();
            if(empty($step)){
               throw new Exception('No Step Found.');
            }
            if(isset($request->source)){
                    Session::forget('item_slug');
                    $item=Item::where('item_slug',$request->source)->where('item_status','2')->first();
                    Session::put('item_slug',$request->source);
                    Session::save();
            }

            //If Error occur un comment all value just below this line
          //  return $item;
             $this->user_selection=str_ireplace('*',$request->btn_text,$this->user_selection);
               $conversations=ConversationFlow::whereJsonContains('steps',$step->id)->get();
                $response=$this->quickReplyCoversation($conversations,$item);
                return $response;
        }catch(Exception $ex){
                $response['data']=null;
               $response['template']=$this->coming_soon;
               $response['message']=__LINE__.$ex->getMessage();
                $response['trace']=$ex->getTrace();
                $response['code']=$ex->getCode();
                return $response;
        }
    }

    public function dataReply($request){
        $response=null;
        try{
            $entity=Entity::where('title',$request->ref)->first();
            if(empty($entity)){
                throw new Exception('No Entity Found.');
            }
            $step=Step::where('entity_id',$entity->id)->first();
            if(empty($step)){
              throw new Exception('No Step Found.');
            }
            $display=Display::where('id',$step->display_id)->first();
            if(empty($display)){
                throw new Exception('No Display Found.');
            }
            if(empty($step)){
               throw new Exception('No Step Found.');
              }
               $this->user_selection=str_ireplace('*',$request->btn_text,$this->user_selection);
               $conversations=ConversationFlow::whereJsonContains('steps',$step->id)->get();

               if(!empty($display->datasource)){
                  // return   $conversations;
               $response=$this->dataReplyConversation($conversations,$display,$request);
               return $response;
          }
        }catch(Exception $ex){
              $response['data']=$response;
               $response['template']=$this->coming_soon;
                $response['message']=__LINE__.$ex->getMessage();
                return $response;
        }

        }

    public function quickReplyCoversation($conversations,$item=null){
          $template="";
            $response=[];
            $login=[];
            $bot=null;
            $update_step=false;
         foreach($conversations as $conver){
                   $conver->steps=$conver->steps();
                   $steps=$conver->steps;
                   foreach($steps as $step){
                       if($step['reactions']){
                           if($step['reactions']['type']=='validation'){
                               if($step['reactions']['validation_type']=='availability')
                               {
                                       $reaction=Reaction::where('id',$step['reaction_id'])->first();
                                       $login=$this->checkUserLogin($item->item_slug);
                                       if($login['response']===true){
                                        $update_step=$reaction->update(['validation_payload'=> 1,'validation_datasource'=>$login['source']]);
                                       }else{
                                       $update_step=$reaction->update(['validation_payload'=> 0,'validation_datasource'=>$login['source']]);
                                       }
                               }
                           }
                           $item=null;
                       }
                   }
                   if($update_step==true){
                       $steps=$conver->steps();
                   }
                   $template.=$this->user_selection;
                   $template.=view('frontend.chatbot.templates.steps',compact('steps','item'))->render();
                    $bot=BOT::generateLog($template,$conver->id);
               }
               $response['data']=$conversations;
               $response['template']=$template;
               $response['slug']=$item;
               $response['session_slug']=$login;
               $response['bot']=$bot;
               $response['step']=$steps;
                return  $response;
    }

    public function dataReplyConversation($conversations,$display=null,$request,$items=null){
              $data="";
             $template="";
             $response=[];
             $steps="";
            $update_step=false;
            $bot=null;
            $categories_array=null;
            $diplay=null;
          foreach($conversations as $conver){
                   $conver->steps=$conver->steps();
                   $steps=$conver->steps;
                   $template="";
                   if($display->template_type=="lists"){
                       if($display->datasource['model']=='Country'){
                           if($display->datasource['query_parameter']=='all'){
                               $countries=Country::get();
                                $items=$countries;
                               $template.=$this->user_selection;
                               $template.=view('frontend.chatbot.templates.country_lists',compact('steps','countries'))->render();
                                $bot=BOT::generateLog($template,$conver->id);
                           }
                       }
                       if($display->datasource['model']=='Category'){
                           $categories=Category::get();
                           $items=$categories;
                           $template.=$this->user_selection;
                           $template.=view('frontend.chatbot.templates.category_list',compact('steps','categories'))->render();
                            $bot=BOT::generateLog($template,$conver->id);
                       }
                   }
                   if($display->template_type=='map'){
                         $items=Item::with('country')->where('item_slug',$request->source)->where('item_status','2')->first();
                         $template.=$this->user_selection;
                        $template.=view('frontend.chatbot.templates.googlemap',compact('steps','items'))->render();
                        $bot=BOT::generateLog($template,$conver->id);
                   }
                  if($display->template_type=="crousel"){
                      if($display->datasource['model']=='Item'){
                          if($display->datasource['query_parameter']=='list_by_country'){
                              $country=Country::where('country_slug',$request->source)->first();
                                $items=Item::with('country')->where('country_id',$country->id)->where('item_status','2')->where('item_featured','0')->get();
                                  foreach($steps as $step){
                                        if(!$items->first()){
                                      $reaction=Reaction::where('id',$step['reaction_id'])->first();
                                      $update_step=$reaction->update(['validation_payload'=>1,'validation_datasource'=>$country->country_name]);
                                  }
                                  else{
                                       $reaction=Reaction::where('id',$step['reaction_id'])->first();

                                     $update_step=$reaction->update(['validation_payload'=>0,'validation_datasource'=>$country->country_name]);
                                  }

                              }
                              if($update_step==true){
                                  $steps=$conver->steps();
                                 $template.=$this->user_selection;
                                 $unid=uniqid();
                              $template.=view('frontend.chatbot.templates.item_lists',compact('steps','items','unid'));
                              $bot=BOT::generateLog($template,$conver->id);
                              }

                          }
                          if($display->datasource['query_parameter']=='list_of_category'){
                            $categories_array=explode(',',$request->source);
                            $categories_array=array_filter($categories_array);
                            $items=new Collection();
                            foreach($categories_array as $category){
                                $category=''.$category;
                              $items_list=Item::where('item_categories_string','like','%'.$category.'%')->get();
                              foreach($items_list as $item){
                                $items->push($item);
                              }

                            }
                            foreach($steps as $step){
                                if($items->isNotEmpty()){
                                  $reaction=Reaction::where('id',$step['reaction_id'])->first();
                                     $update_step=$reaction->update(['validation_payload'=>0,'validation_datasource'=>str_ireplace(',',', ',$request->source)]);
                                }else{
                                      $reaction=Reaction::where('id',$step['reaction_id'])->first();
                                     $update_step=$reaction->update(['validation_payload'=>1,'validation_datasource'=>str_ireplace(',',', ',$request->source)]);

                                }
                            }
                              $steps=$conver->steps();
                                 $template.=$this->user_selection;
                                 $unid=uniqid();
                              $template.=view('frontend.chatbot.templates.item_lists',compact('steps','items','unid'));
                              $bot=BOT::generateLog($template,$conver->id);
                        }
                        if($display->datasource['query_parameter']=='trigger_item'){
                            foreach($steps as $step){
                                if($items->isNotEmpty()){
                                  $reaction=Reaction::where('id',$step['reaction_id'])->first();
                                     $update_step=$reaction->update(['validation_payload'=>0,'validation_datasource'=>$request->source]);
                                }
                            }
                              $steps=$conver->steps();
                              $template.=$this->user_selection;
                              $unid=uniqid();
                              $template.=view('frontend.chatbot.templates.item_lists',compact('steps','items','unid'));
                              $bot=BOT::generateLog($template,$conver->id);
                        }
                         if($display->datasource['query_parameter']=='advance_search_item'){
                            foreach($steps as $step){
                                 if($items->isNotEmpty()){
                                  $reaction=Reaction::where('id',$step['reaction_id'])->first();
                                     $update_step=$reaction->update(['validation_payload'=>0,'validation_datasource'=>str_ireplace(',',', ',$request->source)]);
                                }else{
                                      $reaction=Reaction::where('id',$step['reaction_id'])->first();
                                     $update_step=$reaction->update(['validation_payload'=>1,'validation_datasource'=>str_ireplace(',',', ',$request->source)]);

                                }
                            }

                              $steps=$conver->steps();
                              $template.=$this->user_selection;
                              $unid=uniqid();
                              $template.=view('frontend.chatbot.templates.item_lists',compact('steps','items','unid'));
                              $bot=BOT::generateLog($template,$conver->id);
                        }
                      }
                  }
                  if($display->template_type=="contact_card"){
                      if($display->datasource['model']=="Item"){
                          if($display->datasource['query_parameter']=='contact_card'){
                              $items=Item::with('country')->where('item_slug',$request->source)->where('item_status','2')->first();
                              $template.=$this->user_selection;
                              $template.=view('frontend.chatbot.templates.contact_card',compact('steps','items'));
                              $bot=BOT::generateLog($template,$conver->id);
                          }
                      }
                  }
               }
               $response['data']=$items;
               $response['step']=$steps;
               $response['template']=$template;
               $response['bot']=$bot;
                return  $response;
    }


    public function fetchTriggerConversation(Request $request){
        $conversations=null;
        $template="";
        $message="";
        if($request->trigger=="restart"){
           $template=Bot::restartConversation();
             return response()->json([
                'code'=>'200',
                'message'=>'Conversation Fetched successfully',
                'template'=>$template,
                ]);
        }else{
            try{
            $trigger = new Trigger();
            $response=$trigger->checkConversation($request->trigger);
             //return  $response;
            if(empty($response['conversation_id'])){
                $msg=$this->optimize;
                throw new Exception($msg);
            }
            $items=null;
            $conversations=ConversationFlow::where('id', $response['conversation_id'])->get();
            if(!$conversations->first()){
                  $msg=$this->optimize;
                throw new Exception($msg);
            }
             foreach($conversations as $convo){
                    $steps=$convo->steps();
                    if($steps){
                        foreach($steps as $step){
                                 if($step['displays']['template_type']=='lists'){
                                      $display=Display::where('id',$step['displays']['id'])->first();
                                    $request->source=$response['source'];
                                    $conversations=$this->dataReplyConversation($conversations,$display,$request);
                                 }


                                 if($step['displays']['template_type']=='crousel'){
                                    $display=Display::where('id',$step['displays']['id'])->first();
                                    $request->source=$response['source'];
                                    if(isset($response['items'])){
                                       $items=$response['items'];
                                    }
                                    $conversations=$this->dataReplyConversation($conversations,$display,$request,$items);
                                 }

                        }
                    }
                }
                //return $conversations;
                 return response()->json([
                'code'=>'200',
                'message'=>'Conversation Fetched successfully',
                'data'=>$conversations['data'],
                'template'=>$conversations['template'],
                'res'=>$conversations
                ]);
            }catch(Exception $ex){
                return response()->json([
                'code'=>'500',
                'message'=>'Either Search confidance below  80% or Coversation not found',
                'data'=>$ex->getTrace(),
                'template'=>$ex->getMessage(),
                'res'=>$conversations
                ]);
            }

        }
    }

    public function fetchConversationLogs(){
        $bot_cookie=Cookie::get('bot_cookie');
        $logs=null;
        $added=null;
        $item=Session::get('item_slug');
        if($bot_cookie){
           $logs=BotLog::where('log_cookie',$bot_cookie)->get();
        }
        return response()->json([
             'code'=>'200',
             'message'=>'log fetched successfully',
             'cookie'=>$bot_cookie,
             'logs'=>$logs,
             'added'=>$added
            ])->withCookie('bot_cookie',$bot_cookie,time()+60*60*24);
    }
    public function checkUserLogin($item_slug=null){
        if($item_slug==null){
          $item_slug=Session::get('item_slug');
        }
        $login=[];
        $login['response']=false;
        $login['source']=1;
        $login['item_slug']= $item_slug;
        if($item_slug){
            $item=Item::where('item_slug',$item_slug)->first();
            $user=User::where('id',$item->user_id)->first();
            $login['source']=$user->id;
            if($user->logged_in==1){
                $login['response']=true;
            }
        }
         return $login;
    }

    public function botInquries(Request $request){
        try{
            $item_slug=Session::get('item_slug');
            $event_slug=Session::get('event_slug');
            $user_id=null;
            $item_id=null;
            $event_id=null;
            $template=null;
            if(!Auth::check() && !Auth::guard('customer')->check()){
               throw new Exception('Authentication Failed');
            }
            if(!$item_slug){
                if(!$event_slug){
                   throw new Exception('Item Slug or Event Slug - Session Null');
                }
            }
            $bot_qurie=new BotInquiry();
            if($item_slug){
               $item=Item::where('item_slug',$item_slug)->first();
            if(!$item){
              throw new Exception('Item Slug but - Item Not Found');
            }
            if($item->user_id!=$request->recipient_id){
                throw new Exception('Item but - recipient id mismatch');
            }
            $item_id=$item->id;
            $bot_qurie->item_id=$item_id;
            }
            if($event_slug){
                  $event=Event::where('event_slug',$event_slug)->first();
            if(!$event){
              throw new Exception('Event Slug but - Event Not Found');
            }
            if($event->user_id!=$request->recipient_id){
                throw new Exception('Event but - recipient id mismatch');
            }
            $event_id=$event->id;
            $bot_qurie->event_id=$event_id;
            }

            if(Auth::check()){
                $user_id=Auth::user()->id;
                $bot_qurie->user_id=$user_id;
            }
            if(Auth::guard('customer')->check()){
                $user_id=Auth::guard('customer')->user()->id;
                $bot_qurie->customer_id=$user_id;
            }
            $bot_qurie->subject=$request->subject;
            $bot_qurie->message=$request->message;
            $bot_qurie->recipient_id=$request->recipient_id;
            $bot_qurie->save();
            if(Auth::check()){
                 $res=$this->businessUserQuery($bot_qurie);
                 if($res['data']==null){
                     throw new Exception('Thread Error'.$res['message']);
                 }
            }
            $entity=Entity::where('title','leave_message')->first();
            $step=Step::where('entity_id',$entity->id)->first();
            if($step){
             $conversations=ConversationFlow::whereJsonContains('steps',$step->id)->get();
              foreach( $conversations as $convo){
                  $convo->steps=$convo->steps();
                  $steps=$convo->steps();
                  $this->user_selection=str_ireplace('*',$request->btn_text,$this->user_selection);
                  $template.=$this->user_selection;
                   $template=view('frontend.chatbot.templates.message',compact('item','steps','bot_qurie'))->render();
                   BOT::generateLog($template,$convo->id);
              }
            }

              return response()->json([
                'code'=>'200',
                'message'=>'Message Sent Successfully',
                'template'=>$template
                ]);

        }catch(Exception $ex){
            return response()->json([
                'code'=>'500',
                'message'=>'Server Error',
                'trace'=>$ex->getTrace(),
                'error_message'=>$ex->getMessage()
                ]);
        }
    }


    public function businessUserQuery($bot_qurie){
        $response=[];
        try{
             $thread=Thread::create([
            'subject'=>$bot_qurie->subject
            ]);
          $message=Message::create([
                'thread_id'=>$thread->id,
                'user_id'=>$bot_qurie->user_id,
                'body'=>$bot_qurie->message,
                ]);
                Participant::create([
                    'thread_id'=>$thread->id,
                    'user_id'=>$bot_qurie->user_id,
                    'last_read'=>Carbon::now()
                ]);
        $thread->addParticipant($bot_qurie->recipient_id);
        if($bot_qurie->item_id){
            $item_id=$bot_qurie->item_id;
        }
         if($bot_qurie->event_id){
            $item_id=$bot_qurie->event_id;
        }
        //Thread Item is only reference for Item Table.Must Refrence to event.
         ThreadItem::create([
            'thread_id' =>$thread->id,
            'item_id' =>$item_id,
        ]);
        $response['message']='saved';
        $response['data']=$thread->id;
        return $response;
        }catch(Exception $ex){
               $response['message']=__LINE__.$ex->getMessage();
              $response['data']=null;
              return $response;
        }
    }

    public function downloadContactCard(Request $request){
        $items=Item::where('item_slug',$request->item_slug)->first();
       // return view('frontend.pages.contactcard',compact('items'));
    }

    public function advanceSearch(Request $request){
        if($request->ajax()){
            $result=null;
            try{
               if($request->srch_from=='advn_bussiness'){
                   $result=Item::where('item_status','2')->where('item_title','like',$request->trigger_text.'%')->get();
               }
                if($request->srch_from=='advn_category'){
                    $result=Category::where('category_name','like',$request->trigger_text.'%')->get();
               }
                if($request->srch_from=='advn_country'){
                    $result=Country::where('country_name','like',$request->trigger_text.'%')->get();
               }
                if($request->srch_from=='advn_state'){
                    $result=State::with('country')->where('state_name','like',$request->trigger_text.'%')->get();
               }
               if($request->srch_from=='advn_city'){
                   $result=City::with('state')->where('city_name','like',$request->trigger_text.'%')->get();
               }
               return response()->json([
                   'code'=>'200',
                   'message'=>'list fetched',
                   'data'=>$result,
                   'req'=>$request->srch_from,
                   ]);
            }catch(Exception $ex){
                  return response()->json([
                   'code'=>'500',
                   'message'=>'Exceptuion occured',
                   'data'=>$ex->getTrace(),
                   'message'=>$ex->getMessage()
                   ]);
            }
        }
    }

    public function advanceSearchItemFetch(Request $request){
        if($request->ajax()){
            $conversations=null;
            $sources=null;
            $items=new Collection();
            try{
            if($request->srch_type=='advn_bussiness'){
                $items=Item::whereIn('id',$request->ids)->get();
                $item_names=Item::whereIn('id',$request->ids)->pluck('item_title');
                $sources=implode(',',$item_names->toArray());
                // print_r($sources);
            }
            if($request->srch_type=='advn_category'){
               $categories=Category::whereIn('id',$request->ids)->get();
               $catgeory_names=Category::whereIn('id',$request->ids)->pluck('category_name');
               $sources=implode(',',$catgeory_names->toArray());
               foreach( $categories as $category){
                   $category_name=''.$category->category_name;
                  $cat_item=Item::where('item_categories_string','like','%'.$category_name.'%')->get();
                  foreach($cat_item as $item){
                      $items->push($item);
                  }
               }
            }
            if($request->srch_type=='advn_country'){
              $contries=Country::whereIn('id',$request->ids)->pluck('id');
              $country_names=Country::whereIn('id',$request->ids)->pluck('country_name');
              $sources=implode(',',$country_names->toArray());
              $items=Item::whereIn('country_id',$contries->toArray())->get();
             }
            if($request->srch_type=='advn_state'){
              $states=State::with('country')->whereIn('id',$request->ids)->pluck('id');
              $state_names=State::whereIn('id',$request->ids)->pluck('state_name');
              $sources=implode(',',$state_names->toArray());
              $items=Item::whereIn('state_id',$states->toArray())->get();
            }
            if($request->srch_type=='advn_city'){
              $cities=City::with('state')->whereIn('id',$request->ids)->pluck('id');
              $city_name=City::with('state')->whereIn('id',$request->ids)->pluck('city_name');
              $sources=implode(',',$city_name->toArray());
              $items=Item::whereIn('city_id',$cities->toArray())->get();
             }
             $conversations=ConversationFlow::where('id',23)->get();
                foreach($conversations as $convo){
                    $steps=$convo->steps();
                    if($steps){
                        foreach($steps as $step){
                                 if($step['displays']['template_type']=='crousel'){
                                    $display=Display::where('id',$step['displays']['id'])->first();
                                    $request->source=$sources;
                                    $conversations=$this->dataReplyConversation($conversations,$display,$request,$items);
                                 }
                        }
                    }
                }
                // return $conversations;
                 return response()->json([
                'code'=>'200',
                'message'=>'Conversation Fetched successfully',
                'data'=>$conversations['data'],
                'template'=>$conversations['template'],
                'res'=>$conversations
                ]);
            }catch(Exception $ex){
                return response()->json([
                'code'=>'500',
                'message'=>'Either Search confidance below  80% or Coversation not found',
                'data'=>$ex->getTrace(),
                'template'=>$ex->getMessage(),
                'res'=>$conversations
                ]);
            }

        }

    }


}




?>
