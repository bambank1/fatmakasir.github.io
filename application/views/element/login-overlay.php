<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Munajat Ibnu">
        <link href="<?= base_url('uploads/'); ?><?=info()['favicon'];?>" rel="icon">
        <title><?= $title; ?></title>
        <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js" type="text/javascript"></script>
    </head>
    <body class="bg-gradient-login"> 
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h4>Login</h4>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <form>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email1"placeholder="email...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password1" placeholder="password...">
                                </div>
                                <button type="button" class="btn btn-info btn-block btn-round">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $("#loginModal").modal({
                    backdrop : "static",
                    keyboard : false
                });
                $(function () {
                $('[data-toggle="tooltip"]').tooltip()
                })
                });
        </script>
    </body>
</html>