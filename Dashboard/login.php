<?php
session_start();

if (isset($_SESSION["id"])) {
    header("Location: account");
    exit;
}

$error = "";
$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Captcha check
    $captcha_input = trim($_POST['_captcha'] ?? '');
    if (empty($captcha_input) || !isset($_SESSION['captcha']) || strtolower($captcha_input) !== strtolower($_SESSION['captcha'])) {
        $error = "Invalid captcha code";
    } else {
        unset($_SESSION['captcha']);
        
        if ($email === '' || $password === '') {
            $error = "Email and password are required";
        } else {
            require_once "client/db.php"; // $pdo from here
            try {
                $stmt = $pdo->prepare(
                    "SELECT id, first_name, last_name, username, email, country, currency, number, password_hash 
                     FROM users 
                     WHERE email = ?"
                );
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password_hash'])) {
                    session_regenerate_id(true);

                    $_SESSION['id']         = $user['id'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name']  = $user['last_name'];
                    $_SESSION['username']   = $user['username'];
                    $_SESSION['email']      = $user['email'];
                    $_SESSION['country']    = $user['country'];
                    $_SESSION['currency']   = $user['currency'];
                    $_SESSION['number']     = $user['number'];

                    header("Location: account");
                    exit;
                } else {
                    $error = "Invalid email or password";
                }
            } catch (PDOException $e) {
                $error = "Login failed. Try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="https://PayBit-BinaryXchange.com/img/fb.png">
  <link rel="shortcut icon" href="public/img/favicon.png" type="image/x-icon">

  <!--<title>PayBit-BinaryXchange | Join </title>-->


  <link rel="stylesheet" href="public/vendor/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="public/vendor/bootstrap-4.1.1/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="public/css/light_adminux.css" type="text/css">

  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>



<!-- g-hide -->
<style type="text/css">iframe.goog-te-banner-frame{ display: none !important;}</style>
<style type="text/css">iframe.skiptranslate{ display: none !important;}</style>
<style type="text/css">body {position: static !important; top:0px !important;}</style>
<!-- end-g-hide -->

  <!--/GetButton.io widget-->
<script type="text/javascript">
    (function() {
        var options = {
            whatsapp: "‪+1 (650) 209‑2324‬", // WhatsApp number
            call_to_action: "Contact us!", // Call to action
            position: "left", // Position may be "right" or "left"
        };
        var proto = document.location.protocol,
            host = "getbutton.io",
            url = proto + "//static." + host;
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = url + "/widget-send-button/js/init.js";
        s.onload = function() {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    })();
</script> 
<!-- /GetButton.io widget -->





</head>

<body class="menuclose menuclose-right" style="background:gray">



  <figure class="background">
    <video autoplay muted="muted" loop id="myVideo">
      <source src="public/bg.mp4" type="video/mp4">
    </video>
  </figure>

  <style>
    #myVideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      z-index: -1;
    }
  </style>
  

  <div id="google_translate_element"></div>

  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en'
      }, 'google_translate_element');
    }
  </script>

  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



  <header class="navbar-fixed">
    <nav class="navbar navbar-toggleable-md sign-in-header">
      <div class="sidebar-left"> <a class="navbar-brand imglogo" href="index"></a></div>
      <div class="col"></div>
      <div class="sidebar-right pull-right">
        <ul class="navbar-nav  justify-content-end">
          <li style="margin:4px"><a href="#" class="btn btn-link text-white"></a></li>
          <li style="margin:4px"><a href="../home " style="background:#3f48cc;color:white" class="btn btn-primary">Home</a></li>
          <li style="margin:4px"><a href="login" style="background:#3f48cc;color:white" class="btn btn-primary">Login</a></li>
          <li style="margin:4px"><a href="register" style="background:#3f48cc;color:white" class="btn btn-primary">Register</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="wrapper-content-sign-in p-0">



    
    <title>PayBit-BinaryXchange | Login</title>


