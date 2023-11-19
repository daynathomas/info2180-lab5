window.onload = function () {

    var lookupButton = document.getElementById("lookupButton");
    var countryInput = document.getElementById("countryInput");
    var resultContainer = document.getElementById("resultContainer");
    var citiesButton = document.getElementById("citiesButton");

    lookupButton.addEventListener("click", function (event) {
        event.preventDefault();

        var httpRequest = new XMLHttpRequest();
        var url = "http://localhost:8080/world.php";
        var countryInfo = countryInput.value;
        var queryParameters = '?country=' + countryInfo;

        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    var response = httpRequest.responseText;
                    resultContainer.innerHTML = response;
                } else {
                    alert("Unable to process request");
                }
            }
        };

        httpRequest.open('GET', url + queryParameters, true);
        httpRequest.send();
    });

    citiesButton.addEventListener("click", function (event) {
        event.preventDefault();

        var httpRequest = new XMLHttpRequest();
        var url = "http://localhost:8080/world.php";
        var countryInfo = countryInput.value;
        var contextDetails = '&context=cities';
        var queryParameters = '?country=' + countryInfo + contextDetails;

        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    var response = httpRequest.responseText;
                    resultContainer.innerHTML = response;
                } else {
                    alert("Unable to process request");
                }
            }
        };

        httpRequest.open('GET', url + queryParameters, true);
        httpRequest.send();
    });

};
