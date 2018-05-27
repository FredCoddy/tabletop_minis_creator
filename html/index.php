<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>threejs - basic</title>  
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="node_modules/metro4-dist/css/metro-all.min.css">
        <script src="node_modules/three.js/node_modules/three/three.js"></script>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/metro4-dist/js/metro.js"></script>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- <script src=OrbitControls.js></script> -->
        <!-- <script src="OBJLoader.js"></script> -->

        <link rel="stylesheet" type="text/css" href="css/index.css"/>
        
        <!-- METRO4 DOV : https://metroui.org.ua/intro.html -->
        
    </head>
    <body>


            <?php
            // ======= MAIN ========
            
            $file_name=$_FILES['fichier']['name'];
            $Max_size = 20000000000; // size in byte  || 1 byte = 1.10^-9 Go
            $file = basename($_FILES['fichier']['name']);
            $upload_directory = '/var/www/html/uploads/'.$_FILES['fichier']['name']; // chemin vers le nouveau répertoire de stockage
            $tmp_dir = $_FILES['fichier']['tmp_name'];  
            $format = array('.stl', '.obj', '.step','.png','.jpeg');
            $extension = strrchr($_FILES['fichier']['name'],'.');
            
            // Doc code retour d'erreur : http://www.php.net/manual/en/features.file-upload.errors.php
            $error= $_FILES['fichier']['error']; // code retour d'erreur
            
            // =====================
            

                if($_FILES['fichier']['error']==0){
                    // code retour d'erreur
                    // Check si l'utilisateur a chargé un fichier  | 4 pas de fichier upload
                
                    if($_FILES['fichier']['size'] > $Max_size){
                        // Verifier la taille du fichier
                        $message = "Le fichier est trop lourd";
                    }
            
                    elseif(!in_array($extension, $format)){
                        // Verifier l'extension; se limiter aux .obj et .stl
                        $message = "Format de fichier non valide. (Veillez indiquer un fichier .stl ou .obj)";
                    }

                    // ========================
                    if($upload = move_uploaded_file($tmp_dir,$upload_directory))
                    {
                        $message = 'Upload effectué avec succès !';
                    }
                    elseif(!isset($message)) //Sinon (la fonction renvoie FALSE).
                    {
                        $message = 'Echec de l\'upload ! Erreur : '.$error;
                    }  
                }
                 
            
            ?>   



            <div class="container">
                <div style="color:red;"><p><?php if(isset($message)) echo $message; ?></p></div>
              <h3>Formulaire de contact</h3>
              <form method="POST" enctype="multipart/form-data">
            
                <div class="input-group-btn">
                <input type="file" name="fichier" value="Parcourirs">
                </div>
                <br>
            
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input id="email" type="text" class="form-control-file" name="email" placeholder="Email">
                </div>
                <br>
                <!-- <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="password" type="password" class="form-control-file" name="password" placeholder="Password">
                </div>
                <br> -->
            
                <div class="input-group">
                  <span class="input-group-addon">Texte</span>
                  <input id="msg" type="text" class="form-control-plaintext form-control-file" name="msg" placeholder="Message">
                </div>
                <br>
            
                <div class="input-group">
                <input type="submit" name="envoyer" value="Envoyer" />
                </div>
            
              </form>

    


    <canvas id="canvas"></canvas>
    
        <div  class="container">
        
            <div class="row">
                <div class="cell-md-6 clear">
                    <ul class="sidenav-m3 float-left h-auto bg-red" >
                        <li class="active" id="test">
                            <a href="#">
                                <span class="mif-home icon"></span>Accueil</a>
                        </li>
                        <li class="disabled stick-right bg-red"><a href="#"><span class="mif-cog icon"></span>Paramètres</a></li>
                        <!-- <li class="active stick-right bg-red pause"><a href="#"><span class="mif-cart icon"></span>pause</a></li> -->
                        <li class="disabled start_animation" id="animation" >
                            <a href="#">
                                <span class="mif-home icon"></span>Animation</a>
                        </li>
                        <li class="stick-left">
                            <a class="dropdown-toggle">
                                <span class="mif-user icon"></span>Modèles</a>
                            <ul class="d-menu" data-role="dropdown" style="display: none;">
                                <li id="shark_button">
                                    <a>
                                        <span>Shark</span>
                                    </a>
                                </li>
                                <li id="elfe_button">
                                    <a>
                                        <span>Elfe female</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="cell-md-6 clear" style="padding-right:50px" >
        
                    <ul class="sidenav-counter float-right h-auto">
                        <li><a><img src="icons/swordman.svg" class="menu_icons" id="test"></a></li>
                        <li><a><img src="icons/broadsword.svg" class="menu_icons" id="get_filename"></a></li>
                        <li><a><img src="icons/brutal-helm.svg" class="menu_icons"></a></li>
                        <li><a><img src="icons/shoulder-armor.svg" class="menu_icons"></a></li>
                        <li><a><img src="icons/leg-armor.svg" class="menu_icons" alt="shoulder-armor"></a></li>   
                        <li><a style="background: red; border-radius: 50%" class="menu_icons color_button" id="red"></a></li>   
                        <li><a style="background: green; border-radius: 50%" class="menu_icons color_button" id="green"></a></li>   
                        <li><a style="background: blue; border-radius: 50%" class="menu_icons color_button" id="blue"></a></li>   

                    </ul>
                </div>
            </div>
        
        </div>

    <!-- SCRIPT -->

    
    <script src="js/menu_jquery.js"></script>


</body>
</html>
