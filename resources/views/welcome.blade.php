<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Vakantiebestemmingen</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-6 flex h-screen">
    <div class="flex w-full h-full">
        <!-- Popup for displaying vacation details -->
        <div id="vacationPopup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-10">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                <button id="closePopup" class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded">X</button>
                <img id="vacationImage" src="" alt="Bestemming foto" class="w-full h-64 object-cover rounded-lg mb-4">
                <h1 id="vacationName" class="text-2xl font-bold mb-2"></h1>
                <p id="vacationDescription" class="text-gray-700 mb-4"></p>
                <p id="vacationPrice" class="text-lg font-semibold text-blue-500"></p>
                <div id="travelAgencies"></div>
            </div>
        </div>


        <!-- Filters -->
        <aside class="w-1/4 bg-white p-6 shadow-md rounded-lg mr-4">
            <h1 class="text-xl font-bold mb-4">Vakantiebestemming Filters</h1>

            <form method="GET" action="{{ route('home') }}">
                @csrf

                <!-- Pricefilter -->
                <div class="mb-4">
                    <label for="priceCategory" class="block font-medium">Prijs Categorie</label>
                    <select id="priceCategory" name="priceCategory" class="w-full border-gray-300 rounded-md">
                        <option value="">Alle</option>
                        @foreach ($priceCategories as $priceCategory)
                        <option value="{{ $priceCategory }}" @if (request()->input('priceCategory') == $priceCategory) selected @endif>{{ $priceCategory }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Continentfilter -->
                <div class="mb-4">
                    <label for="continent" class="block font-medium">Continent</label>
                    <select id="continent" name="continent" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Kies een continent --</option>
                        @foreach ($continents as $continent)
                        <option value="{{ $continent }}" @if (request()->input('continent') == $continent) selected @endif>{{ $continent }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Klimaatfilter -->
                <div class="mb-4">
                    <label for="climate" class="block font-medium">Klimaat</label>
                    <select id="climate" name="climate" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Kies een klimaat --</option>
                        @foreach ($climates as $climate)
                        <option value="{{ $climate }}" @if (request()->input('climate') == $climate) selected @endif>{{ $climate }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter knop -->
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Filter toepassen</button>
            </form>
        </aside>

        <!-- Vakantiebestemmingen en Rad -->
        <div class="w-3/4 bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Vakantiebestemmingen</h2>
            <div id="wheelContainer">
                <canvas id="wheelCanvas" width="500" height="500"></canvas>
                <div id="marker"></div>
            </div>
            <button id="spinButton" class="bg-blue-500 text-white py-2 px-4 rounded-md">Draai het rad</button>

            <script>
                // Use the passed destinations for the wheel
                const wheelData = @json($wheelData);

                // Canvas setup
                const canvas = document.getElementById("wheelCanvas");
                const ctx = canvas.getContext("2d");
                const size = canvas.width / 2; // Half the canvas width
                const radius = size; // Radius of the wheel
                const center = {
                    x: size,
                    y: size
                }; // Center of the wheel
                const segmentAngle = (2 * Math.PI) / wheelData.length; // Angle for each segment
                let rotation = 0; // Current rotation of the wheel
                let spinning = false; // Prevent multiple spins

                // Draw the wheel
                function drawWheel() {
                    for (let i = 0; i < wheelData.length; i++) {
                        const angle = i * segmentAngle;
                        // Alternate segment colors
                        ctx.fillStyle = i % 2 === 0 ? "#FFDDC1" : "#FFC0CB";
                        ctx.beginPath();
                        ctx.moveTo(center.x, center.y);
                        ctx.arc(center.x, center.y, radius, angle, angle + segmentAngle);
                        ctx.closePath();
                        ctx.fill();

                        // Add text
                        ctx.save();
                        ctx.translate(center.x, center.y);
                        ctx.rotate(angle + segmentAngle / 2);
                        ctx.textAlign = "right";
                        ctx.fillStyle = "#000";
                        ctx.font = "16px Arial";
                        ctx.fillText(wheelData[i], radius - 10, 5);
                        ctx.restore();
                    }
                }

                // Spin the wheel
                function spinWheel() {
                    if (spinning) return; // Prevent multiple spins
                    spinning = true;

                    const totalRotation = (Math.random() * 5 + 5) * 360; // Random spin between 5-10 rotations
                    const finalRotation = totalRotation % 360; // Only the remaining rotation matters
                    const duration = 5000; // Spin duration in ms
                    const startTime = Date.now();

                    function animate() {
                        const elapsedTime = Date.now() - startTime;
                        const progress = Math.min(elapsedTime / duration, 1); // Normalize time
                        const easing = 1 - Math.pow(1 - progress, 3); // Ease-out cubic
                        const currentRotation = easing * totalRotation;

                        rotation = currentRotation; // Update rotation
                        draw(); // Redraw the wheel

                        if (progress < 1) {
                            requestAnimationFrame(animate); // Continue animation
                        } else {
                            determineResult(finalRotation); // Determine result
                            spinning = false; // Allow new spins
                        }
                    }

                    animate();
                }

                // Determine the result based on the final rotation
                function determineResult(finalRotation) {
                    const adjustedRotation = (360 - (finalRotation % 360)) % 360; // Adjust for clockwise rotation
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
                            // Create detail
                            console.log(data);
                            createDetail(data);
                        }
                    });
                }

                // Redraw the canvas with current rotation
                function draw() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
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
                    // Vul de popup met de bestemmingdetails
                    document.getElementById("vacationImage").src = $destination.image ?? "https://www.thetravelteam.com/wp-content/uploads/2018/08/venice.jpg"; // Default image
                    document.getElementById("vacationName").textContent = $destination.name;
                    document.getElementById("vacationDescription").textContent = $destination.description;

                    // Create list of travel agencies with their respective prices
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

                    // Toon de popup
                    document.getElementById("vacationPopup").classList.remove("hidden");
                }

                // Sluit de popup wanneer op de sluitknop wordt geklikt
                document.getElementById("closePopup").addEventListener("click", () => {
                    document.getElementById("vacationPopup").classList.add("hidden");
                });


                // Initialize the wheel
                draw();

                // Add spin button event listener
                document.getElementById("spinButton").addEventListener("click", spinWheel);
            </script>
            <div class="destination-details">
                <div id="destinationDetails"></div>
            </div>
        </div>

</body>

</html>