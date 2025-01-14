<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draairad vakanties</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        #wheelContainer {
            position: relative;
            width: 500px;
            height: 500px;
            margin: 20px auto;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
        }

        #marker {
            position: absolute;
            top: 50%;
            right: -15px;
            transform: translateY(-50%) rotate(180deg);
            width: 0;
            height: 0;
            border-top: 15px solid transparent;
            border-bottom: 15px solid transparent;
            border-left: 25px solid red;
            /* Create the triangle pointing to the wheel */
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Dynamic Spinning Wheel</h1>
    <div id="wheelContainer">
        <canvas id="wheelCanvas" width="500" height="500"></canvas>
        <div id="marker"></div>
    </div>
    <button id="spinButton">Spin the Wheel</button>

    <script>
        const wheelData = @json($dataPoints);

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
            alert(`You landed on: ${wheelData[segmentIndex]}`);
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

        // Initialize the wheel
        draw();

        // Add spin button event listener
        document.getElementById("spinButton").addEventListener("click", spinWheel);
    </script>
</body>

</html>