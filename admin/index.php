<?php include_once("../lib/includes.php")?>

<html lang="pt-br">
    <head>
    
        <title><?php echo titulo_site;?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        

        <base href="<?php echo url_site;?>">

        <link rel="stylesheet"  href="css/admin.css">
        <link rel="stylesheet" href="disti/ui/trumbowyg.min.css">
        
        <style>
            .navbar {
                margin-bottom: 0;
                background-color: #145252;
                z-index: 9999;
                border: 0;
                font-size: 12px !important;
                line-height: 1.42857143 !important;
                letter-spacing: 4px;
                border-radius: 0;
                font-family: Montserrat, sans-serif;
            }
            .navbar li a, .navbar .navbar-brand {
                color: #fff !important;
            }
            .navbar-nav li a:hover, .navbar-nav li.active a {
                color:#28a4a4 !important;
                background-color: lightgrey !important;
            }
            .navbar-default .navbar-toggle {
                border-color: transparent;
                color: #fff !important;
            }
        </style>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        
        
        <nav id="NavTop" class="navbar navbar-expand-sm justify-content-between">
            
            <!-- Brand/logo -->
            <a class="navbar-brand" href="index.html">Santo Antônio Morro Velho</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links-->
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../sobre.hmtl">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Videos.html">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Contatos.html">Contatos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../fotos.html">Fotos</a>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="row">
                <?php if(isset($_SESSION['admLogin'])){?>
                    <div class="col-sm-3">
                        <div class="menu">
                            <div class="title-menu">Menu</div>
                                <ul>
                                    <li class="blue"><a href="admin/" class="category"> Publicações</a>
                                        <ul>
                                            <li><a href="admin/publicar"><i class="fas fa-plus"></i> Cadastrar</a></li>
                                            <li><a href="admin/gerenciar-post"><i class="fas fa-bars"></i> Gerenciar</a></li>
                                        </ul>
                                    </li>

                                    <li class="cyan2"><a href="admin/" class="category"> Categorias</a>
                                        <ul>
                                           <li><a href="admin/gerenciar-categorias"><i class="fas fa-bars"></i> Gerenciar Categorias</a></li>
                                        </ul>
                                    </li>

                                    <li class="cyan"><a href="admin/" class="category"> Comentários</a>
                                        <ul>
                                            <li><a href="admin/gerenciar-comentario"><i class="fas fa-bars"></i> Gerenciar Comentários</a></li>
                                        </ul>
                                    </li>                                    

                                    <li class="red"><a href="admin/" class="category"> Administradores</a>
                                        <ul>
                                            <li><a href="admin/gerenciar-administradores"><i class="fas fa-users"></i> Gerenciar Administradores</a></li>
                                        </ul>
                                    </li>

                                    <li class="green"><a href="admin/" class="category"> Meus Dados</a>
                                        <ul>
                                            <li><a href="admin/me"><i class="fas fa-user"></i> Editar Dados</a></li>
                                        </ul>
                                    </li>

                                    <li class="purple"><a href="admin/sair"><i class="fas fa-user"></i> Sair</a></li>
                                </ul>
                        </div>
                    </div>
                <?php }?>
                
                <div class="col-sm">
                    <?php echo paginacao_adm();?>
                </div>
                
            </div>
        </div>
        
        <footer class="container-fluid text-center">
            <a href="#myPage" title="To Top">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
            <p><a href="" title="Criadiado por"></a></p>
        </footer>

        <!--<script>
            $(document).ready(function(){
                // Add smooth scrolling to all links in navbar + footer link
                $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
                    // Make sure this.hash has a value before overriding default behavior
                    if (this.hash !== "") {
                        // Prevent default anchor click behavior
                        event.preventDefault();

                        // Store hash
                        var hash = this.hash;

                        // Using jQuery's animate() method to add smooth page scroll
                        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 900, function(){
                    
                            // Add hash (#) to URL when done scrolling (default click behavior)
                            window.location.hash = hash;
                        });
                    } // End if
                });
                
                $(window).scroll(function() {
                    $(".slideanim").each(function(){
                        var pos = $(this).offset().top;

                        var winTop = $(window).scrollTop();
                        if (pos < winTop + 600) {
                            $(this).addClass("slide");
                        }
                    });
                });
            })
        </script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>     
        <script src="https://kit.fontawesome.com/97bdcc5c17.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="disti/trumbowyg.min.js"></script>
        <script type="text/javascript">$('#post').trumbowyg();</script>
    </body>
</html>
