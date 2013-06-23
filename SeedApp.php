<!DOCTYPE html>
<?php
	// Did we get authorization to use services ?
	if( $_POST['login_email'] && $_POST['login_password'] )
	{
		require_once( 'backend/session_manager.php' );
		$sessionManager = new SessionManagement ;
		$sessionData = $sessionManager->startSession( $_POST['login_password'], $_POST['login_email'] ) ;
		$sKey = ( $sessionData['session']['sKey'] ) ? $sessionData['session']['sKey'] : "" ;
	}
?>

<html ng-app='SeedApp'>
<head>
	<title>AngularJS SeedApp</title>

	<!-- LIBRARIES -->
	<script src='http://ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular.js'></script>
	<!-- this jquery is a requirement for bootstrap, but dont use it yourself -->
	<script src='http://code.jquery.com/jquery-2.0.0.min.js'></script>
	<script src='lib/bootstrap.js'></script>

	<!-- STYLE / THEME -->
	<link rel='stylesheet' href='view/css/bootstrap.css'>
	<link rel='stylesheet' href='view/css/bootstrap-responsive.css'>
	
	<!-- THIS APP. -->
	<script src='SeedApp.js'></script>
	<script src='controller/LinksController.js'></script>
	<script src='controller/NotesController.js'></script>
	
	<!-- DATA SOURCES -->
	<script src='model/NoteModel.js'></script>
	<script src='model/LinkModel.js'></script>
	
	<!-- CUSTOM STUFF -->
	<script src='view/directives/NoteList.js'></script>
	
</head>


<body style="padding:4px; cellpadding:4px;" ng-init=" sKey = '<?php echo $sKey ?>' " >


<div class='navbar-inverse' >
	<div class='navbar-inner' style='padding:2px;'>
		<div class='span6 brand' style='font-size:28px; font-weight:200;'>
			<img src='view/image/AngularJS-Shield-tiny.png' alt='some_text' />ngularJS + Twitter_Bootstrap + {{sKey}}
		</div>
		

	<?php 
		// an optional header form
		if( false )
		{
			echo '<br /><div class="span2"><form class="form-inline" href="SeedApp.php" >';
			echo '<input type="text" name="login_email" placeholder="Email" class="email"><br />';
			echo '<input type="password" name="login_password" placeholder="Password" class="small"><br />';
			echo '<button type="submit" class="btn">Sign In</button>';
			echo '</form></div>';
		}
	?>
	
		<div class="dropdown span2 ng-hide: sKey == '' " >
			<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#/home.html">
			<button type="button" class="btn btn-large btn-danger" >Explore!</button></a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				<li><a href='#/' data-target="#" >Home</a></li>
				<li><a href='#/link/' data-target="#" >Technologies</a></li>
				<li><a href='#/about_us/' data-target="#" >Tab Sample</a></li>
			</ul>
		</div>

	
		<form class="navbar-search pull-right ng-pristine ng-valid" action="https://www.google.com/search" method="GET">
			<input class="search-query" type="text" placeholder="Search" name="as_q">
			<input type="hidden" value="angularjs.org" name="as_sitesearch">
		</form>
	</div>
</div>


<script> $('.dropdown-toggle').dropdown() </script>


	<!-- This is only an angular form UNTIL it has been submitted! Then it will be treated as a HTTP post form on the server side -->
	<div ng-hide="sKey"><br /></div>
	<!-- Server Side directed form -->
	<div class='well span6' ng-hide='sKey' >
		<form name='loginUserForm' action='SeedApp.php' method="post" >
			<div class='row-fluid'>
			<div class='span2'>Email : </div><div class='span2'><input type='email' name='login_email' ng-model='userEmail'    required /></div>
			</div>
    
			<div class='row-fluid'>
			<div class='span2' >Password : </div><div class='span2'><input type='password' name='login_password' ng-model='userPassword' required ng-password /></div>
			</div>
    
			<div class='row-fluid'>
			<div class='span2'></div><div class='span2'><button ng-disabled='!loginUserForm.$valid' class='btn btn-medium' >Sign In</button></div>
			</div>
		</form>
	</div>

	
	<!-- Client Side processed form with Rest service authorization -->
	<div ng-hide="sKey"><br /></div>
	<!-- Server Side directed form -->
	<div class='well span6' ng-hide='sKey' >
			<div class='row-fluid'>
			<div class='span2'>Email : </div><div class='span2'><input type='email' name='login_email' ng-model='userEmail'    required /></div>
			</div>
    
			<div class='row-fluid'>
			<div class='span2' >Password : </div><div class='span2'><input type='password' name='login_password' ng-model='userPassword' required ng-password /></div>
			</div>
    
			<div class='row-fluid'>
			<div class='span2'></div><div class='span2'>
				<button ng-disabled='!loginUserForm.$valid' class='btn btn-medium' >Sign In</button>
			</div>
			</div>
	</div>	
	
	<br />
	<div class='well span6' ng-hide='sKey' >
	<form name="form" novalidate class="login-form">
    <div class="modal-header">
        <h4>Sign in</h4>
    </div>
    <div class="modal-body">
        <div class="alert alert-warning" ng-show="authReason">
            {{authReason}}
        </div>
        <div class="alert alert-error" ng-show="authError">
            {{authError}}
        </div>
        <div class="alert alert-info">Please enter your login details</div>
        <label>E-mail</label>
        <input name="login" type="email" ng-model="user.email" required autofocus>
        <label>Password</label>
        <input name="pass" type="password" ng-model="user.password" required>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary login" ng-click="login()" ng-disabled='form.$invalid'>Sign in</button>
        <button class="btn clear" ng-click="clearForm()">Clear</button>
        <button class="btn btn-warning cancel" ng-click="cancelLogin()">Cancel</button>
    </div>
	</form>
	</div>
	
	
<div ng-view>
	<!-- Views are added here at runtime -->
	<table height="100%" ><tr><td width="100%" height="100%" align="center" valign="center">
	<img src="view/image/AngularJS-Shield-small.png" />
	</td></tr></table>
</div>
	
	
</body>
</html>
