<!DOCTYPE html>
<html>
<head>
    <title>Pretech blog testing web sockets</title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script type="text/javascript">
        var webSocket = new WebSocket('ws://68.183.232.177:8686/');

        webSocket.onerror = function(event) {
            onError(event)
        };

        webSocket.onopen = function(event) {
            onOpen(event)
        };

        webSocket.onmessage = function(event) {
            onMessage(event)
        };

        function onMessage(event) {
            //alert(event.data);
            document.getElementById('messages').innerHTML += '<br />'                    + event.data;

            $(function() {
                setTimeout (function() {
                    var $dropDiv = $('#dropDiv');
                    var mythis = $('#holder a');
                    // get position of the element we clicked on
                    var offset = mythis.offset();

                    // get width/height of click element
                    var h = mythis.outerHeight();
                    var w = mythis.outerWidth();

                    // get width/height of drop element
                    var dh = $dropDiv.outerHeight();
                    var dw = $dropDiv.outerWidth();

                    // determine middle position
                    var initLeft = offset.left + ((w/2) - (dw/2));

                    // animate drop
                    $dropDiv.css({
                        left: initLeft,
                        top: $(window).scrollTop() - dh,
                        opacity: 0,
                        display: 'block'
                    }).animate({
                        left: initLeft,
                        top: offset.top - dh,
                        opacity: 1
                    }, 300, 'easeOutBounce');
                },1500);
            });

        }

        function onOpen(event) {
            document.getElementById('messages').innerHTML = 'Now Connection established';
        }

        function onError(event) {
            alert(event.data);
        }

        function start() {
            var text = document.getElementById("userinput").value;

            webSocket.send(text);
            return false;
        }
    </script>

    <script type="text/javascript">



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
        <input type="text" id="userinput" /> <br> <input type="submit"  value="Send Message to Server" onclick="start()" />
    </div>
    <div id="messages"></div>
    <div id="holder"><a href="javascript:void(0);" id="main">Which ring?</a></div>
    <div id="dropDiv">The one ring to rule them all. </div>
    <div id="dropDiv">The one ring to rule them all. </div>
</body>
</html>