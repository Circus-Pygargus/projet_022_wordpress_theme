var getLatLongButton = document.querySelector('#viok_get_coordinates_button');
var hiddenLatLongButDiv = document.querySelector('#hidden_lat_long_but_div');
var viokAddressInput = document.querySelector('#viok_address');
var viokLatitudeInput = document.querySelector('#viok_latitude');
var viokLongitudeInput = document.querySelector('#viok_longitude');

getLatLongButton.addEventListener('click', function () {
    var address = viokAddressInput.value;
    if (address !== '') {
        var xmlhttp = new XMLHttpRequest();
        var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + address;
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "[]") {
                    apiResponse = true;
                    var myArr = JSON.parse(this.responseText);
                    var latitude = myArr[0]["lat"];
                    var longitude = myArr[0]["lon"];

                    getLatLongButton.hidden = true;
                    hiddenLatLongButDiv.hidden = false;
                    viokLatitudeInput.value = latitude;
                    viokLongitudeInput.value = longitude;

    //                console.log("latitude=" + latitude + " et longitude=" + longitude);
                    
                    // display hidden div
                //    hiddenLatLongButDiv

                // A FAIRE :
                // ajouter les champs name du form dans le php

                }
                else {
                    alert("pas trouvé");
                }
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
});