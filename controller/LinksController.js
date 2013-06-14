SeedApp.controller('LinksController', function ($scope, $location, $routeParams, LinkModel, NoteModel) {
	var links = LinkModel.getLinks();
	for (var i=0; i<links.length; i++) {
		links[i].notes = NoteModel.getNotesForLink(links[i].id);
	}

	$scope.links = links;
	$scope.selectedLinkId = $routeParams.linkId;
	
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
