var text = "Berikut Daftar Kamar di Asrama"
var output = document.getElementById("titlekamar")

var i = 0
function typeWriter(){
    if (i < text.length){
        output.textContent += text.charAt(i);
        i++
        setTimeout(typeWriter, 50);
    }
}

typeWriter()


document.addEventListener('scroll', function () {
    const scroll = window.scrollY || document.documentElement.scrollTop;
        const gotop = document.getElementById('gotop');
        
        if (scroll > 100) {
            gotop.style.display = 'block';
        } else {
            gotop.style.display = 'none';
        }
    });

    document.getElementById('gotop').addEventListener('click', function (event) {
        event.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    });




