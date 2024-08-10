let ipAddress = '192.168.4.1';
function checkCar(){
    let data=[
        {uid: "asx1casx", model: "Tracker", number: "90S110NA", color: "#000000"},
        {uid: "asd51x2ax", model: "Malibu", number: "90A777SS", color: "#FFFFFF"},
        {uid: "85as1a5", model: "Nexia 2", number: "90F322LA", color: "#F0F000"},
    ];

    let car_model = document.getElementById('car_model');
    let car_number = document.getElementById('car_number');
    let car_color = document.getElementById('car_color');

    let xhr = new XMLHttpRequest();
    let url = 'http://' + ipAddress + "/data";

    xhr.open('GET', url, true);
    xhr.send();

    xhr.onload = function() {
        if (xhr.status === 200) {
            let request = xhr.responseText;
            data.forEach(function (val){
                if(request.uid===val.uid){
                    car_model.innerHTML = val.model;
                    car_number.innerHTML = val.number;
                    car_color.styles = "background: " + val.color;
                }
            })
        }
    };
}
function OpenBarrier(){

    let xhr = new XMLHttpRequest();
    let url = 'http://' + ipAddress + '/open';

    xhr.open('GET', url, true);
    xhr.send();

    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Open");
        }
    };
}
function CloseBarrier(){

    let xhr = new XMLHttpRequest();
    let url = 'http://' + ipAddress + '/close';

    xhr.open('GET', url, true);
    xhr.send();

    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Close");
        }
    };
}

function AddCar(){
    //
}
function EditCar(uid){
    //
}
function DeleteCar(uid){
    //
}

