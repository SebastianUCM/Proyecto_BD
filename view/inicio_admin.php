<?php
    if(!isset($_SESSION['loged_admin'])){
        header('Location: index.php');
    }
?>

		<div class="carousel slide" id="main-carousel" data-ride="carousel" >
			<ol class="carousel-indicators">
				<li data-target="#main-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#main-carousel" data-slide-to="1"></li>
				<li data-target="#main-carousel" data-slide-to="2"></li>
				<li data-target="#main-carousel" data-slide-to="3"></li>
			</ol><!-- /.carousel-indicators -->
			<div class="carousel-inner" >
				<div class="carousel-item active">
					<img class="d-block w-100" src="https://s19.postimg.cc/qzj5uncgj/slide1.jpg" alt="">
					<div class="carousel-caption d-none d-md-block">
                        <header class=" text-white-center">
                            <div class="container text-center">
                                <h1>Bienvenido Administrador Aero Sky</h1>
                                <p class="lead">El mejor lugar para que vayas donde quieras.</p>
                            </div>
                        </header>
					</div>
                </div>
                
				<div class="carousel-item">
					<img class="d-block w-100" src="https://s19.postimg.cc/lmubh3h0j/slide2.jpg" alt="">
					<div class="carousel-caption d-none d-md-block">
                        <header class=" text-white-center">
                            <div class="container text-center">
                                <h1>Bienvenido Administrador Aero Sky</h1>
                                <p class="lead">El mejor lugar para que vayas donde quieras.</p>
                            </div>
                        </header>
                    </div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="https://s19.postimg.cc/99hh9lr5v/slide3.jpg" alt="">
					<div class="carousel-caption d-none d-md-block">
                        <header class=" text-white-center">
                            <div class="container text-center">
                                <h1>Bienvenido Administrador Aero Sky</h1>
                                <p class="lead">El mejor lugar para que vayas donde quieras.</p>
                            </div>
                        </header>
                    </div>
				</div>
				<div class="carousel-item">
					<img src="https://s19.postimg.cc/nenabzsnn/slide4.jpg" alt="" class="d-block w-100">
					<div class="carousel-caption d-none d-md-block">
                        <header class=" text-white-center">
                            <div class="container text-center">
                                <h1>Bienvenido Administrador Aero Sky</h1>
                                <p class="lead">El mejor lugar para que vayas donde quieras.</p>
                            </div>
                        </header>
                    </div>
				</div>
			</div><!-- /.carousel-inner -->
			
			<a href="#main-carousel" class="carousel-control-prev" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
				<span class="sr-only" aria-hidden="true">Prev</span>
			</a>
			<a href="#main-carousel" class="carousel-control-next" data-slide="next">
				<span class="carousel-control-next-icon"></span>
				<span class="sr-only" aria-hidden="true">Next</span>
			</a>
		</div><!-- /.carousel -->
