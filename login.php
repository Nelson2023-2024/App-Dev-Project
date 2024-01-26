<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Login</title>

        <style>
            body{
                display: flex;
                place-items: center;
                height: 100vh;
            }
            form{
                max-width: 400px; 
                padding-block: 1rem;
                padding-inline: .6rem;
                border-radius: 10px;
                box-shadow: 0px 0px 20px black;
            }
            span{
                font-size: 12px;
                color:gray;
            }
            
        </style>
    </head>
    <body>

        <div class="container">

        
            <form class="mx-auto" method="post" action="">
                <h1 class="text-center mb-4">Login</h1>
    
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label"> <strong>Email address</strong></label>
                    <input type="email" class="form-control" id="email" placeholder="wills@gmail.com">
                </div>
    
                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label"><strong>Password</strong></label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                    <span>Never share your password with anybody</span>
                </div>
    
                <!-- Submit Button -->
                
                <button type="submit" class="btn btn-primary">Login</button>

                <p style="font-size: 14px; margin-top: 1rem; text-align: center;">Don't have an account <a href="./registration.php">Register</a></p>

            </form>
    </div>
    </body>
</html>