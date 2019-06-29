<!DOCTYPE html>
<html>
<head>
    <title>Pretech blog testing web sockets</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/js/script_chat.js')}}">


    </script>

    <style type="text/css">

        #holder {
            position: absolute;
            top: 200px;
            left: 100px;
        }

        #dropDiv {
            display: none;
            position: absolute;
            top: -20px;
            background: #ccc;
        }
    </style>
</head>
<body>
<div>
    <input type="text" id="userinput"/> <br> <input type="submit" value="Send Message to Server" onclick="start()"/>
</div>
<div id="messages"></div>
<div id="holder"><a href="javascript:void(0);" id="main">Which ring?</a></div>
<div id="dropDiv">The one ring to rule them all.</div>
<div id="dropDiv">The one ring to rule them all.</div>
</body>
</html>