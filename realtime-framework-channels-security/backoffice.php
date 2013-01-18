<?php
    error_reporting(E_ALL);
    include 'ortc.php';

    $url = 'http://ortc-developers.realtime.co/server/2.1'; // ORTC server URL
    $app_key = "7njaQf"; // Application key
    $app_key = "YOUR_OWN_APPLICATION_KEY"; // Application key * IMPORTANT: EDIT THIS * If you don't have an application key, get it (for free) at www.realtime.co
    $private_key = "YOUR_OWN_PRIVATE_KEY"; // Private key * IMPORTANT: EDIT THIS *

    $xrtml = new xRTML( $url, $app_key, $private_key, $auth_token ); // Intantiates a new xrtml object
    $result = $xrtml->auth( Array( 'myChannel' => 'w' ) ); // Authorizes us to work with channels
?>

<!doctype html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>Backoffice (kinda)</h1>
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