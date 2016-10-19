<!doctype html>
<html >
	<meta charset="UTF-8">
	<head>
		<title>AngularJs + GitHub</title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
		<script>
			var app = angular.module('app', []);
			app.controller('ctrl', function($http) {
				var vm = this;
				vm.data=false;
				vm.buscaUsers = function(user) {
				vm.loading=true;
					$http.get('https://api.github.com/users/' + user.name).then(function(res) {
						vm.data=true; 
						vm.name = res.data.name;
						vm.location = res.data.location;
						vm.avatar_url = res.data.avatar_url;
						vm.public_repos = res.data.public_repos;
						vm.login = res.data.login;
						vm.loading=false;
						

					})
				}
			})
		</script>
	</head>
	<body ng-app='app'>
		<div ng-controller="ctrl as vm">
		<label for="enter">Usuario</label>
		<input type="text" ng-model="user.name" name="enter">
		<button ng-click="vm.buscaUsers(user)">
			Buscar
		</button>
		
		<h4 ng-if="vm.loading === true">carregando</h4>
		<br><br>
		<div ng-hide="vm.data === false">
		<img src="{{vm.avatar_url}}" width="80" height="80"> 
		<h3>Nome:{{vm.name}}</h3>
		<h3>Localização:{{vm.location}}</h3>
		<a href="https://github.com/{{vm.login}}?tab=repositories" target="_black">Repositórios({{vm.public_repos}})</a>
		</div>
		</div>
	</body>
</html>