// greeting
const today = new Date();
const curHr = today.getHours();

if (curHr >= 0 && curHr < 4) {
    document.querySelector("#greeting span").innerHTML = 'Good Night';
} else if (curHr >= 4 && curHr < 12) {
    document.querySelector("#greeting span").innerHTML = 'Good Morning';
} else if (curHr >= 12 && curHr < 16) {
    document.querySelector("#greeting span").innerHTML = 'Good Afternoon';
} else {
    document.querySelector("#greeting span").innerHTML = 'Good Evening';
}
// time
function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    // var s = today.getSeconds();
    const ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12;
    h = h ? h : 12;
    m = checkTime(m);
    // s = checkTime(s);
    document.getElementById('txt').innerHTML =
        h + ":" + m + ' ' + ampm;
    setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) { i = "0" + i };
    return i;
}
