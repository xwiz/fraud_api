<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
<body style="width:99%;max-width:500px;min-width:320px;margin:20px auto;font-family:'Quicksand','Trebuchet MS'; color:#000000 ;">
    <div class="wrapper" style="border-bottom:0px">
        <div class="header" style="background:#4267B2; height:154px; padding: 30px 20px 10px 60px; border-bottom: 3px #414D8B solid">
            
            <p style="font-size: 28px; text-transform: uppercase; color: #fff; position: relative; bottom: -30px">FraudKoboko</p>
            <p style="font-size: 12px; color: #fff; position: relative;">Email Verification</p>
        </div>
        <div class="content" style="min-height:30%; min-height: 200px; padding: 50px 60px 20px 60px">
            <div class="details" style="font-size: 16px; color: #5F676C;">
                <span>
                    <p>
                        <b>Dear {{ $name }}</b>,<br /><br />
                    </p>

                    <br>
                    <p>Thanks for creating an account with fraudkoboko Please follow the link below to verify your email address </p>
                    <a href="{{ url('api/v1/register/verify/'. $confirmation_code) }}" style="text-decoration: none"><span style="width: 80%; max-width:180px; margin: 30px 10px 20px 0px; display: block; text-align: center; font-weight: 10; padding: 12px 20px 12px 20px; background: #18AD2F; box-shadow: 0 1px 3px 0 rgba(0,0,0,0.50); border-radius: 3px; color: #fff;">Verify Mail</span></a>
                    <br />
                    <p>
                        <p>
                            <b>Cheerfully Yours,</b>
                            <br />
                            Fraudkoboko
                            <br />
                        </p>
                        <br />
                    </p>
                </span>
            </div>
        </div>
        <div class="footer" style="padding:10px;margin-top:-10px;text-align:center">
            <p style="color:#0e0e0e;margin:0px;margin-top:5px;font-family:Arial;font-size:11px;">       
            </p>
        </div>
        <div style="border-bottom: 3px #40A4E4 solid"></div>
        <div style="border-bottom: 3px #414D8B solid"></div>
    </div>
</body>