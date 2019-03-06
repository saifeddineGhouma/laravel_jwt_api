<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="css/style.css" rel="stylesheet" id="bootstrap-css">

<!DOCTYPE html>
<html>
<body>
<div class="col-sm-3 col-sm-offset-4 frame"style="margin-top: 50px">
    <ul></ul>

    <div class="chat-box">
        @foreach($chats as $chat)
            <div class="alert alert-info">{{$chat->message}}</div>

            @endforeach

    </div>

    <div>
        <div class="msj-rta macro">
            <div class="text text-r" style="background:whitesmoke !important">
                <input class="mytext" placeholder="Type a message" name="msg"/>
            </div>

        </div>
        <div style="padding:10px;">
            <span class="glyphicon glyphicon-share-alt"></span>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.mytext').keyup(function (e) {
            var value = $( this ).val();
            if(!value=='' && e.keyCode==13 && !e.shiftKey)
            {

              //  $( ".chat-box" ).append('<div class="alert alert-info">'+value+'</div>' );
                $.ajax({
                    url:'{{url("chat/store")}}',
                    type:'post',
                    data:{
                        _token:'{{csrf_token()}}',
                        msg:value,
                    }


                });
                $('.mytext').val('');
            }

        })

    })
    $(function(){
        //live_chat();
    });
    function live_chat()
    {
        $.ajax({
            url:'{{url("chat/ajax")}}',
            type:'get',
            data:{ _token:'{{csrf_token()}}'},
            success:function(data){
                $( ".chat-box" ).append('<div class="alert alert-info">'+data['message']+'</div>' );
                setTimeout(live_chat,1000)
            },
            error:function () {
                setTimeout(live_chat,3000)
            }
        });
    }

</script>
</body>
</html>
