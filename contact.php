<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Contact Form</title>
    <script src="https://kit.fontawesome.com/fb85e57258.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-container {
            max-width: 500px;
            margin: auto;
            border: 1px solid lightgray;
            padding: 2.3rem 1.5rem;
            border-radius: 5px;
        }

        .button-container {
            display: flex;
            gap: .5rem;
        }

        button {
            flex: 1 0 auto;
        }

        .card {
            max-width: 500px;
            margin: 2rem auto;
            border-width: 2px;
            /*
            padding: 2.3rem 1.5rem;
            */
        }
        .card img {
            border-radius: 50%;
            scale: .6;
            flex-grow: 0;
        }

        .field:not(i) {
            width: 100%;
            height: 3rem;
        }

        .field i {
            padding-right: 2rem;
            width: 10%;
        }

        .field span {
            border-bottom: 1px solid lightgray;
            padding: 0.6rem 0;
            width: 90%;
            display: inline-block;
        }

        .field em {
            color: #aaaaaa;
            font-size: .9rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <img src="https://placehold.co/400x400" class="card-img-top">
            <?php
            // if ($_POST) {
            //     foreach ($_POST as $key => $value) {
            //         echo createItem($key, $value);
            //     }
            // }
            ?>
            <div class="card-body">
                <h5>Card title</h5>
                <div class="button-container mt-4">
                    <button class="btn btn-secondary">Fai qualcosa</button>
                    <button class="btn btn-danger">Cancella</button>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>