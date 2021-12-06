<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./responsive/responsive.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
    <title>Camagru</title>
</head>
<body>
    <ul>
        <li><a class="active" href="./index.php">Home</a></li>
        <li><a href="#news">Gallery</a></li>
        <li><a href="./about.php">About</a></li>
        <li><a href="#contact">Logout</a></li>
        <!-- <li><a href="#about">About</a></li> -->
    </ul>
     <h1>Camagru</h1>
     <div class="takesnap">
        <div class="booth_main">
            <div class="webcam">
                <div class="webcam_video">
                    <h2><strong>Webcam</strong></h2>
                    <div class="img-box inner-shadow">
                        <div id="camera">
                        </div>
                    </div>
                </div>
                <div class="webcam_input">
                   <input type="button" value="Take a Snap" id="btn-1" class="hover-in-shadow" onclick="takeSnapShot()" />
                    <button href="upload.php" id="btn-1">Upload</button>
                </div>
            </div>
            <div class="canvas">
                <div class="canvas_snap">
                    <h2><strong>Preview</strong></h2>
                        <p id="snapShot"></p>
                </div>
            </div>
            <div class="stickers">
                <h2><strong>Stickers</strong></h2>        
                <form id ="capture-form">
                    <label>
                        <img class="thumbnail" id="image1" src="stickers/alphatest1.png" style="width:50px; height:30px" onclick="addSup(1)"/>
                    </label>
                    <label>
                        <img class="thumbnail" id="image2" src="stickers/alphatest2.png" style="width:50px; height:30px" onclick="addSup(2)"/>
                    </label>
                    <label>
                        <img class="thumbnail" id="image3" src="stickers/alphatest3.png" style="width:50px; height:30px" onclick="addSup(3)"/>
                    </label>
                </form>
            </div>
        </div>
    </div>
  
</body>

<script>
    
    Webcam.set({
        width: 220,
        height: 190,
        image_format: 'jpeg',
        jpeg_quality: 100
    });

    function addSup(el) {
        var imageSrc =  canvas = document.getElementById('image' + el);
        sup.setAttribute('src', imageSrc);
        
        canvas = document.getElementById('canvas');
        context = canvas.getContext('2d');
        context.drawImage(imageSrc, 200, 0, 100, 180);
        alert(imageSrc);
        document.getElementById('capture').disabled = false;
        }

    Webcam.attach('#camera');

    
    takeSnapShot = function () {
        Webcam.snap(function (data_uri) {
            document.getElementById('snapShot').innerHTML = 
                '<img src="' + data_uri + '" width="220px" height="190px" />';
        });
    }
</script> 
<footer>
        <div>
            <p><em>&copy; Copyright 2018 Thabo Matlenana. All rights reserved.</em></p>
        </div>
</footer>
</html>