var newConfig = function($routeProvider) { 
	$routeProvider
		.when('/', {
			controller: 'LinksController',
			templateUrl: 'view/home.html'
		})
		.when('/home/', {
			controller: 'LinksController',
			templateUrl: 'view/home.html'
		})
		.when('/login/', {
			controller: 'LinksController',
			templateUrl: 'view/forms/login.html'
		})
		.when('/about_us', {
			controller: 'LinksController',
			templateUrl: 'view/about_us.html'
		})
		.when('/about_us/tab/:tabId', {
			controller: 'LinksController',
			templateUrl: 'view/about_us.html'
		})
		.when('/login_profile', {
			controller: 'LinksController',
			templateUrl: 'view/forms/login.html'
		})
		.when('/link/:linkId', {
			controller: 'LinksController',
			templateUrl: 'view/links.html'
		})
		.when('/addNote/:linkId', {
			controller: 'AddNoteController',
			templateUrl: 'view/forms/addNote.html'
		})
		.when('/deleteNote/:linkId/:noteId', {
			controller: 'DeleteNoteController',
			templateUrl: 'view/forms/addNote.html'
		})
	;
};

var SeedApp = angular.module('SeedApp',[]).config(newConfig);

