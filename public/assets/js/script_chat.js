var webSocket = null;
createSocket();

function check() {
    if (!webSocket || webSocket.readyState == 3) createSocket();
}

function createSocket() {
    webSocket = new WebSocket('ws://68.183.232.177:8686/');
    webSocket.onerror = function (event) {
        onError(event)
    };
    webSocket.onopen = function (event) {
        onOpen(event)
    };
    webSocket.onmessage = function (event) {
        onMessage(event)
    };
    webSocket.onclose = function (event) {
        check()
    }
}

setInterval(check, 1000);

function onMessage(event) {
    //alert(event.data);
    //document.getElementById('messages').innerHTML += '<br />' + event.data;
    d = JSON.parse(event.data)
    $("#messages").prepend(d.id+":  "+d.message+"<br>");

    $(function () {
        setTimeout(function () {
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
            var initLeft = offset.left + ((w / 2) - (dw / 2));

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
        }, 1500);
    });

}

function onOpen(event) {
    document.getElementById('messages').innerHTML = 'Now Connection established';
}

function onError(event) {
    console.log(event.data);
}

function start() {
    var text = document.getElementById("userinput").value;

    webSocket.send(text);
    return false;
}