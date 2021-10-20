// Ambil elemen elemen yang di butuhkan.

var search = document.getElementById('search');
var container = document.getElementById('container');

// Tambahkan event ketika keyword ditulis

search.addEventListener('keyup', function(){

    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek  kesiapan AJAX
    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ){
        container.innerHTML = xhr.responseText;
        }
    }

    // Eksekusi ajax
    xhr.open('GET','ajax/list_member.php?keyword=' + search.value, true);
    xhr.send();


});