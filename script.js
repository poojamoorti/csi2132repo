
function host() {
var hostid = document.getElementById("id").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'id=' + hostid;
if (hostid == '') {
alert("Please Fill Out the Field");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "ajaxhostjs.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);
}
});
}
return false;
}


function guest() {
var hostid = document.getElementById("id").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'id=' + guestid;
if (guestid == '') {
alert("Please Fill Out the Field");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "ajaxguestjs.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);
}
});
}
return false;
}


function employee() {
var employeeid = document.getElementById("id").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'id=' + employeeid;
if (employeeid == '') {
alert("Please Fill Out the Field");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "ajaxemployeejs.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);
}
});
}
return false;
}


function guestlookup() {
var min = document.getElementById("min").value;
var max = document.getElementById("max").value;
var city = document.getElementById("city").value;
var province = document.getElementById("province").value;
var country = document.getElementById("country").value;
var checkin = document.getElementById("checkin").value;
var checkin = document.getElementById("checkout").value;

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'min=' + min + '&max=' + max + '&city=' + city + '&province=' + province + '&country=' + country + '&checkin=' + checkin +'&checkout=' + checkout;

if (min == '' || max == '' || city == '' || province == '' || country == '' || checkin == '' || checkout == '') {
alert("Please Fill Out the Field");

//} else if (Date.parse(checkin) > Date.parse(checkout)) {
//alert("End date cannot be before start date.");

} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "ajaxguestlookupjs.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);
}
});
}
return false;
}


function review() {
var propertyid = document.getElementById("propertyid").value;
var guestid = document.getElementById("guestid").value;
var ratingvalue = document.getElementById("ratingvalue").value;
var communication = document.getElementById("communication").value;
var cleanliness = document.getElementById("cleanliness").value;

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'propertyid=' + propertyid + '&guestid=' + guestid + '&ratingvalue=' + ratingvalue + '&communication=' + communication + '&cleanliness=' + cleanliness;
if (propertyid  == '' || guestid == '' || ratingvalue == '' || communication == '' || cleanliness == '') {
alert("Please Fill Out the Field");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "ajaxreviewjs.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);
}
});
}
return false;
}