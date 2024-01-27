<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
    <style>
        body {
            display: flex;
            place-items: center;
            height: 100vh;
        }

        form {
            max-width: 600px;
            padding-block: 1rem;
            padding-inline: .6rem;

        }

        span {
            color: red;
            font-size: 13.5px;
        }

        p {
            font-size: 12.5px;
            margin-bottom: 2px;
            font-weight: bold;
        }

        div .col {
            position: relative;
        }

        i {
            position: absolute;
            right: 5px;
            top: 6px;
            cursor: pointer;
            font-size: 18px;

        }
    </style>
</head>

<body>
    <div class="container">
        <form action="" class="mx-auto" method="post">

            <h1 class="text-center">Add New Client</h1>
            <div class="row g-3 mb-3">
                <!-- first name -->
                <div class="col">
                    <input id="first_name" name="fname" type="text" class="form-control" placeholder="First name" aria-label="First name">
                    <span id="first_error"></span>
                </div>

                <!-- last name -->
                <div class="col">
                    <input id="last_name" name="lname" type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                    <span id="last_error"></span>

                </div>
            </div>

            <!-- email -->
            <div class="col mb-3">
                <input id="email" name="email" type="text" class="form-control" placeholder="Email" aria-label="Email">
                <span id="email_error"></span>

            </div>

            <!-- phone number -->
            <div class="col mb-3">
                <input id="phone" name="phoneNo" type="text" class="form-control" placeholder="Phone number" aria-label="Phone number">
                <span id="phone_error"></span>

            </div>

            <!-- gender -->
            <div class="row mb-3">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male">
                        <label class="form-check-label" for="maleRadio">
                            Male
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female">
                        <label class="form-check-label" for="femaleRadio">
                            Female
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="otherRadio" value="other">
                        <label class="form-check-label" for="otherRadio">
                            others
                        </label>
                    </div>
                </div>
                <span id="gender_error"></span>
            </div>

            <!-- user level -->
            <div class="col mb-3">
                <input id="userlevel" name="user_level" type="number" class="form-control" placeholder="User level" aria-label="Phone number">
                <span id="userlevel_error"></span>
                <p>Note: 0(USER) and 1(ADMIN)</p>

            </div>
            <!-- password1 -->
            <div class="col mb-3">
                <input id="password1" name="pass1" minlength="8" type="password" class="form-control" placeholder="Password" aria-label="Phone number">
                <p>Enter a minimum of 8 characters</p>
                <span id="password1_error"></span>
                <i class="open bi bi-eye-fill" data-target="password1"></i>

            </div>

            <!-- password2 -->
            <div class="col mb-3">
                <input id="confirm_password" name="pass2" type="password" class="form-control" placeholder="Confirm Password" aria-label="Phone number">
                <span id="password2_error"></span>
                <i class="open bi bi-eye-fill" data-target="confirm_password"></i>
            </div>

            <div class="row col">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>

    <script src="./validation.js"></script>
</body>

</html>