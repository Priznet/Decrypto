<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cryptography</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/select2.min.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title bg-dark" >
                    <span class="login100-form-title-1">
					Cryptogram
					</span>
                    <small class="text-muted">Decrypt/Encyrpt your data here</small>
                </div>

                <form class="login100-form validate-form" id="this" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Value is required">
                        <span class="label-input100">Value :</span>
                        <input class="input100" type="text" name="username" id="value" placeholder="Type something...">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="d-flex justify-content-between">
                      
                        <select class="custom-select select2" style="width: 392px;" name="" id="cipher">
        <option selected value="">Select cipher algorithm</option>
    <?php
        $ciphers             = openssl_get_cipher_methods();

        foreach($ciphers as $c){
         if( strpos($c,'d-') == false) {
            echo   '<option  value="'.$c.'">'.$c.'</option>';

         }
         
        }
    ?>
    </select>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Value is required">
                        <span class="label-input100">Result :</span>
                        <input class="input100" type="text" name="username" readonly id="final" >
                        <span class="focus-input100"></span>
                    </div>
                    


                    <div class="row justify-content-center">

                        <button  type="button" class="login100-form-btn mr-1" id="decrypt">
								Decrypt
							</button>

                        <button type="button" class="login100-form-btn" id="encyrpt">
								Encrypt
							</button>


                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <script src="js/select2.min.js"></script>
<script>

$(document).ready(function () {
    $('.select2').select2();


    $('#this input').each(function () {
    $(this).val('');    
        
    });
});

    function ajax  (type,value,cipher) {

                $.ajax({
                    type: "POST",
                    url: "de.php",
                    data: {type:type,value:value,cipher:cipher},
                    dataType: "JSON",
                    success: function (data) {
                        $('#final').val(data.result);

                        if(data.result == false){
                            $('#final').val('Enter encrypted data!');
                        }
                        $('#value').val('');
                    }
                });

      }

    $('#decrypt').click(function (e) { 
        var type = 'd';
        var value = $('#value').val();
            var cipher = $('.select2').children('option:selected').val();
          
        if(value != '' && cipher !=''){
            $('#value').removeClass('is-invalid');
            ajax(type,value,cipher);
        }
  
        
    });

    $('#encyrpt').click(function (e) { 
        var type = 'e';
        var value = $('#value').val();
        var cipher = $('.select2').children('option:selected').val();
        if(value != '' && cipher !=''){
            $('#value').removeClass('is-invalid');
            ajax(type,value,cipher);
        }

        
    });
</script>
</body>

</html>