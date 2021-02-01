<?php

require_once('inc/init.php');

// traitement du formulaire en post
if (isset($_POST['inscription'])) // si on clique sur connexion
{

    $resultat = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
    $resultat->execute(array('pseudo' => $_POST['pseudo']));
    $membre = $resultat->fetch();

    if ($resultat->rowCount() == 0) {
        //controles additionnels
        $nbEmpty = 0;
        foreach ($_POST as $index => $value) {
            if ($index != 'memoavatars' && $value == '') $nbEmpty++;
        }
        if ($nbEmpty > 0) {
            $msg[] = 'Il manque ' . $nbEmpty . ' information' . (($nbEmpty > 1) ? 's' : '');
        } else {
            // insertion en base d'un nouveau membre
            $result = $pdo->prepare("INSERT INTO membre VALUES (NULL, :pseudo,:mdp,:civilite," . time() . ",:avatar)");
            $result->execute(array(
                'pseudo' => $_POST['pseudo'],
                'mdp' => md5($_POST['mdp']),
                'civilite' => $_POST['civilite'],
                'avatar' => $_POST['avatar'],
            ));
            $id_membre = $pdo->lastInsertId();
        }
    } else {
        $msg[] = 'Ce pseudo est déjà réservé';
    }

    if (empty($msg)) {
        // remplir $_SESSION et rediriger vers index.php
        $_SESSION['id_membre'] = $id_membre;
        $_SESSION['pseudo'] = $_POST['pseudo'];
        header('location:index.php');
        exit();
    }
    $msg = '<div class="alert alert-danger">' . implode('<br>', $msg) . '</div>';
}


require_once('header.php');

?>

<?= (!empty($msg) ? $msg : '') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<form method="post" class="tel" action="" class="mx-4 my-4">
<body class="preload">
<div class="d-flex justify-content-center">
<div class="container">

			<div class="img">
				<div class="icon">
					
					<span></span>
					<ul>
						<i id="meche"></i>
						<i id="oreil"></i>
						<i id="chemise"></i>
						<i id="col"></i>
						<i id="u"></i>
						
					</ul>
				</div>
			</div>
            <h1>Inscription</h1>
            <form method="post" action="">
            <div class="group-form">
            <input type="text" id="pseudo" class="fat" name="pseudo" required value="<?= $_POST['pseudo'] ?? '' ?>">
                <label class="check">Pseudo</label>
				
            </div>
            <div class="group-form">
                <input type="password" class="fat" name="mdp" id="mdp" required>
                <label>Mot de passe</label>
				
            </div>

          
           <font color="grey"><h4> Choisir un avatar : </h4></font>
<div class="group-form">

<div class="d-flex justify-content-center ml-3">
<img src="avatars/bean.png" alt="av"/>
  <input type="radio" id="av" name="avatar" value="bean.png"
         checked>
  
         &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp


<img src="avatars/steve.png" alt="av"/>
  <input type="radio" id="av2" name="avatar" value="steve.png"
         checked>
            
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

        <img src="avatars/obama.png" alt="av"/>
  <input type="radio" id="av2" name="avatar" value="obama.png"
         checked>
            
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                </div>
                <div class="group-form">
<div class="d-flex justify-content-center ml-3">
<img src="avatars/rihanna.png" alt="av"/>
  <input type="radio" id="av" name="avatar" value="rihanna.png"
         checked>
  
         &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp


<img src="avatars/angelina.png" alt="av"/>
  <input type="radio" id="av2" name="avatar" value="angelina.png"
         checked>
            
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

        <img src="avatars/katy.png" alt="av"/>
  <input type="radio" id="av2" name="avatar" value="katy.png"
         checked>
            
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                
                </div>

                <div class="group-form">
<div class="d-flex justify-content-center ml-3">
<img src="avatars/michel.png" alt="av"/>
  <input type="radio" id="av" name="avatar" value="michel.png"
         checked>
  
         &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp


<img src="avatars/eli.png" alt="av"/>
  <input type="radio" id="av2" name="avatar" value="eli.png"
         checked>
            
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

        <img src="avatars/maradona.png" alt="av"/>
  <input type="radio" id="av2" name="avatar" value="maradona.png"
         checked>
            
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                
                </div>


                </div><br>

            <div class="group-form">
            <font color="grey"><h4> Genre : </h4></font>
                        <select name="civilite" class="form-control">
                            <option value="f" selected>Femme</option>
                            <option value="m" <?= (isset($_POST['civilite']) && ($_POST['civilite'] == 'm')) ? 'selected' : '' ?>>Homme</option>
                        </select>
            </div>
            
            <div class="group-form text-center">
            <input type="submit" name="inscription" value="Inscription" class="btn btn-primary">
               
                
            </div>

            <div class="group-form text-center">
              <a href="connexion.php"><div type="button" class="fat-send">Se connecter</div></a>
            </div>
            
        </form>
	
       <!-- <footer>
            <h2>MAJORDHOM</h2>
        </footer>-->
	</div>
    </div>
               

                 
    <style>


