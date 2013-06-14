SeedApp.directive('gbNoteList', function() { 
	return { 
		restrict: 'E', 
		templateUrl: 'view/directives/noteList.html',
		scope: {
			show: '=show',
			notes: '=notes',
			orderValue: '@orderBy',
			onDelete: '=deleteNoteHandler'
		}
 	};
});
