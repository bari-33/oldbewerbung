@extends('layouts.app')
@section('css')
    <meta name="csrf-token" content="{{csrf_token()}}" />

    <script src="{{ asset('public/js/app.js') }}" defer></script>
@endsection
@section('content')
<!-- CHAT -->
    <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title mb-3">Chat</h4>
            <div class="chat-conversation">

                <ul class="conversation-list slimscroll" style="max-height: 350px;" id="app">
                    <chat-messages :messages="messages"></chat-messages>
                </ul>

                <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                ></chat-form>

            </div> <!-- .chat-conversation -->
        </div> <!-- end card-box-->
    </div> <!-- end col-->
    @endsection