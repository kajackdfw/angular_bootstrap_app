SeedApp.service('LinkModel', function() {
	
	this.getLinks = function() {

       <!-- return $http.jsonp('http://localhost/rest/server.php/angularJS/technologies'); -->

		return [{
				technology_id: 1,
				technology_title: 'AngularJS Home',
				technology_url: 'https://angularjs.org'
			}, {
				technology_id: 2,
				technology_title: 'Angular UI',
				technology_url: 'http://angular-ui.github.io/bootstrap/'
			}, {
				technology_id: 3,
				technology_title: 'Plunker UI Code Tester',
				technology_url: 'http://plnkr.co/'
			}, {
				technology_id: 4,
				technology_title: 'Mongo Reference and/or Service',
				technology_url: 'https://mongolab.com/welcome/'
			}, {
				technology_id: 5,
				technology_title: 'NodeJS Host',
				technology_url: 'https://www.nodejitsu.com'
			}, {
				technology_id: 6,
				technology_title: 'Twitter Bootstrap',
				technology_url: 'http://twitter.github.io/bootstrap/index.html'
			}
		]};
	});
