$(document).ready(function () {
    let countryInput = $("#country");
    let lookupBtn = $("#lookupButton");
    let lookupCitiesBtn = $("#lookupCitiesButton");
    let searchResult = $("#result");

    lookupBtn.on("click", function () {
        $.ajax("world.php?country=" + encodeURI(countryInput.val()))
            .done(function (result) {
                searchResult.html(result);
            })
            .fail(function (result) {
                alert("An error has occured.");
            });
    });

    lookupCitiesBtn.on("click", function () {
        $.ajax("world.php?country=" + encodeURI(countryInput.val()) + "&lookup=cities")
            .done(function (result) {
                searchResult.html(result);
            })
            .fail(function (result) {
                alert("An error has occured.");
            });
    });
});