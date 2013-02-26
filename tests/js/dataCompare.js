var dataCompare = {

	defaultOptions: {
		log: 1,
		idAttribute: "id",
		lastUpdatedAttribute: "last_updated"
	},

	check: function (clientArray, serverArray, options) {
		var clientCount = clientArray.length;
		var serverCount = serverArray.length;
		
		if (options != null) {
			options = $.extend(true, this.defaultOptions, options);
		} else {
			options = this.defaultOptions;
		}

		var idAttribute = options.idAttribute;
		var lastUpdatedAttribute = options.lastUpdatedAttribute;

		var addArray = [];
		var removeArray = [];
		var updateArray = [];

		
		if (options.log) {
			console.log("Client array: ", JSON.stringify(clientArray));
			console.log("Server array: ", JSON.stringify(serverArray));
		}

		for (var i = 0; i <= clientCount - 1; i ++) {
			var clientObject = clientArray[i];
			var clientId = clientObject[idAttribute];
			var found = false;

			// Run through the list to update and remove items
			for (var j = 0; j <= serverCount - 1; j++) {
				var serverObject = serverArray[j];
				var serverId = serverObject[idAttribute];

				if (clientId == serverId) {
					var clientLastUpdated = clientObject[lastUpdatedAttribute];
					var serverLastUpdated = serverObject[lastUpdatedAttribute];
					found = true;
					
					if (clientLastUpdated < serverLastUpdated) {
						// Update now!
						updateArray.push(clientId);
						if (options.log)
							console.log("Update: ", clientObject, serverObject);
					} else {
						// Unchanged
						if (options.log)
							console.log("Unchanged: ", clientObject, serverObject);
					}
					break;
				}
			}

			if (!found) {
				// Remove from client now!
				removeArray.push(clientId);
				if (options.log)
					console.log("Remove: ", clientObject);
			}
		}

		for (var i = 0; i <= serverCount - 1; i ++) {
			var serverObject = serverArray[i];
			var serverId = serverObject[idAttribute];
			var found = false;

			// Run through the list to update and remove items
			for (var j = 0; j <= clientCount - 1; j++) {
				var clientObject = clientArray[j];
				var clientId = clientObject[idAttribute];

				if (clientId == serverId) {
					found = true;
					break;
				}
			}

			if (!found) {
				// Add to client now!
				addArray.push(serverId);
				if (options.log)
					console.log("Add: ", serverObject);
			}
		}

		return {add: addArray, remove: removeArray, update: updateArray};
	}
}