.preload * {
    -moz-transition: none !important;
    -o-transition: none !important;
    -webkit-transition: none !important;
    transition: none !important;
}

 {
    outline: none;
}
body {
    background-color: white;
    font-size: 16px; line-height: 150%;
    font-family:  Helvetica,'Source Sans Pro', sans-serif;
    color: #black;
    font-weight: normal;
    -webkit-font-smoothing: antialiased;
}
.img{
	text-align:center;
	 width:74px;
	 height:94px;
	 margin-top:-110px;
	 
}
/*icone code*/
/*coup*/
.icon {
	width:23px;
	height:31px;
	background-color:#ffd5ae;
	position:absolute;
	top:-31px;
	left:175px;
	
}
 /*face*/
.icon:before{
	content:'';
   display:block;
   width: 38px; 
   height: 57px;
   background-color: #fee2ba;
   -webkit-border-radius: 63px 63px 63px 63px / 108px 108px 72px 72px;
   border-radius:         48%  48%  52%  52%  / 40%   40%   60%  60%;
   position:absolute;
   top:-45px;
   left:-7px;

}
.icon:after{
 
  content:'';
   width: 38px; 
   height:38px;
   background-color:#00000000;
  
   border-top-left-radius:50%;
   border-top-right-radius:50%;
   border-bottom-right-radius:60%;
   border-bottom-left-radius:60%;
  border-top:16px solid #423736;
   position:absolute;
   
   top:-45px;
   left:-7px; 	 
}
/*cheveux*/
.icon span{	
	width:20px;
	height:24px;
	position:absolute;
	 border-radius: 0 0 0 100%;
  border: 0 solid transparent;
  border-left: 8px solid #423736;
  -webkit-transform-origin: right 7px;
          transform-origin: right 7px;
  -webkit-transform: rotate(40deg);
          transform: rotate(40deg);
		  bottom:30px;
		  right:17px;	 
}
.icon span:before{
	content:'';
	width:20px;
	height:10px;
	position:absolute;
	 border-radius: 0 0 0 100%;
  border: 0 solid transparent;
  border-left: 12px solid #423736;
  -webkit-transform-origin: right 7px;
          transform-origin: right 7px;
  -webkit-transform: rotate(20deg);
          transform: rotate(20deg);
		  bottom:19px;
		  left:-7px;
}
.icon span:after{
	content:'';
	width:20px;
	height:10px;
	position:absolute;
	 border-radius: 0 0 0 100%;
  border: 0 solid transparent;
  border-left: 12px solid #423736;
  -webkit-transform-origin: right 7px;
          transform-origin: right 7px;
  -webkit-transform: rotate(10deg);
          transform: rotate(10deg);
		  bottom:25px;
		  left:1px;
		  	

}
.icon #meche{
	
	width:24px;
	height:16px;
	position:absolute;
	 border-radius: 0 0 0 100%;
  border: 0 solid transparent;
  border-bottom: 10px solid #423736;
  -webkit-transform-origin: right 7px;
          transform-origin: right 7px;
  -webkit-transform: rotate(-110deg);
          transform: rotate(-110deg);
		  bottom:52px;
		  left:-1px;  
}
/*oreille*/
.icon #oreil{
	position:absolute;
	width:4px;
	height:14px;
background-color: #fee2ba;
bottom:32px;
right:28px;
border-radius:50%;
box-shadow:38px 0 #fee2ba;
 
}
/*chemise*/
.icon #chemise{
	position:absolute;
	width: 0;
	height: 0;
	border-left: 25px solid transparent;
	border-right: 25px solid transparent;
	border-bottom: 10px solid #01d3ba;
	left:-13px;
	bottom:7px;
}
.icon #chemise:before{
	content:'';
	position:absolute;
	width:23px;
	height:23px;
	border-radius:50%;
	background-color:transparent;
	border-bottom:8px solid #ffd6af;
	top:-17px;
	left:-12px;
	z-index:5;
}
.icon #chemise:after{
	content:'';
	width:63px;
	height:32px;
	background-color:#01d3ba;
	position:absolute;
	border-radius:50%;
	left:-32px;
	top:4px;
}
/*col*/
.icon #col{
	position:absolute;
