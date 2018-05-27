<?php
            // ======= MAIN ========
            
            $Max_size = 20000000000; // size in byte  || 1 byte = 1.10^-9 Go
            $file = basename($_FILES['fichier']['name']);
            $upload_directory = '/var/www/html/uploads/'.$_FILES['fichier']['name']; // chemin vers le nouveau répertoire de stockage
            $tmp_dir = $_FILES['fichier']['tmp_name'];  
            $format = array('.stl', '.obj', '.step','.png','.jpeg');
            $extension = strrchr($_FILES['fichier']['name'],'.');
            
            // Doc code retour d'erreur : http://www.php.net/manual/en/features.file-upload.errors.php
            $error= $_FILES['fichier']['error']; // code retour d'erreur
            
            // =====================
            
                // if($_FILES['fichier']['error']==0){
                    // code retour d'erreur
                    // Check si l'utilisateur a chargé un fichier  | 4 pas de fichier upload
                
                    // if($_FILES['fichier']['size'] > $Max_size){
                    //     // Verifier la taille du fichier
                    //     $message = "Le fichier est trop lourd";
                    // }
            
                    // elseif(!in_array($extension, $format)){
                    //     // Verifier l'extension; se limiter aux .obj et .stl
                    //     $message = "Format de fichier non valide. (Veillez indiquer un fichier .stl ou .obj)";
                    // }
                        
            
                  
            
                    if($upload = move_uploaded_file($tmp_dir,$upload_directory))
                    {
                        $message = 'Upload effectué avec succès !';
                    }
                    elseif(!isset($message)) //Sinon (la fonction renvoie FALSE).
                    {
                        $message = 'Echec de l\'upload ! Erreur : '.$error;
                    }  
                // }
                // else{
                //     $message = 'Echec de l\'upload ! Erreur : '.$error;
                // }   
            
            ?>   

