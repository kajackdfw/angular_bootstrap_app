SeedApp.service('NoteModel', function() {

	this.getNotesForLink = function(linkId) {
		var link = JSON.parse(window.localStorage.getItem(linkId));
		if(!link) {
			return [];
		}
		return link.notes;
	};

	this.addNote = function(linkId, noteContent) {
		var now = new Date();
		var note = { content: noteContent, id: now };
		var link = JSON.parse(window.localStorage.getItem(linkId));

		if (!link) {
			link = { technology_id: linkId, notes: [] }
		}

		link.notes.push(note);
		window.localStorage.setItem(linkId, JSON.stringify(link));
	};

	this.deleteNote = function(linkId, noteId) {
		var link = JSON.parse(window.localStorage.getItem(linkId));

		if (!link || !link.notes) {
			return;
		}

		for (var i=0; i<link.notes.length; i++) {
			if (link.notes[i].id === noteId) { 
				link.notes.splice(i, 1);
				window.localStorage.setItem(linkId, JSON.stringify(link));
				return;
			}
		}
	};
});