width: 12px;
	height: 8px;
	
	background: #032b4f;
	-webkit-transform: rotate(40deg);
          transform: rotate(40deg);
		  top:15px;
		  left:-5px;
		  z-index:7;
}
.icon #col:before{
	content:'';
	position:absolute;
width: 12px;
	height: 8px;
	
	background: #032b4f;
	-webkit-transform: rotate(100deg);
          transform: rotate(100deg);
		  top:-12px;
		  left:15px;
		  z-index:7;
}
.icon #u{
	width:8px;
	height:20px;
	position:absolute;
	background-color:#fefcfd;
	border-radius:50%;
	bottom:-1px;
	left:7px;
	
}
/*icone fin*/

form label, .fat, .fat-send {
    -moz-transition: all 0.25s cubic-bezier(0.53, 0.01, 0.35, 1.5);
    -o-transition: all 0.25s cubic-bezier(0.53, 0.01, 0.35, 1.5);
    -webkit-transition: all 0.25s cubic-bezier(0.53, 0.01, 0.35, 1.5);
    transition: all 0.25s cubic-bezier(0.53, 0.01, 0.35, 1.5);
}

form {
	background-color:#fff;
    position: absolute; left: calc(50% - 250px); top: 20%;
    display: inline-block;
    width: 385px;
	height: 855px;
    box-sizing: border-box;
    padding: 30px 63px;
   border: 5px solid rgb(0 54 134 / 63%);
}

h1 {
    color:  rgb(0 54 134 / 73%);
    font-size: 2em; font-weight: 600;
    margin-top: 1.7em;
	margin-bottom:1.5em;
    text-align: center;
    text-transform: uppercase;
}
/*positionnement form*/
.group-form {
    position: relative;
    padding: 13px 0;
}
.group-form:first-of-type {padding-top: 0;}
.group-form:last-of-type {padding-bottom: 0;}


.fat {
    border-bottom: 1px solid #ccc;
    width: 100%;
    position: relative; z-index: 1;
    display: block;
    box-sizing: border-box;

    padding: 10px 2px;
   

    color:#5b1298;
    line-height: 0;
    font-size: 1em;
}*/
.fat:focus, .fat:valid {
 
    color: #black;
    margin-top: 30px;
}
/*mouvement*/
.fat:focus ~ label {
    -webkit-transform: translate(0, -15px);
    transform: translate(0, -15px);
  font-size:0.7em;
  color:#666;
  letter-spacing:none;
}
.fat:valid ~ label {
    -webkit-transform: translate(0, -15px);
    transform: translate(0, -15px);
   
	font-size:0.7em;
	color:#666;
	letter-spacing:none;
}
.fat:focus  {
  border-bottom: 1px solid #5b1298;
}
.fat:valid  {
   border-bottom: 1px solid #5b1298;
}
/* faire disparaitre le focus du form*/
input:focus { outline: none; }
button:focus { outline: none; }
/*.fat.error {
    border-color: #e74c3c;
}*/
button{
	border:none;
}
.fat-send {
   
    background-color:  rgb(0 54 134 / 63%);

    box-sizing: border-box;

    cursor: pointer;

    border-radius: 6px;
    padding: 15px 46px;
	margin-top:23px;
    color: #fff;
    line-height: 0;
    font-size: 0.7em;
}
.fat-send:hover {
    background-color: #8547ba;
    color: rgba(255,255,255,0.8);
}


label {
    transform-origin: left center;

    box-sizing: border-box;
    padding: 5px 10px;

    display: block;

    position: absolute;
    margin-top: -30px;
	margin-left:-9px;

    z-index: 2;
    

    color: #9999996b;
    line-height: 0;
    font-size: 1em;
	letter-spacing:1px;
}


input[type=text] {
  border-top:none ;
   border-left:none ;
    border-right:none ;
  

  -webkit-appearance: none;
}
input[type=password] {
  border-top:none ;
   border-left:none ;
    border-right:none ;
  

  -webkit-appearance: none;
}

a {
    text-decoration: none!important;
}

@media screen and (max-width: 1280px) {
.tel {
 margin-left: 61px;
 width: 100%
}
}

/*check icon*/


footer {
    width: 100%;
    font-size: 14px;
    color: rgba(255,255,255,0.2);
    text-align: center;
    position: absolute; bottom: 5px;
}


  </style>
</body>

</html>