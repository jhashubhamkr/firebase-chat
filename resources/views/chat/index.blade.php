@extends('layouts.app')

@section('stylesheet')

<style>
    *{
        box-sizing: border-box;
    }
    .parent{
        width: 100%;
        height: auto;
        /*background: green;*/
        position: relative;
        display: table;
    }
    .child-1{
        padding: 7px 15px;
        border-radius: 15px;
        margin-top: 10px;
        background: #ffc123;
        display: inline-block;
        float: right;
        max-width: 300px;
        display: table-row; 
        color: #fff;
    }
    .child-2{
        padding: 7px 15px;
        border-radius: 15px;
        margin-top: 10px;
        background: #ddd;
        float: left;
        display: inline-block;
        max-width: 300px;
        display: table-row;
    }
    .chat-with{
        display: block;
        width: 100%;
        padding: 10px;
        border-radius: 50px;
        cursor: pointer;
        margin-bottom: 5px;
        transition: all 0.25s ease-in-out;
    }
    .chat-with:hover{
        background: #ddd;
    }
    .chat-with-active{
        background: #ddd;
    }
    #chatBox{
    }
    .message-form{
        height: 55px;
        width: 62%;
        margin-left: 35%;
        /*background-color: brown;*/
        border-radius: 10px;    
        position: absolute;
        z-index: 999;
        bottom: 0;
    }
    .chat-message{
        width: 100%;
        font-size: 18px;
        border: 1px solid #ccc;
        border-radius: 50px;
        padding:5px 15px;
        outline: none;
        box-shadow: 5px 5px 20px rgba(0,0,0,0.25);
    }
    .chat-message-button{
        width: 100%;
        font-size: 18px;
        border: none;
        background-color: #ffc123;
        border-radius:50px;
        padding:5px 15px;
        outline: none;   
        color: white;
        font-weight: bolder;
        cursor: pointer;
        box-shadow: 5px 5px 20px rgba(0,0,0,0.25);
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat Box</div>

                <div class="card-body" >
                    <div class="row" style="height: 500px;position: relative;">
                        <div class="col-sm-4" style="overflow: auto;height: 100%;border-right: 1px solid #ccc">
                            <?php
                                
                            ?>
                            @foreach ($users as $user)
                            @if(Auth::user()->id!=$user->id)
                            <span class="chat-with {{ ($user->id==$firstUser->id)?"chat-with-active":"" }}" id="user{{ $user->id }}" onclick="changeUserWith('{{ $user->email }}','user{{ $user->id }}');">{{ $user->name }}</span>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-8" style="overflow: auto;height: 100%" id="chatBox">
                            {{-- chats appear here --}}
                        </div>
                        <div class="message-form">
                            <form onsubmit="return sendMessage();">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Type message..." autocomplete="off" class="chat-message" id="chat-message">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="submit" value="SEND" class="chat-message-button">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section("script")

<script src="https://www.gstatic.com/firebasejs/7.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.10.0/firebase-database.js"></script>
<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<script src="{{ asset('js/firebaseConfig.js') }}"></script>
<script>
    usernames="";
    myName="{{ Auth::user()->email }}";
    curUserId='user'+{{ $firstUser->id }};
    count=0;
       $( document ).ready(function() {
        userWith="{{ $firstUser->email }}";
        if (myName>userWith) {
            usernames=myName+userWith;
        }else{
            usernames=userWith+myName;
        }
        // console.log(usernames);
        var d = $('#chatBox');
        d.scrollTop(d.prop("scrollHeight"));
    });
</script>
<script src="{{ asset('js/main.js') }}"></script>

@endsection