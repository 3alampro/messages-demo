<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>


    <style>
        .content {
            height: 300px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-md-6">
        <div class="content">

            <table class="table">
                <tr>
                    <th>From</th>
                    <th>Message</th>
                </tr>
                @foreach($chats as $chat)
                    <tr>
                        <td>{{ $chat->name }}</td>
                        <td>{{ $chat->message }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <br>
        <br>
        <br>
        <br>
        <form action="{{ url() }}/" method="POST">
            <span class="loading" style="display: none; font-size: 18px;">
                sending ...
            </span>
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="Name:" class="form-control" required>
            <input type="text" name="message" id="message"  placeholder="Your message:" required class="form-control">
            <input type="submit" class="btn btn-primary" value="Send">

        </form>
    </div>
</div>

<script src="https://js.pusher.com/2.2/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
        if (window.console && window.console.log) {
            window.console.log(message);
        }
    };

    var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        encrypted: true
    });

    var channel = pusher.subscribe('new-message');

    channel.bind('App\\Events\\newMessage', function(data) {
        $('.table').append('<tr><td>'+ data.message.name + '</td><td>'+ data.message.message + '</td></tr>')
    });

    $('form').submit(function (e) {
        e.preventDefault();

        $('.loading').show();

        posts = $(this).serializeArray();
        $.post('{{ url() }}/', posts, function () {
            $('#message').val('');
            $('.loading').hide();
        });

        return false;
    });
</script>
</body>
</html>
