<?php
    error_reporting(E_ALL);
    include 'ortc.php';

    $url = 'http://ortc-developers.realtime.co/server/2.1'; // ORTC server URL
    $message1 = "This is message 1 and it's being sent on the server-side"; // message 1 to send
    $message2 = "This is message 2 and it's being sent on the server-side"; // message 2 to send
    $app_key = "YOUR_OWN_APPLICATION_KEY"; // Application key * IMPORTANT: EDIT THIS * If you don't have an application key, get it (for free) at www.realtime.co
    $private_key = "YOUR_OWN_PRIVATE_KEY"; // Private key * IMPORTANT: EDIT THIS *
    $auth_token = "my_auth_token"; // Authentication token

    /*
    $xrtml = new xRTML( $url, $app_key, $private_key, $auth_token ); // Intantiates a new xrtml object
    $result = $xrtml->auth( Array( 'myChannel' => 'w' ) ); // Authorizes us to work with channels
    $result = $xrtml->send('myChannel', $message1, $response); // Sends a message
    */
?>

<!doctype html>
<html>
<head>
    <title></title>
</head>
<body>
    <input type="text" id="message" />
    <input type="button" onclick="sendMessage('myChannel');" value="Send to myChannel" />
    <div id="log"></div>

    <script src="http://code.xrtml.org/xrtml-3.0.0.js"></script>
    <script>
        var appkey = '<?php echo($app_key); ?>',
            url = '<?php echo($url); ?>',
            token = '<?php echo($auth_token); ?>';

        xRTML.ready(function(){

            xRTML.Config.debug = true;

            xRTML.ConnectionManager.create(
            {
                id: 'myConn',
                appkey: appkey,
                authToken: token,
                url: url,
                channels: [
                    {name: 'myChannel'}
                ]
            }).bind(
            {
                message: function(e) {
                    var log = document.getElementById('log');
                    log.innerHTML = log.innerHTML + 'Message received: ' + e.message + '<br />';
                }
            });
        });

        function sendMessage(channel){
            var msg = document.getElementById('message').value;

            xRTML.ConnectionManager.sendMessage({
                connections: ['myConn'],
                channel: channel,
                content: msg
            });
        }
    </script>

</body>
</html>