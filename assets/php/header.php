<!DOCTYPE html>
<html lang="de" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="PHPMyApple">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <title>Chatlog</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">    
    <link rel="stylesheet" href="/assets/css/standard-theme.min.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">

    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="page-container">
    <div class="page-content">


    <header id="header" class="header navbar-fixed-top">
        <div class="container" style="display: flex;">
            <nav class="main-nav center-block" role="navigation">
                <div class="navbar-header text-center">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="toggle-title">Men&uuml</span>
                        <span class="icon-bar-wrapper">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </span>
                    </button>
                </div>
                <div id="navbar-collapse" class="navbar-collapse collapse text-center">
                    <ul class="nav navbar-nav center-block">
                        <li class="nav-item"><a class="scrollto" href="https://example.org/#home><?php echo $translation['header']['title1']; ?></a></li>

                        <li class="nav-item"><a href="https://forum.example.org"><?php echo $translation['header']['title2']; ?></a></li>
                        <li class="nav-item"><a class="scrollto" href="https://example.org/#about"><?php echo $translation['header']['title3']; ?></a></li>
						<li class="nav-item"><a class="scrollto" href="https://example.org/#service"><?php echo $translation['header']['title4']; ?></a></li>
                        <li class="nav-item"><a class="scrollto" href="https://example.org/#contact"><?php echo $translation['header']['title5']; ?></a></li>

                        
                        <li class="nav-item colored">
                            <a target="_blank" href="github.com/example">
                                <i class="fas fa-code" aria-hidden="true" style="margin-right: 5px;"></i>
                                <?php echo $translation['header']['title6']; ?>
                            </a>
                        </li>
						
                        <li class="nav-item colored">
                            <a target="_blank" href="example.org/phpmyadmin">
                                <i class="fa fa-database" aria-hidden="true" style="margin-right: 5px;"></i>
                                <?php echo $translation['header']['title7']; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header><