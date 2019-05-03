<html>
    <header>
        <title>Projet</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
        
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- <img src="<?php echo base_url();?>/assets/images/banner.jpg" width=99,27060539752006%  title="ombrage" class="redim_img"/> -->
            <div class="container-fluid">
                <div class="navbar-header">
                    <h5>Nectron</h5>
                </div>
                <ul class="nav navbar-nav">
                    <li class="text-center mr-5 active"><a href="<?php echo base_url() ?>index.php/Visiteur/Visiteur/PageDAccueilVisiteur">Page d'accueil</a></li>
                    <li class="text-center "><a href="<?php echo base_url() ?>index.php/Visiteur/Visiteur/Catalogue">Catalogue</a></li>
                    <li class="text-center ml-5"><a href="<?php echo base_url() ?>index.php/Visiteur/Visiteur/APropos">A propos</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur")):?>
                            <li class="mr-4"><a href="<?php echo base_url() ?>index.php/Administrateur/Administrateur/AcceuilAdmin">Partie Administrateur </a></li> <!-- Controllers Admin (ajout produit, confirm commande, etc..) -->
                            <li class="mr-4"><a href="<?php echo base_url() ?>index.php/Visiteur/Visiteur/Deconnection">Deconnection</li></a> <!-- Deconnection client + Modif Profil -->
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </header>
    <body>  
        <h3> C'est ici que l'admin aura acces aux ajouts, a ce qui est visibles etc...</h3>

    </body>

</html>
