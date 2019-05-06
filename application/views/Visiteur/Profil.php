<html>
    <header>
        <title>Projet</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
        
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!--<img src="<?php echo base_url();?>/assets/images/banner.jpg" width=99,27060539752006%  title="ombrage" class="redim_img"/> -->
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
                    <?php if(is_null($this->session->profil)): ?>
                        <li class="mr-4"><a href="<?php echo base_url() ?>index.php/Visiteur/Visiteur/Connecter">Se connecter</li></a>
                        <li><a href="<?php echo base_url() ?>index.php/Visiteur/Visiteur/Enregistrer">S'enregistrer</li></a>
                    <?php else: ?>
                    <li class="mr-4"><a href="<?php echo base_url() ?>index.php/Visiteur/Visiteur/Profil"><?php echo $this->session->nom.' '.$this->session->prenom ?></li></a> <!-- Deconnection client + Modif Profil -->
                        <?php if($this->session->profil == "Administrateur"): ?>
                            <li><a href="<?php echo base_url() ?>index.php/Administrateur/Administrateur/AcceuilAdmin">Partie Administrateur</a></li> <!-- Controllers Admin (ajout produit, confirm commande, etc..) -->
                        <?php else: ?>
                        <li class="mr-4"><a href="<?php echo base_url() ?>index.php/Visiteur/Visiteur/Deconnection"><?php echo 'Deconnection' ?></li></a> <!-- Deconnection client + Modif Profil -->
                        <?php endif ?>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </header>
    <body>  
        <h3> Ceci est la page profil de l'utilisateur. </h3>
        <h3> Il pourra consulter et modifier le contenu de son Panier </h3> 
        <h3> Ainsi que ces données personnelles (@mail mdp) </h3>

    
    </body>

</html>
