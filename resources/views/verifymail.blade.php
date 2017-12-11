<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>
        <div>
            Thanks {{ $name }} for creating an account with fraudkoboko.com.
            Please follow the link below to verify your email address
            <a href="{{ url('api/v1/register/verify/'. $confirmation_code) }}" class="btn btn-primary"> Verify </a>
            
        </div>
    </body>
</html>