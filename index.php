<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuka Clone - Barcode Scanner</title>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/scan.js"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #D32F2F;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            padding-bottom: 80px;
            color: white;
        }

        .header {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            color: #D32F2F;
            padding: 10px;
            border-radius: 25px;
            display: flex;
            justify-content: space-around;
            width: 80%;
            max-width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            z-index: 1000;
        }

        .header button {
            background: none;
            border: none;
            font-size: 16px;
            color: #D32F2F;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 20px;
            transition: background 0.3s;
        }

        #historybutton {
            background: #D32F2F;
            border: none;
            font-size: 16px;
            color:rgb(255, 255, 255);
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 20px;
            transition: background 0.3s;
            margin:0.2rem;
        }

        .header button.active {
            background: #D32F2F;
            color: white;
        }

        .container {
            width: 90%;
            max-width: 500px;
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin-top: 20px;
            color: #D32F2F;
        }

        .scanner-box {
            width: 100%;
            max-width: 300px;
            height: 200px;
            border: 4px solid red;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            position: relative;
            overflow: hidden;
        }

        video {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .history {
            margin-top: 20px;
            width: 90%;
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.3);
            color: #D32F2F;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container" id="scanner-section">
        <h1>Barcode Scanner</h1>
        <div class="scanner-box" id="scanner-box">
            <video id="scanner-container"></video>
        </div>
        <p>Scanned Code: <span id="result">None</span></p>
        <button id="historybutton" onclick="startScanner()">Start Scanning</button>
    </div>


    <div class="history" id="history-section">
        <h3>Scan History</h3>
        <div id="history-list"></div>
    </div>

    <div class="header">
        <button id="scan-tab" class="active" onclick="showTab('scanner')">Scan</button>
        <button id="history-tab" onclick="showTab('history')">History</button>
    </div>

    <script>
        function showTab(tab) {
            document.getElementById('scanner-section').style.display = tab === 'scanner' ? 'block' : 'none';
            document.getElementById('history-section').style.display = tab === 'history' ? 'block' : 'none';
            document.getElementById('scan-tab').classList.toggle('active', tab === 'scanner');
            document.getElementById('history-tab').classList.toggle('active', tab === 'history');
        }
    </script>
</body>

</html>