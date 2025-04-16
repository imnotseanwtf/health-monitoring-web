<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bahay ni Maria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<style>
    .button-10 {
        padding: 10px 20px 10px 20px;
        font-family: 'Montserrat', sans-serif;
        border-radius: 6px;
        border: none;

        color: #fff;
        background: linear-gradient(90deg, #5de0e6, #0078a6);
        background-origin: border-box;
        box-shadow: 0px 0.5px 1.5px rgba(54, 122, 246, 0.25), inset 0px 0.8px 0px -0.25px rgba(255, 255, 255, 0.2);
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .header-background {
    position: relative;
    height: 100vh;
    background-image: 
        linear-gradient(90deg, rgba(0, 120, 166, 0.7), rgba(93, 224, 230, 0.7), rgba(0, 120, 166, 0.7)),
        url('{{ asset('images/homepage.jpg') }}');
    background-size: cover;
    background-position: center;
    box-shadow: inset 0px 4px 8px rgba(0, 0, 0, 0.2);
}
</style>

<body>
    <nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, #0078a6, #5de0e6, #0078a6);">
        <div class="container-fluid">
            <a class="navbar-brand mx-5" href="/">
                <h3 class="text-white fw-bold m-5" style="font-family: 'Montserrat', sans-serif;">
                    Bahay ni Maria
                </h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse me-5" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">
                        <h5 class="text-white fw-bold mt-3 me-5" style="font-family: 'Montserrat', sans-serif;">
                            Home
                        </h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('login') }}">
                        <h5 class="text-white fw-bold button-10 mt-1 me-5">
                            Login
                        </h5>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid header-background">
        <div style="position: absolute; bottom: 0; left: 0; margin: 20px; height: 50vh; margin-left: 150px;">
            <h1 class="text-white fw-bold" style="font-family: 'Montserrat', sans-serif; font-size: 80px;">
                BAHAY NI MARIA
            </h1>
            <p class="text-white mx-2" style="font-family: 'Montserrat', sans-serif; font-size: 30px; letter-spacing: 0.05em;">
                HOME FOR THE ABANDONED ELDERLY AND <br> CHILDREN WITH SPECIAL NEEDS
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
