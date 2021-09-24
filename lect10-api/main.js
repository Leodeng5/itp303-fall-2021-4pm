



// Separate function to handle the display
function displayResults(results) {
    console.log(results);

    // Convert the JSON formatted string to JS objects! JSON.parse() converts JSON formatte STRING to JS OBJECTS
    let convertedResults = JSON.parse(results);
    console.log(convertedResults);
    // Because the results are now converted to objects, we can now easily access any properties using dot notation
    console.log(convertedResults.results[0].artistName);

    // Set the result number using API data
    document.querySelector("#num-results").innerHTML = convertedResults.resultCount;


    // Clear out previous results before adding new ones
    let tbody = document.querySelector("tbody");
    while( tbody.hasChildNodes() ) {
        tbody.removeChild(tbody.lastChild);
    }


    // For every result, dynamically generate <tr> and <td> tags
    for( let i = 0; i < convertedResults.results.length; i++) {
        let htmlString = `
        <tr>
            <td>
                <img src="${convertedResults.results[i].artworkUrl100}">
            </td>
            <td>${convertedResults.results[i].artistName}</td>
            <td>${convertedResults.results[i].trackName}</td>
            <td>${convertedResults.results[i].collectionName}</td>
            <td>
                <audio src="${convertedResults.results[i].previewUrl}" controls></audio>
            </td>
        </tr>
        `;
        // Append the htmlString to an existing element
        document.querySelector("tbody").innerHTML += htmlString;
    }
}

// Create another function to handle just the AJAX - standalone function
// 1st param: the name of the API's endpoint 
// 2nd param: the name of function that will be called when a response is received from the API
function ajaxRequest(endpoint, returnFunction) {
    // Make AJAX request to iTunes API
    // We are going to use the XMLHttpRequest() object to make AJAX requests
    let httpRequest = new XMLHttpRequest();
    
    // Create a request using .open()
    // 1st param: method. GET or POST
    // 2nd param: the endpoint aka URL
    httpRequest.open("GET", endpoint);
    // Send the request!
    httpRequest.send();

    // Create a "notification." The below function will run when iTunes sends a response to us 
    httpRequest.onreadystatechange = function() {
        // The below code will run when iTunes responds to us
        console.log("Got a response!");
        console.log(httpRequest.readyState);

        // readyState = 4 is when response from iTunes is fully ready for us to use
        if(httpRequest.readyState == 4) {
            // Check the HTTP status code to see what kind of response we got back
            if(httpRequest.status == 200) {
                // Status code 200 means success! We got something back
                console.log("success!");
                // responseText is the reponse we got back as a STRING
                console.log(httpRequest.responseText);

                // Call a function that handles the display
                returnFunction(httpRequest.responseText);
            }
            else {
                console.log("AJAX Error!");
                console.log(httpRequest.status);
            }
        }
    }

    console.log("moving along to next JS");
}

document.querySelector("#search-form").onsubmit = function(event) {
    event.preventDefault();

    // Grab the user's input
    let searchInput = document.querySelector("#search-id").value.trim();

    // Grab the limit
    let limitInput = document.querySelector("#limit-id").value;

    console.log(searchInput);
    console.log(limitInput);

    // Set the endpoint
    // encodeURIComponent() method converts your user input to URL format (e.g. changes all whitespace to %20)
    let endpoint = "https://itunes.apple.com/search?term=" + encodeURIComponent(searchInput) + "&limit=" + limitInput;

    // Call the AJAX function
    ajaxRequest(endpoint, displayResults);

}