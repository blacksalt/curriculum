<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>New Project</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'public/css/style.css' ?>" type="text/css" media="screen, projection, tv" />
    <link rel="stylesheet" href="<?php echo base_url().'public/css/forms.css' ?>" type="text/css" media="screen, projection, tv" />
    <link rel="stylesheet" href="<?php echo base_url().'public/css/tables.css' ?>" type="text/css" media="screen, projection, tv" />
    <link rel="stylesheet" href="<?php echo base_url().'public/css/style-print.css' ?>" type="text/css" media="print" />

    <!-- JS -->
    <script type="text/javascript" src="<?php echo base_url().'public/'?>js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".message").fadeOut(3000);
        });
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url().'public/'?>favicon.ico" type="image/x-icon" />
</head>

<body>
    <div style="height: 25px;border:none;">
        <?php
            $string = $this->session->flashdata('message');
            echo !empty($string)? '<div class="message">'.$string.'</div>': '' 
        ?>
    </div>

    <?php echo $body ?>
    
</body>

</html>
