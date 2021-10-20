var rfid_code = document.getElementById('rfid_code');
var he = document.getElementById('he');
var transport = document.getElementById('transport');
var container = document.getElementById('container');
const sizeKode = 10; //ukuran rfid kode

rfid_code.focus()
rfid_code.onblur = function () {
    setTimeout(function () {
        rfid_code.focus();
    });
};

function processRFIDCode(){
    // hanya proses kode yg sesuai ukurannya 
    if ( rfid_code.value.length != sizeKode) {
        return;
    }
    // Buat Object Ajax
    var xhr = new XMLHttpRequest();
    var cek = rfid_code.value.substring(0,2);

    if (cek == '16'){
        // Cek Kesiapan AJAX
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4 && xhr.status == 200){
                container.innerHTML = xhr.responseText;
            }
        }
        // Code 16 = Container Number
        xhr.open('GET','./ajax/container.php?keyword=' + rfid_code.value, false);
        xhr.send();

    } else if( cek == '11'){
        // Cek Kesiapan AJAX
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4 && xhr.status == 200){
                he.innerHTML = "-";
                transport.innerHTML = xhr.responseText;
            }
        }
        // Code 11 = Truck iD
        xhr.open('GET','./ajax/transport.php?keyword=' + rfid_code.value, false);
        xhr.send();

    } else if(cek == '26'){    //HE CODE...
        // Cek Kesiapan AJAX
        xhr.onreadystatechange = function() {
             if(xhr.readyState == 4 && xhr.status == 200){
                he.innerHTML = xhr.responseText;
                transport.innerHTML = "-";
             }
        }   
        
        xhr.open('GET','./ajax/he.php?keyword=' + rfid_code.value, false);
        xhr.send();
    }
}

//Tambahkan event ketika keyword ditulis
rfid_code.addEventListener('keyup', function(event) {
    processRFIDCode();
    event.preventDefault()
    return false;
});

rfid_code.addEventListener('scan', function(event) {
    processRFIDCode();
    event.preventDefault()
    return false;
});