<div class="col-md-8 offset-md-8 text-left side_signing_full">
  <form class="form-signin1 full_side text-white " action="" method="POST">
    <img style="width:100%;height:100%" src="/img/logo.png">
    <span>
    <h3 style="color:crimson;text-align:center"><?= htmlspecialchars($error) ?></h3>
    </span>
    <span>
      <h3 style="color:green;text-align:center"></h3>
    </span>
    <h2 class="tex-black mb-4">Sign in</h2>
    <label style="color:black"> Email</label>
    <input type="email" style="color: black; font-weight: bold;" name="email" class="form-control" placeholder="Email" value="<?= htmlspecialchars($email ?? '') ?>" required>
    <span style="color:crimson"></span>
    <br>
    <label style="color:black">Password</label>
    <input type="password" style="color:black;font-weight:bold" name="password" value="<?= htmlspecialchars($password ?? '') ?>" class="form-control" placeholder="Password" required>
    <span style="color:crimson"></span>
    <br>
          <div class="input-group">
        <div class="input-group-prepend">
          <img src="public/captcha" id="" alt="captchaImg" srcset="">
        </div>
        <input style="color:black" type="text" value="" placeholder="Enter Captcha" name="_captcha" class="form-control font-weight-bold" id="captcha" required>
      </div>
      <span style="color:crimson"></span>
      <br>
        <input type="checkbox" style="width:auto" name="remember" id="check" > <label for="check" style="color:black">Remember Me</label>
    <br>
    <input type="submit" name="login_btn" style="background:#3f48cc;color:white" class="btn btn-lg btn-primary" value="Login"><br>
    <br>
    <p class="mt-3"><a href="register" class="text-white">Register here!</a> <br>
      <a style="color:#0080db" href="forgot" class="">Forgot password?</a>
    </p>
  </form>
  <br>
</div>  </div>




 <script src="//code.jivosite.com/widget/2xb7DNlE1r" async></script>


<style>
.mgm {
    border-radius: 7px;
    position: fixed;
    z-index: 90;
    bottom: 120px;
    right: 20px;
    background: #fff;
    border:4px solid #3f48cc;
    padding: 10px 27px;
    box-shadow: 0px 5px 13px 0px rgba(0, 0, 0, .3);
}

.mgm a {
    font-weight: 700;
    display: block;
    color: #3f48cc;
}

.mgm a,
.mgm a:active {
    transition: all .2s ease;
    color: #3f48cc;
}
</style>
<div class="mgm" style="display: none;">
<div class="txt" style="color:black;"></div>
</div>

<script data-cfasync="false" src="#"></script>
<script type="text/javascript">
    var listCountries = ['USA', 'Portugal', 'Germany', 'France', 'Italy', 'Namibia', 'Canada', 'South Africa', 'Canada', 'Argentina', 'Saudi Arabia', 'Mexico', 'Portugal', 'Brazil', 'Venezuela', 'Isreal', 'Sweden', 'USA', 'Colombia', 'Italy', 'Canada', 'United Kingdom', 'USA', 'Greece', 'Cuba', 'Germany', 'Portugal', 'Austria', 'Mexico', 'Panama', 'South Africa', 'USA', 'Netherlands', 'Switzerland', 'Belgium', 'Israel', 'Cyprus'];
    var listPlans = ['$51,000', '$14,500', '$40,000', '$1,000', '$10,000', '$50,000', '$52,300', '$9,700', '$10,000', '$4,500', '$9,500', '$34,000', '$42,000', '$4,600', '$3,700', '$27,500','$58,623','$31,600'];
    var transarray = ['just <b>invested</b>', 'has <b>withdrawn</b>', 'is <b>trading with</b>'];
    interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
    var run = setInterval(request, interval);

    function request() {
        clearInterval(run);
        interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
        var country = listCountries[Math.floor(Math.random() * listCountries.length)];
        var transtype = transarray[Math.floor(Math.random() * transarray.length)];
        var plan = listPlans[Math.floor(Math.random() * listPlans.length)];
        var msg = 'Someone from <b>' + country + '</b> ' + transtype + ' <a href="javascript:void(0);" onclick="javascript:void(0);">' + plan + '</a>';
        $(".mgm .txt")(msg);
        $(".mgm").stop(true).fadeIn(300);
        window.setTimeout(function() {
            $(".mgm").stop(true).fadeOut(300);
        }, 5000);
        run = setInterval(request, interval);
    }
</script>




  <script src="public/js/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script src="public/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="public/vendor/bootstrap4beta/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="public/vendor/cookie/jquery.cookie.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="/js/ie10-viewport-bug-workaround.js"></script>
  <script>
    "use strict";
    $('input[type="checkbox"]').on('change', function() {
      $(this).parent().toggleClass("active")
      $(this).closest(".media").toggleClass("active");
    });
    $(window).on("load", function() {
      /* loading screen */
      $(".loader_wrapper").fadeOut("slow");
    });
  </script>


  <script>
    $(document).keydown(function(event) {
      if (event.keyCode == 123) {
        return false;
      } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
        return false;
      }
    })
    document.addEventListener('contextmenu', event => event.preventDefault())
  </script>

<script>
  window.onload = () => {
    document.getElementById("captchaImg").src = "/captcha" + Date.now();
  };
</script>


</body>
</html>
