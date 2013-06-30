SeedApp.service('LinkModel', function() {
	
	this.getLinks = function() {
		return [{
				id: 1,
				title: 'AngularJS Home',
				url: 'https://angularjs.org'
			}, {
				id: 2,
				title: 'Angular UI',
				url: 'http://angular-ui.github.io/bootstrap/'
			}, {
				id: 3,
				title: 'Plunker UI Code Tester',
				url: 'http://plnkr.co/'
			}, {
				id: 4,
				title: 'Mongo Reference and/or Service',
				url: 'https://mongolab.com/welcome/'
			}, {
				id: 5,
				title: 'NodeJS Host',
				url: 'https://www.nodejitsu.com'
			}, {
				id: 6,
				title: 'Twitter Bootstrap',
				url: 'http://twitter.github.io/bootstrap/index.html'
			}
		]};
	});			
