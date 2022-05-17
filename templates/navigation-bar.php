
<header>
    <div id="top">
        <div class="container">
            <p class="pull-left text-note hidden-xs"><i class="fa fa-phone"></i> Need Support? <?=$callSupport?></p>
            <ul class="nav nav-pills nav-top navbar-right">
                <li><a href="mailto:info@casavenida.com" title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Email"><i class="fa fa-envelope-o"></i></a></li>
                <li><a href="https://instagram.com/wwwCasavenida" title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Instagram"><i class="fa fa-instagram"></i></a></li>
                <li><a href="https://web.facebook.com/wwwCasavenida" title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/wwwCasavenida" title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-default pgl-navbar-main" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <h2 style="font-size:25px; margin-top:30px; margin-bottom:20px;">CASAVENIDA</h2> </div>

            <div class="navbar-collapse collapse width">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="home">Home</a></li>
                    <li><a href="about-us">About Us</a></li>
                    <li><a href="contact-us">Contact Us</a></li>
                    <?if(isset($userID)){
                       ?>
                        <li class="dropdown"><a href="account-settings" class="dropdown-toggle" data-toggle="dropdown">Profile</a>
                            <ul class="dropdown-menu">
                                <li><a href="account-settings">Profile Settings</a></li>
                                <li><a href="logout">Log out</a></li>
                            </ul>
                        </li>
                        <?
                    }else{
                        ?>
                        <li><a href="log-in">Sign in</a></li>
                        <?
                    }?>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
</header>