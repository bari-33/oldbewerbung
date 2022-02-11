@extends('layouts.app')
@section('css')


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    {{-- <style>
        .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
    </style> --}}

@endsection

@section('content')
<link href="/admin/css/chat.css" rel="stylesheet" />
  <section class="col-md-12 ">
               <div class="order-filter" style="">
                  <div class="row">
                     <div class="col-md-6">
                        <h4 class="filter-heading">Nachrichten</h4>
                     </div>
                     <div class="col-md-6">
                        <div class="pull-right">
                           <div class="button-1">
                              <span class="btn-icon">
                              <i class="fa fa-plus"></i>
                              </span>
                              <span class="btn-txt">Jetzt hizufügen</span>
                           </div>
                           <div class="button-1 search-button">
                              <input type="text" name="filter"  placeholder="Suchen" class="filter-search">
                              <span class="btn-icon">
                              <i class="fa fa-search"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div style="clear:both"></div>
                     <div class="col-md-8">
                        <div class="filter-options">
                           <div class="filter-option active" style="
                              ">
                              <span class="txt">Chats </span>
                           </div>
                           <div class="filter-option">
                              <span class="txt">E-mails </span>
                           </div>
                           <div style="clear:both"></div>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="chatsec block-shaded topDark ">
                  <div class="row">
                     <div class="col-md-9 left">

                        <div class="chat active" data-chat="person2">
                            <div class="conv-container ps-active-y">
                               <div class="conversation-start">
                                  <span>Gestern, 21:15 Uhr</span>
                                  <i class="fa fa-cog" style="float: right;font-size: 20px;"></i>
                               </div>
                               <div class="display-inlineblock" >
                                  <div class="chat-message">
                                    <div class="chat-img">
                                      <img src="/admin/img/chat-user.png" alt="">
                                       <p> 21:15</p>
                                    </div>
                                     <div class="bubble you"><h6>John Deo</h6>
                                        Hello!
                                     </div>
                                  </div>
                               </div>
                               <div class="display-inlineblock" >
                                 <div class="chat-message">
                                   <div class="bubble me">
                                      <h6>Leonie Baumann</h6>
                                       <div class="chat-img">
                                      <img src="/admin/img/chat-user1.png" alt="">
                                        <p> 21:15</p>
                                    </div>
                                       <p>
                                        Hi, How are you? What about our next
                                       </p>
                                       <p>
                                        Loreü ipsum Dolor et?
                                       </p>
                                   </div>
                                 </div>
                               </div>
                               <div class="display-inlineblock" >
                                   <div class="chat-message">
                                      <div class="chat-img">
                                      <img src="/admin/img/chat-user.png" alt="">
                                        <p> 21:15</p>
                                    </div>
                                      <div class="bubble you"><h6>John Deo</h6>
                                         Yeah Everything is fine
                                      </div>
                                   </div>
                               </div>
                               <div class="display-inlineblock" >
                                   <div class="chat-message">
                                     <div class="bubble me"><h6>Leonie Baumann</h6>
                                         <div class="chat-img">
                                            <img src="/admin/img/chat-user1.png" alt="">
                                           <p> 21:15</p>
                                        </div>
                                         Wow that's great. Lorem Ipsum Dolar
                                     </div>
                                   </div>
                               </div>

                            </div>
                         </div>

                        <div class="writecont row">
                          <div class="col-md-12">
                            <div class="send-container">
                            <div class="write">
                                <input type="text" placeholder="write message...">
                                <a href="#" class="write-link attach"></a>
                            </div>
                            <div class="msg_send_btn">
                              <a style="color: #fff;" href="javascript:;" class="send">
                                <i class="fa fa-paper-plane-o write-link"></i>
                              </a>
                            </div>
                            <div style="clear:both;"></div>
                            </div>
                          </div>
                        </div>
                      </div>

                     <div class="col-md-3 ">
                       <div class="right">
                        <div class="top">
                           <div class="personal">
                              <div class="content">
                                 <span class="name">Thomas Bangalter</span>
                                 <img src="/admin/img/chat-user1.png" alt="" />
                              </div>
                           </div>
                        </div>

                        <ul class="people">
                           <li class="person" data-chat="person1">
                              <img src="/admin/img/chat-user.png" alt="" />
                              <span class="name">Thomas Bangalter</span>
                              <span class="noti">2</span>
                           </li>
                           <li class="person active" data-chat="person2">
                              <img src="/admin/img/chat-user1.png" alt="" />
                              <span class="name">Dog Woofson</span>
                              <span class="noti">2</span>
                           </li>
                           <li class="person" data-chat="person3">
                              <img src="/admin/img/chat-user.png" alt="" />
                              <span class="name">Louis CK</span>
                           </li>
                           <li class="person" data-chat="person4">
                              <img src="/admin/img/chat-user1.png" alt="" />
                              <span class="name">Bo Jackson</span>
                           </li>
                           <li class="person" data-chat="person5">
                              <img src="/admin/img/chat-user.png" alt="" />
                              <span class="name">Michael Jordan</span>
                           </li>
                           <li class="person" data-chat="person6">
                              <img src="/admin/img/chat-user1.png" alt="" />
                              <span class="name">Drake</span>
                           </li>
                           <li class="person" data-chat="person5">
                              <img src="/admin/img/chat-user.png" alt="" />
                              <span class="name">Michael Jordan</span>
                           </li>
                           <li class="person" data-chat="person6">
                              <img src="/admin/img/chat-user1.png" alt="" />
                              <span class="name">Drake</span>
                           </li>
                           <li class="person" data-chat="person5">
                              <img src="/admin/img/chat-user.png" alt="" />
                              <span class="name">Michael Jordan</span>
                           </li>
                           <li class="person" data-chat="person6">
                              <img src="/admin/img/chat-user1.png" alt="" />
                              <span class="name">Drake</span>
                           </li>
                           <li class="person" data-chat="person5">
                              <img src="/admin/img/chat-user.png" alt="" />
                              <span class="name">Michael Jordan</span>
                           </li>
                           <li class="person" data-chat="person6">
                              <img src="/admin/img/chat-user1.png" alt="" />
                              <span class="name">Drake</span>
                           </li>
                        </ul>
                     </div>
                     </div>
                     </div>
                  </div>
               </div>
            </section>
@endsection
