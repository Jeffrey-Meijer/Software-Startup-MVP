<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Vakantiebestemmingen</title>
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #2D2D2D;
            color: white;
            font-family: Arial, sans-serif;
            height: 100%;
            margin: 0;
        }

        p {
            color: white;
        }

        .logo {
            height: 50px;
            width: auto;
        }

        select {
            background-color: #2D2D2D;
        }

        .topbar {
            background-color: #333;
            padding: 10px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
        }

        .topbar h1 {
            color: white;
            font-size: 1.5rem;
            margin: 0;
        }

        .start-button {
            padding: 15px 30px;
            font-size: 1.5rem;
            background-color: #1E90FF;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .start-button:hover {
            background-color: #4682B4;
        }

        /* Landing Page */
        .landing-page {
            display: flex;
            height: 100vh;
            text-align: center;
            align-items: center;
            align-items: center;
        }

        .left-content {
            width:50%;
            padding: 20px;
        }

        .right-content {
            display: flex;
            width:50%;
            padding: 20px;
            justify-content: center;
        }

        .right-content p {
            width:50%;
        }

        .landing-page h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        /* Container voor de inhoud */
        .container {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row-reverse;
            align-items: flex-start;
            gap: 20px;
            padding-top: 80px;
            padding-bottom: 20px;
            max-width:100%;
            width:100%;
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 100px;
        }

        /* Filters en rad container responsief maken */
        aside {
            flex: 1 1 300px;
        }

        .wheel-container {
            flex: 2 1 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .popup {
            max-width: 90%;
            width: 600px;
            background-color: rgb(35, 35, 35);
            padding: 20px;
            border-radius: 10px;
            color: white;
        }

        .spinner-btn {
            width: 100%;
        }

        /* Zorg voor een goede visuele afstemming */
        .popup img {
            object-fit: cover;
        }

        /* Scroll naar beneden effect voor de knop */
        .scroll-container {
            display: none;
        }

        .dark-background {
            background-color: rgba(35, 35, 35);
        }

        .transparent-backgroud {
            background-color: rgba(35, 35, 35, 0.69);
        }
    </style>
</head>

<body>
    <!-- Topbar toevoegen -->
    <div class="topbar">
        <img class="logo" src="{{ asset('logo_low_res.png') }}" alt="TravelSpinner" width="30">
    </div>

    <!-- Landing page -->
    <div class="landing-page" id="landingPage">
        <div class="left-content">
            <h2 id="welcome-text">Welkom bij <strong>TravelSpinner</strong>!</h2>
            <button class="start-button" id="startButton">Draai het rad</button>
        </div>
        <div class="right-content">
            <p>TravelSpinner is een hulpmiddel waarmee je jouw vakantiebestemming kunt kiezen door aan een rad te draaien. Klik op de knop om te beginnen!<br><br>
            Ben je het zat om uren op zoek te zijn naar de perfecte vakantie? Laat ons je helpen! Draai aan ons rad en ontdek verrassende reisbestemmingen die je misschien niet had overwogen. Geen gedoe, gewoon plezier!<br><br>
            Of je nu droomt van stranden, bruisende steden, of adembenemende natuur, TravelSpinner maakt van het kiezen iets leuks!</p>
        </div>
    </div>

    <!-- Container voor de inhoud (aanvankelijk verborgen) -->
    <div class="container w-full" id="appContainer">
        <!-- Filters -->
        <aside class="w-full sm:w-1/4 dark-background p-6 shadow-md rounded-lg">
            <h1 class="text-xl font-bold mb-4">Vakantiebestemmingen Filters</h1>

            <form method="GET" action="{{ route('home') }}">
                @csrf

                <!-- Pricefilter -->
                <div class="mb-4">
                    <label for="priceCategory" class="block font-medium text-white"><strong>Prijs</strong></label>
                    <select id="priceCategory" name="priceCategory" class="w-full border-gray-300 rounded-md">
                        <option value="">Alle</option>
                        @foreach ($priceCategories as $priceCategory)
                        <option value="{{ $priceCategory }}" @if (request()->input('priceCategory') == $priceCategory) selected @endif>{{ $priceCategory }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Continentfilter -->
                <div class="mb-4">
                    <label for="continent" class="block font-medium text-white"><strong>Continent</strong></label>
                    <select id="continent" name="continent" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Kies een continent --</option>
                        @foreach ($continents as $continent)
                        <option value="{{ $continent }}" @if (request()->input('continent') == $continent) selected @endif>{{ $continent }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Klimaatfilter -->
                <div class="mb-4">
                    <label for="climate" class="block font-medium text-white"><strong>Klimaat</strong></label>
                    <select id="climate" name="climate" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Kies een klimaat --</option>
                        @foreach ($climates as $climate)
                        <option value="{{ $climate }}" @if (request()->input('climate') == $climate) selected @endif>{{ $climate }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter knop -->
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md w-full">Filter toepassen</button>
                <a href="{{ route('home') }}" class="inline-block mt-4 bg-gray-500 text-white py-2 px-4 rounded-md w-full">Reset Filters</a>
            </form>
        </aside>

        <!-- Vakantiebestemmingen en Rad -->
        <div class="wheel-container w-full sm:w-3/4 dark-background p-6 shadow-md rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Vakantiebestemmingen</h2>
            <div id="wheelContainer">
                <canvas id="wheelCanvas" width="500" height="500"></canvas>
                <div id="marker"></div>
            </div>
            <button id="spinButton" class="bg-blue-500 text-white py-2 px-4 rounded-md mt-4 spinner-btn">Draai het rad</button>
        </div>
    </div>

    <!-- Popup voor vakantiebestemming details -->
    <div id="vacationPopup" class="fixed inset-0 transparent-backgroud flex justify-center items-center hidden z-10">
        <div id="vacationPopupBackground" class="p-6 rounded-lg shadow-lg w-full max-w-lg popup">
            <button id="closePopup" class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded">X</button>
            <img id="vacationImage" src="" alt="Bestemming foto" class="w-full h-64 object-cover rounded-lg mb-4">
            <h1 id="vacationName" class="text-2xl font-bold mb-2"></h1>
            <p id="vacationDescription" class="text-white-700 mb-4"></p>
            <p id="vacationPrice" class="text-lg font-semibold text-blue-500"></p>
            <div id="travelAgencies"></div>
        </div>
    </div>

    <script>
        // Sla de scrollpositie op wanneer het formulier wordt ingediend
        $("form").on("submit", function () {
            localStorage.setItem("scrollPosition", window.scrollY);
        });

        // Herstel de scrollpositie na het laden van de pagina
        $(document).ready(function () {
            const scrollPosition = localStorage.getItem("scrollPosition");

            if (scrollPosition) {
                window.scrollTo(0, scrollPosition);
                localStorage.removeItem("scrollPosition");
            }
        });

        // Start de app wanneer de startknop wordt geklikt en scroll naar beneden
        document.getElementById("startButton").addEventListener("click", function() {
            document.getElementById("appContainer").scrollIntoView({ behavior: "smooth" });
        });

        // Gebruik de bestaande wheelData voor het rad
        const wheelData = @json($wheelData);

        // Canvas setup
        const canvas = document.getElementById("wheelCanvas");
        const ctx = canvas.getContext("2d");
        const size = canvas.width / 2;
        const radius = size;
        const center = {
            x: size,
            y: size
        };
        const segmentAngle = (2 * Math.PI) / wheelData.length;
        let rotation = 0;
        let spinning = false;

        function drawWheel() {
            for (let i = 0; i < wheelData.length; i++) {
                const angle = i * segmentAngle;
                ctx.fillStyle = i % 2 === 0 ? "#444" : "#555";
                ctx.beginPath();
                ctx.moveTo(center.x, center.y);
                ctx.arc(center.x, center.y, radius, angle, angle + segmentAngle);
                ctx.closePath();
                ctx.fill();

                ctx.save();
                ctx.translate(center.x, center.y);
                ctx.rotate(angle + segmentAngle / 2);
                ctx.textAlign = "right";
                ctx.fillStyle = "#FFF";
                ctx.font = "16px Arial";
                ctx.fillText(wheelData[i], radius - 10, 5);
                ctx.restore();
            }
        }

        function spinWheel() {
            if (spinning) return;
            spinning = true;

            const totalRotation = (Math.random() * 5 + 5) * 360;
            const finalRotation = totalRotation % 360;
            const duration = 5000;
            const startTime = Date.now();

            function animate() {
                const elapsedTime = Date.now() - startTime;
                const progress = Math.min(elapsedTime / duration, 1);
                const easing = 1 - Math.pow(1 - progress, 3);
                const currentRotation = easing * totalRotation;

                rotation = currentRotation;
                draw();

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    determineResult(finalRotation);
                    spinning = false;
                }
            }

            animate();
        }

        function determineResult(finalRotation) {
            const adjustedRotation = (360 - (finalRotation % 360)) % 360;
            const segmentIndex = Math.floor(adjustedRotation / (360 / wheelData.length));
            $.ajax({
                type: 'POST',
                url: "{{route('destination.detail')}}",
                data: {
                    vakantie: wheelData[segmentIndex]
                },
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(data) {
                    createDetail(data);
                }
            });
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.save();
            ctx.translate(center.x, center.y);
            ctx.rotate((rotation * Math.PI) / 180);
            ctx.translate(-center.x, -center.y);
            drawWheel();
            ctx.restore();
        }

        function createDetail(data) {
            $destination = data[0];
            $travelAgencies = data[1];
            document.getElementById("vacationImage").src = $destination.image ?? "https://www.thetravelteam.com/wp-content/uploads/2018/08/venice.jpg";
            document.getElementById("vacationName").textContent = $destination.name;
            document.getElementById("vacationDescription").textContent = $destination.description;
            if ($travelAgencies == null) {
                document.getElementById("travelAgencies").innerHTML = "<p>Geen reisbureaus gevonden</p>";
            } else {
                let travelAgenciesHtml = "<h2>Reisbureaus</h2>";
                travelAgenciesHtml += "<div class='travelAgencies'>";
                for (const travelAgency of $travelAgencies) {
                    if (travelAgency.travel_agency != null) {
                        travelAgenciesHtml += `<div class="travelAgency-card"><a href="#">${travelAgency.travel_agency.name} - €${travelAgency.price}</a></div>`;
                    }
                }
                travelAgenciesHtml += "</div>";
                document.getElementById("travelAgencies").innerHTML = travelAgenciesHtml;
            }
            document.getElementById("vacationPopup").classList.remove("hidden");
        }

        document.getElementById("closePopup").addEventListener("click", () => {
            document.getElementById("vacationPopup").classList.add("hidden");
        });

        draw();

        document.getElementById("spinButton").addEventListener("click", spinWheel);
    </script>
</body>

</html>
