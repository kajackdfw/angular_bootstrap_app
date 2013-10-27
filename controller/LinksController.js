SeedApp.controller('LinksController', function ($scope, $http, $location, $routeParams, LinkModel, NoteModel ) {
	
    $http.get( 'http://localhost/rest/server.php/angularJS/technologies' ).
	    success( function(data, status, headers, config ) {
			// Getting data from a Rest Server API
			for (var i=0; i<data.length; i++) {
		        data[i].notes = NoteModel.getNotesForLink( data[i].technology_id );
	        }
            $scope.links = data ;
			//alert( 'success on ' + data[2].technology_title );
        }).
        error(function(data, status, headers, config ) {
			// No Data from Rest server url, use the LinkModel instead. 
			var links = LinkModel.getLinks();
			for (var i = 0; i < links.length; i++) {
		        links[i].notes = NoteModel.getNotesForLink( links[i].technology_id );
	        }
            $scope.links = links ;
	    });
		
	$scope.selectedLinkId = $routeParams.linkId;
	
	// Yea! There is a simpler way to do this with Twitter Bootstrap alone. I will add it soon.
	if( $routeParams.tabId == null ) $routeParams.tabId = 0 ;
	$scope.tabId = $routeParams.tabId;
	if( $routeParams.tabId == 0 ) $scope.tab_0 = 'active'; else $scope.tab_0 = '';
	if( $routeParams.tabId == 1 ) $scope.tab_1 = 'active'; else $scope.tab_1 = '';
	if( $routeParams.tabId == 2 ) $scope.tab_2 = 'active'; else $scope.tab_2 = '';
	if( $routeParams.tabId == 3 ) $scope.tab_3 = 'active'; else $scope.tab_3 = '';
	
	$scope.onDelete = function(noteId) {
		var confirmDelete = confirm('Delete this note?');
		if (confirmDelete) {
			$location.path('/deleteNote/' + $routeParams.linkId + '/' + noteId);
		}
	};
});
