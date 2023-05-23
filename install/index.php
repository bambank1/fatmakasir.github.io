<!DOCTYPE html>
<html>
    <head>
        <title>Pos Kasir Installation Wizard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Pos Kasir">
        
        <link rel="shortcut icon" href="images/logo.png">
        
        <!-- Custom Theme files -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- //Custom Theme files -->
        
    </head>
    <body>
        <!-- main -->
        <div class="main">
            
            <?php
                $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                $base_url .= "://" . $_SERVER['HTTP_HOST'];
                $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                $base_url = str_replace('install/', '', $base_url);
            ?>
            
            <div class="main-agilerow"> 
                <div class="ci-install-wrap">
                    <h1>POS PERCETAKAN  </h1>
                    
                    <span class="ci-subt">INSTALLATION WIZARD</span>
                    <hr class="style1">
                    <h2>Install Now</h2>
                    <p>POS PERCETAKAN INSTALLER </p>
                </div>	
                
                
                <div class="ci-form-wrap" id="success-wrap" style="display:none;">
                    
                    <h2>Installation Successful.</h2>
                    <p>Authentication Credentials -</p>
                    <p style="font-weight:bolder">
                        Username: admin@my.id <br />
                        Password: 12345
                    </p>
                    <hr class="style2">
                    
                    <p><a class="btn btn-primary" href="<?php echo $base_url; ?>">Click Here</a><strong> to Login!</strong></p>
                    
                </div>
                
                <div class="ci-form-wrap" id="main-wrap">
                    <form action="#" method="post">
                        <h3 class="hide">Step 1 : Database Configuration</h3>
                        <div class="form-step1 hide">
                            
                            <label>Host</label>
                            <span class="hints">Ex - localhost</span>
                            <input type="text" id="dbhost" name="dbhost" placeholder="Enter Database Host" required>
                            
                            <label>User</label>
                            <span class="hints">Ex - root</span>
                            <input type="text" id="dbuser" name="dbuser" placeholder="Enter Database UserName" required>
                            
                            <label>Password</label>
                            <span class="hints">Ex - password</span>
                            <input type="text" id="dbpass" name="dbpass" placeholder="Enter Database Password" required>
                            
                            <label>DB Name</label>
                            <span class="hints">Ex - db_name</span>
                            <input type="text" id="dbname" name="dbname" placeholder="Enter Database Name" required>					
                            
                        </div> 
                        
                        <h3 class="hide">Step 2 : Base URL</h3>
                        <div class="form-step1 hide"> 						
                            <span class="hints">Ex - http://localhost/pos_kasir/</span>
                            <input type="text" id="base_url" name="base_url" placeholder="Base URL" value="<?php echo $base_url; ?>" required>						
                        </div>
                        
                        <br />
                       
                        <div class="center" id="form-progress">
                            
                        </div>
                        <br />
                        
                        <div id="submit_btn">
                            <input type="button" value="Start Installation" onClick="install_ci_pa()">
                        </div>
                        
                    </form>
                </div>  
            </div>	
        </div>	
        <!-- //main -->
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        
        <script>
            
            function install_ci_pa()
            {
                var ci_version = 3; // CI Version	
                
                var base_url = $("#base_url").val(); // base host
                
                var dbhost = $("#dbhost").val(); // database host	
                var dbuser = $("#dbuser").val(); // database user	
                var dbpass = $("#dbpass").val(); // database pass	
                var dbname = $("#dbname").val(); // database name
                
                var form_stat = 1;
                
                if (base_url == "") {
                    form_stat = 0;
                    
                    $("#base_url").addClass("warning");
                    $("#base_url").focus();
                    } else {
                    $("#base_url").removeClass("warning");
                }
                
                if (dbname == "") {
                    form_stat = 0;
                    
                    $("#dbname").addClass("warning");
                    $("#dbname").focus();
                    } else {
                    $("#dbname").removeClass("warning");
                }
                
                if (dbuser == "") {
                    form_stat = 0;
                    
                    $("#dbuser").addClass("warning");
                    $("#dbuser").focus();
                    } else {
                    $("#dbuser").removeClass("warning");
                }
                
                if (dbhost == "") {
                    form_stat = 0;
                    
                    $("#dbhost").addClass("warning");
                    $("#dbhost").focus();
                    } else {
                    $("#dbhost").removeClass("warning");
                }
                
                if (form_stat === 1)
                {
                    $("#form-progress").html('<center><div class="loader"></div><br />Installing Pos Percetakan. Please Wait!</center>');
                    
                    $(".hide").hide();
                    $("#submit_btn").hide();
                    
                    $.ajax({
                        type: "post",
                        url: "install.php",
                        //dataType: "json",
                        data: {
                            template: ci_version,
                            url: base_url,
                            hostname: dbhost,
                            username: dbuser,
                            password: dbpass,
                            database: dbname
                        },
                        success: function (resp) {
                            console.log(resp);
                            if (resp == '')
                            {
                                setTimeout(function() { 
                                     $(".hide").hide();
                                    $("#submit_btn").hide();
                                    $("#main-wrap").hide();
                                    $("#success-wrap").show();
                                }, 20000); // ES5 syntax
                            } else
                            {
                                $("#form-progress").html(resp);
                                $("#form-progress").focus();
                                $("#submit_btn").show();
                                 $(".hide").show();
                            }
                            
                            // $("#submit_btn").show();
                        }
                    });
                } else
                {
                    $("#form-progress").html('Please Fill The Form Correctly!');
                    
                    $("#submit_btn").show();
                }
                
            }
            
            
        </script>
        
    </body>
</html>