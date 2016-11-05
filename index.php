<!--
/**#################################################################
    SOUTRA.PHP , PHP CRUD creator
    Copyright (C) 2016  FABLAB AYIYIKOH, www.ayiyikoh.org
    SOUTRA.PHP is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    SOUTRA.PHP is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with SOUTRA.PHP.  If not, see <http://www.gnu.org/licenses/>.
		fablab@ayiyikoh.org

####################################################################**/
-->
<!DOCTYPE html>
<html>
	<head>
		<title>Generateur</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="moteur/scripts/bs3.3/css/bootstrap.min.css">
		<script type="text/javascript" src="moteur/scripts/do_more.js"></script>

		<style type="text/css">
			body, html{
				height: 100%;
				background: #f1f1f1;
			}
			div.box{
				position: absolute;
				width: 350px;
				background: #fff;
				padding: 10px;
				box-shadow: 0px 0px 2px 1px #ddd;
				border-radius: 7px;
				opacity: 0;
			}
			div.input-group{ margin-bottom: 10px; }
			h1.ic{ font-size: 5em; margin-bottom: 20px; color: #5CB85C; }
			h2{
				font-weight:600;
				width: 150px;
				margin: auto;
				margin-bottom:40px;
				margin-top:10px;
			}
		</style>
	</head>
	<body>

		<div class="container" style="min-height: 100%;">

			<div class="box">

				<!-- <h1 class="ic text-center"><i class="glyphicon glyphicon-cog"></i></h1> -->
				<h2 align="center"><span style="border:1px solid #ddd;border-radius:7px;padding:2px 8px 5px 5px;margin-right:-9px;background:#535353;color:#fff;">soutra.</span><span class="btn-success" style="border:1px solid #5CB85C;padding:2px 5px 5px 0px;border-radius:7px;font-weight:300;">php</span></h2>

				<form role="form" id="form" action="generateur.php" method="post">
					<div class="input-group">
  						<span class="input-group-addon search-bar-btn" id="basic-addon1"><i class="glyphicon glyphicon-cloud"></i></span>
  						<input type="text" class="form-control" placeholder="serveur" aria-describedby="basic-addon1" name="server">
					</div>
					<div class="input-group">
  						<span class="input-group-addon search-bar-btn" id="basic-addon1"><i class="glyphicon glyphicon-tasks"></i></span>
  						<input type="text" class="form-control" placeholder="base de données" aria-describedby="basic-addon1" name="bd">
					</div>
					<div class="input-group">
  						<span class="input-group-addon search-bar-btn" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
  						<input type="text" class="form-control" placeholder="nom d'utilisateur" aria-describedby="basic-addon1" name="user">
					</div>
					<div class="input-group">
  						<span class="input-group-addon search-bar-btn" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
  						<input type="password" class="form-control" placeholder="mot de passe" aria-describedby="basic-addon1" name="pass">
					</div>

					<button type="submit" class="btn btn-block btn-success" style="margin-top:20px;">Générer</button>
				</form>
					<span style="position: absolute; bottom:-30px;" class="copyright" align="center"><a href="#">par FabLab Ayiyikoh</a></span>
			</div>

		</div>

		<script type="text/javascript">
			window.onload = function(){
				_('.box').centerX().centerY().css({opacity:'1'}) ;
				_('.copyright').centerX() ;
				_('#form').onsubmit = function(){
					this.targed(function(data){
						if(data._text.trim().length==0){
							new __alert()._alert("Application générée avec succès !",{borderTopColor:'#4EB348'}) ;
							for(var i=0; i<_('input',true).length; i++){
								_('form input',true)[i].value = '' ;
							}
						}
						else{
							new __alert()._alert(data._text,{borderTopColor:'#CA3E3E'}) ;
						}
					}) ;
				} ;
			} ;
		</script>
	</body>
</html>
