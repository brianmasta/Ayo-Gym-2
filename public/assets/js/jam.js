function getServerTime() {
    return $.ajax({ async: false }).getResponseHeader('Date');
}
function realtimeClock() {
    var rtClock = new Date();
    // var rtClock = new Date(getServerTime());

    var hours = rtClock.getHours();
    var minutes = rtClock.getMinutes();
    var seconds = rtClock.getSeconds();

    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var thisDay = date.getDay(),
        thisDay = myDays[thisDay];
    var yy = date.getYear();
   
    

    // menampilkan AM PM
    // var amPm = (hours < 12) ? "AM" : "PM";
    // hours = (hours > 12) ? hours - 12 : hours;

    hours = ("0" + hours).slice(-2);
    minutes = ("0" + minutes).slice(-2);
    seconds = ("0" + seconds).slice(-2);
    var year = (yy < 1000) ? yy + 1900 : yy;

    document.getElementById("clock").innerHTML =
        thisDay + ", " + day + " " + months[month] + " " + year +" - "+ hours + " : " + minutes + " : " + seconds;
    // + "  " + amPm;
    var jamnya = setTimeout(realtimeClock, 500);

}
