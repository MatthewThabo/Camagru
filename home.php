<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        body { font-family: Arial, Helvetica, sans-serif;
	            background-color: coral;  }
        #results { margin:20px; border:double; background:coral; } 
    </style> 
    <title>CAMAGRU</title>
</head>
<body>
    <?php if (isset($_SESSION['id'])) { ?>
    <?php include 'includes/header.php'; ?>
    <style scoped>
        /*Dante*/
        .takesnap {
            display: flex;
            flex-direction: column;
            width: 70vw;
            margin: auto;
            position: relative;
        } 
            .booth_main {
                flex: 4;
                display: flex;
                position: absolute;
                width: 70vw;
                margin: auto;
                padding: 0;
            }
                .webcam {
                    flex: 4;
                    display: flex;
                    flex-direction: column;
                    width: 45%;
                }
                    .webcam_video {
                        flex: 4;
                    }
                    .webcam_input {
                        flex: 1;
                    }

                .canvas {
                    flex: 4;
                    width: 45%;
                    display: flex;
                    flex-direction: column;
                }
                    .canvas_snap {
                        flex: 4;
                    }
                    .canvas_button {
                        flex: 1;
                    }

                .stickers
                {
                    flex: 1;
                    width: 10%;
                    position: relative;
                    padding: 5px;
                }

    </style>
    <!-- <div class="takesnap">
        <div class="booth_main">
            <div class="webcam">
                <div class="webcam_video">
                    <h1><strong>Webcam</strong></h1>
                    <video src="" id="video" width="340px" height="280px" style="width: 340px; height: 280px;" muted="muted" autoplay="true"></video>
                </div>
                <div class="webcam_input">
                    <input type="button" id="capture" value="Take photo">
                </div>
            </div>
            <div class="canvas">
                <div class="canvas_snap">
                    <h1><strong>Preview</strong></h1>
                    <canvas id="canvas" width="540px" height="380px" style="width: 540px; height: 380px;"></canvas>
                </div>
                <div class="canvas_button">
                    <button href="upload.php">Upload</button>
                </div>
            </div>
            <div class="stickers">
                <h1><strong>Stickers</strong></h1>        
                <form id ="capture-form">
                    <label>
                        <img class="thumbnail" id = "image1" src="img/beautiful-flowers.png" onclick="addSup(1)"/>
                    </label>
                    <label>
                        <img class="thumbnail" id = "image2" src="img/frame.png" onclick="addSup(2)"/>
                    </label>
                    <label>
                        <img class="thumbnail" id = "image3" src="img/8.png" onclick="addSup(3)"/>
                    </label>
                    <label>
                        <img class="thumbnail"  id = "image4" src="img/wow.png" onclick="addSup(4)"/>
                    </label>
                    <label>
                        <img class="thumbnail"  id = "image5" src="img/colour.png" onclick="addSup(5)"/>
                    </label>
                    <label>
                        <img class="thumbnail" id = "image6" src="img/16.png" onclick="addSup(6)"/>
                    </label>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function addSup(el) {
        var imageSrc =  canvas = document.getElementById('image' + el);
        sup.setAttribute('src', imageSrc);
        
        canvas = document.getElementById('canvas');
        context = canvas.getContext('2d');
        context.drawImage(imageSrc, 200, 0, 100, 180);
        alert(imageSrc);
        document.getElementById('capture').disabled = false;
        }
            
        // (function() {
        //     var video = document.getElementById('video'),
        //         canvas = document.getElementById('canvas');
        //         context = canvas.getContext('2d'),
        //         vendorUrl = window.URL || window.webkitURL;

        //     navigator.getMedia =    navigator.getUserMedia ||
        //                             navigator.webkitGetUserMedia ||
        //                             navigator.mozGetUserMedia;

        //     navigator.getMedia({video: true,audio: false}, function(stream) {
        //         video.src = vendorUrl.createObjectURL(stream);
        //         video.play();

        //     }, function(error) {
        //         alert("Error trying to stream Webcam")
        //     });

    (function() {
    var video = document.getElementById('video'),
        vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia = navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia;

    navigator.getMedia({
        video: true,
        audio: false
    }, function(stream) {
        video.srcObject = stream; //vendorUrl.createObjectURL(stream);
        video.play();
    }, function(error) {
        // an error occured
        // error.code
        console.log("ERROR: " + error);
    });

            document.getElementById('capture').addEventListener('click', function() {
                context.drawImage(video, 0, 0, 540, 380);
               var element = document.getElementById('picture');
                var img = canvas.toDataURL('image/png');
                element.value = img;
                alert(img);
               document.getElementById('capture-form').submit();
            })
        })();
    </script> -->
    <div class="container">
    <h1 class="text-center">Web Cam</h1>
   
    <form method="POST" action="savecam.php">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Preview</div>
            </div>
            <div class="stickers">
                <h1><strong>Stickers</strong></h1>        
                <form id ="capture-form">
                    <label>
                        <img class="thumbnail" id = "image1" src="img/beautiful-flowers.png" onclick="addSup(1)"/>
                    </label>
                    <label>
                        <img class="thumbnail" id = "image2" src="img/frame.png" onclick="addSup(2)"/>
                    </label>
                    <label>
                        <img class="thumbnail" id = "image3" src="img/8.png" onclick="addSup(3)"/>
                    </label>
                    <label>
                        <img class="thumbnail"  id = "image4" src="img/wow.png" onclick="addSup(4)"/>
                    </label>
                    <label>
                        <img class="thumbnail"  id = "image5" src="img/colour.png" onclick="addSup(5)"/>
                    </label>
                    <label>
                        <img class="thumbnail" id = "image6" src="img/16.png" onclick="addSup(6)"/>
                    </label>
                </form>
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
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

    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
    <footer>
        <div>
            <p><em>&copy; Copyright 2018 tmatlena. All rights reserved.</em></p>
        </div>
    </footer>
    <?php
        include_once ('config/database.php');

        try
        {
            $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $db->prepare("SELECT * FROM gallery WHERE userId = ? ORDER BY date_created DESC");
            $value = array($_SESSION['id']);
            $query->execute($value);

            $result = $query->fetchAll();
            foreach ($result as $v) 
            { 
    ?>
                <img class="img" src="<?php echo "images/".$v['img']; ?>" />
                <a class="btn" href="delete.php?id=<?php echo $v['id']; ?>">delete</a>
    <?php 
            }
        }
        catch (PDOException $e) 
        {
                return $e->getMessage();
        }
        $db = null;
    ?>
    <!-- <form id="capture-form" name="capture-form" method="Post" action="savecam.php">
        <input type="hidden" name="img" id="picture" value=""/>
    </form> -->
  
    <?php 
        } 
        else 
        {
            header("Location: home.php");
        }
    ?>
</body>
</html>