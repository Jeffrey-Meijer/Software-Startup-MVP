<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Spinner</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #000;
            color: #fff;
            padding: 1rem;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .header .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 1rem;
            margin: 0;
            padding: 0;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 1rem;
        }

        .user-menu {
            font-size: 1rem;
        }

        .hero {
            position: relative;
            height: 100vh;
            background-image: url('/path/to/your/background-image.jpg');
            background-size: cover;
            background-position: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            color: #fff;
            text-align: center;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin: 0;
        }

        .hero-content .button {
            display: inline-block;
            margin: 1rem 0;
            padding: 1rem 2rem;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.25rem;
        }

        .hero-content .button:hover {
            background-color: #0056b3;
        }

        .description {
            font-size: 1rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">Travel Spinner</div>
            <nav class="navbar">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Rad</a></li>
                    <li><a href="#">Instellingen</a></li>
                    <li><a href="#">Overige pagina etc.</a></li>
                </ul>
            </nav>
            <div class="user-menu">Xander ▼</div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Waar ga jij op reis?</h1>
            <a href="#" class="button">Draai het rad →</a>
            <p class="description">TravelSpinner helpt jou met het uitzoeken van je volgende avontuur!<br>
            Ben je het zat om urenlang op zoek te zijn naar de perfecte vakantiebestemming? Laat ons je helpen! Draai aan ons magische rad en ontdek verrassende en opwindende reisbestemmingen die je misschien niet had overwogen. Geen gedoe, geen stress – gewoon plezier!<br><br>
            Of je nu droomt van witte zandstranden, bruisende steden of adembenemende natuur, TravelSpinner maakt van het kiezen een avontuur op zich. Laat je verrassen door nieuwe plekken en laat je inspireren om buiten je comfortzone te stappen. Het enige wat jij hoeft te doen, is draaien – de wereld ligt aan je voeten!</p>
        </div>
    </section>
</body>
</html>
