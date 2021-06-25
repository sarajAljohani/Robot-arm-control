var angles = document.getElementsByTagName('input');
var spans = document.getElementsByTagName('span');

function showAngles(){
    for(var i = 0; i<spans.length; i++){
        spans[i].innerText = angles[i].value;
    }
}
showAngles();

for (var i = 0; i < 6; i++) {

    angles[i].addEventListener("input", showAngles);

}
