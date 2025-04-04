// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// radio

    document.getElementById('all').addEventListener('change', function() {
        const isChecked = this.checked; // Check if 'All' is checked
        
        // Select or deselect all checkboxes based on 'All' checkbox
        document.getElementById('water').checked = isChecked;
        document.getElementById('changing-rooms').checked = isChecked;
        document.getElementById('parking').checked = isChecked;
        document.getElementById('wifi').checked = isChecked;
    });




// location GPS
// function showMap(lat,long){
//   var coord = {lat:lat, lng:long}
//   new google.maps.Map(
//     document.getElementById("map"),
//   {
//     zoom: 10,
//     center: coord
//   });
// }
// showMap(0,0);

// function showMap(lat, lng) {
//   const myLatLng = { lat: lat, lng: lng };
//   const map = new google.maps.Map(document.getElementById("map"), {
//     zoom: 5,
//     center: myLatLng,
//   });

//   new google.maps.Marker({
//     position: myLatLng,
//     map,
//     title: "Hello Rajkot!",
//   });
// }  
