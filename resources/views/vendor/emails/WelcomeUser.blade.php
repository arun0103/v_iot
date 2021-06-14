
<html>
    <head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Ballet&display=swap" rel="stylesheet">
        <style>
        .content-wrapper{
            margin:0 auto;
            width:500px;
        }
        .content-header{
            background: #87bde6;
        }
        h1{
            font-family: 'Ballet', cursive;
            font-size:43px;
            margin-left:10px;
        }
        </style>
    </head>
    <body>
       <div class="content-wrapper">
            <div class="content-header">

                <h1>Welcome to Voltea IOT</h1>
            </div>
            <div class="content">
                <p>Dear <i>{$data->user_name}</i>,</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are invited to use Voltea IOT for
                    monitoring and controlling the device even you are far away from home.</p>
                <p>Let's begin by logging in!<p>
                <p>Below is the link from where you can access our service</p>
                <p>http://134.122.25.185/</p>
                <p>Your login details</p>
                <p><b>Email</b>: {$data->user_email}}</p>
                <p><b>Password</b>: {$data->user_password}}</p>
                <br>
                <p>Thank You,</p>
                <br>
                <p>{$data->sender_name}}</p>
                <p><b>Voltea IOT</b></p>
            </div>
        </div>
    </body>
</html>




