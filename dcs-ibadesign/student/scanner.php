<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <!-- Include the jsQR library -->
    <script src="jsQR.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        .qr-data {
            white-space: pre-wrap;
        }
        
        .qr-data a {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>QR Code Scanner</h1>
        <video id="video" width="300" height="200" autoplay></video>
        <canvas id="canvas" style="display: none;"></canvas>
        <div id="result"></div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        const resultDiv = document.getElementById('result');
        let lastScannedData = null;

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                video.srcObject = stream;
            })
            .catch(function(err) {
                console.error('Error accessing the camera.', err);
            });

        function scanQRCode() {
            context.drawImage(video, 0, 0, 300, 200);
            const imageData = context.getImageData(0, 0, 300, 200);
            const code = jsQR(imageData.data, imageData.width, imageData.height);

            if (code) {
                lastScannedData = code.data;
                console.log("Last scanned data:", lastScannedData);
                resultDiv.innerHTML = formatQRData(lastScannedData);
            } else {
                resultDiv.innerText = lastScannedData ? "Last Scanned QR Code Data: " + lastScannedData : "No QR code detected.";
            }
        }

        function formatQRData(data) {
            const lines = data.split('\n');
            let formattedData = "<div class='qr-data'>QR Code Data:<br>";
            lines.forEach(line => {
                formattedData += line + "<br>";
            });
            const linkMatch = data.match(/Attendance Link:\s*(\S+)/);
            if (linkMatch && linkMatch.length > 1) {
                const link = linkMatch[1];
                formattedData += "<a href='" + link + "' target='_blank'>" + link + "</a><br>";
            }
            formattedData += "</div>";
            return formattedData;
        }

        setInterval(scanQRCode, 1000); // Scanning QR code every second
    </script>
</body>
</html>
