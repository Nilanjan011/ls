<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRCode Tutorial with Scanner</title>

    <!-- Stylesheets -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">

<div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
<button class="btn btn-danger" onclick=scanner()>Scanner</button>
  <label class="btn btn-primary active">
    <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
  </label>
</div>
</div>
    <!-- QR Code Generator Form -->
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <h1>QR Code Generator</h1>
            <h2 id="h2"></h2>
            <div class="from-wrapper">
                <form method="post" action="qrcode.php" class="form">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <button class="btn btn-primary btn-block">Generate QR Code</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /QR Code Generator Form -->

    <!-- QR CODE Wrapper -->
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <div class="status text-center font-weight-bold d-none"></div>
            <div id="auc-qrcode"></div>
        </div>
    </div>
    <video id="preview"></video>
    
    <!-- /QR CODE Wrapper -->
    <!-- scanner cdn start -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <!-- scanner cdn end -->

    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/qrcode.min.js"></script>
    <script src="public/js/script.js"></script>
    <script type="text/javascript">
    // scnner code start
    function scanner(){
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
    scanner.addListener('scan',function(content){
        document.getElementById("h2").innerHTML=content;
        // alert(content);
        //window.location.href=content;
    });
    Instascan.Camera.getCameras().then(function (cameras){
        if(cameras.length>0){
            scanner.start(cameras[0]);
            $('[name="options"]').on('change',function(){
                if($(this).val()==1){
                    if(cameras[0]!=""){
                        scanner.start(cameras[0]);
                    }else{
                        alert('No Front camera found!');
                    }
                }else if($(this).val()==2){
                    if(cameras[1]!=""){
                        scanner.start(cameras[1]);
                    }else{
                        alert('No Back camera found!');
                    }
                }
            });
        }else{
            console.error('No camera found.');
            alert('No camera found.');
        }
    }).catch(function(e){
        console.error(e);
        alert(e);
    });
}
// scnner code end
</script>
<!-- <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
  <label class="btn btn-primary active">
    <input type="radio" name="options" value="1" autocomplete="off" checked> Back Camera
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" value="2" autocomplete="off"> Front Camera
  </label>
</div> -->

</body>
</html>