@extends('welcome')

@section('content2')

<div class="container">
        <div class="row" style="margin-top:20px">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>
    
                    <div class="panel-body-chat">
                        <chat-messages :messages="messages"></chat-messages>
                           @foreach($message as $c)

                                    <div class="header">
                                        <strong class="primary-font">
                                            {{$c->name  }}
                                        </strong>
                                    </div>
                                    <p>
                                        {{ $c->message }}
                                    </p>
                                    @endforeach
                                   
                    </div> 
                    <div class="panel-footer">
                        <chat-form
                            v-on:messagesent="addMessage"
                            :user="{{ Auth::user() }}"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script src="{{ asset('js/app.js') }}"></script>
