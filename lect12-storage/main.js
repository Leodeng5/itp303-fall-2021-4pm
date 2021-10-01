// Code here will be executed when browser opens this file
// Grab the stored background color and name from local storage
// .getItem() returns the value of the key
// 1st param: name of the key
// .getItem() will return NULL if the key does not exist
let storedName = localStorage.getItem("name");
let storedBgColor = localStorage.getItem("bgColor");

// Check if this information exists in the local storage
if(storedName) {
    // name exists in local storage, display this string
    document.querySelector("#name-display").innerHTML = storedName;
}
if(storedBgColor) {
    document.querySelector("body").style.backgroundColor = storedBgColor;
}

// Global variable that keeps track of fruit
let fruitArray = [];

// Check if fruits exist in storage
let fruitsInStorage = localStorage.getItem("fruits");

if(fruitsInStorage) {
    console.log(fruitsInStorage);
    // fruitInStorage will be a JSON string, so let's convert this back to JS array so that it is easier for us to work with
    let fruits = JSON.parse(fruitsInStorage);

    // Add fruits to global variable fruitArray 
    fruitArray = fruits;

    console.log(fruits);

    document.querySelector("#fruitsDisplay").innerHTML = "";

    // Display all the fruits
    for(let i=0; i<fruitArray.length; i++) {
        document.querySelector("#fruitsDisplay").innerHTML += fruitArray[i] + ", ";
    }
}
else {
    document.querySelector("#fruitsDisplay").innerHTML = "No fruits are saved in local storage";
}

// Submit the fruit form
document.querySelector("#fruit-form").onsubmit = function(event) {
    event.preventDefault();
    // Grab user input
    let fruitInput = document.querySelector("#fruit").value.trim();

    // Add the user input into the fruit array
    fruitArray.push(fruitInput);
    console.log(fruitArray);

    // Store this array into local storage
    // First, convert the array into a JSON formatted string
    // Opposite of JSON.parse() is JSON.stringify()
    let fruitString = JSON.stringify(fruitArray);
    console.log(fruitString);
    localStorage.setItem("fruits", fruitString);

    // Reset the display first
    document.querySelector("#fruitsDisplay").innerHTML = "";

    // Display the array of fruits
    for(let i = 0; i<fruitArray.length; i++) {  
        document.querySelector("#fruitsDisplay").innerHTML += fruitArray[i] + ", ";
    }

}


document.querySelector("#form").onsubmit = function(event) {
    event.preventDefault();

    // Grab the user input
    let nameInput = document.querySelector("#name").value;
    let bgColorInput = document.querySelector("#bgcolor").value;

    // Save the user input into local storage
    //.setItem()
    // 1st param: name of the key in STRING
    // 2nd param: the value of the key in STRING
    localStorage.setItem("name", nameInput);
    localStorage.setItem("bgColor", bgColorInput);

    // Change the name and style the page with what the user inputted
    document.querySelector("body").style.backgroundColor = bgColorInput;
    document.querySelector("#name-display").innerHTML = nameInput;
}