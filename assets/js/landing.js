document.addEventListener("DOMContentLoaded", function() {

    var modal = document.getElementById("loginModal");
    var btn = document.getElementById("loginBtn");
    var span = document.getElementsByClassName("close")[0];


    btn.onclick = function() {
        modal.classList.add("show");
        setTimeout(function() {
            modal.style.display = "block";
        }, 10); 
    }

    //tutup modal
    span.onclick = function() {
        modal.classList.remove("show");
        setTimeout(function() {
            modal.style.display = "none";
        }, 500); 
    }

    //tutup modal dari luar kotak
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.classList.remove("show");
            setTimeout(function() {
                modal.style.display = "none";
            }, 500); 
        }
    }

    var navLinks = document.querySelectorAll('.navbar a');
    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function(e) {
            e.preventDefault(); // Menghentikan aksi default dari tautan
            var targetId = this.getAttribute('href').substring(1); // Hilangkan tanda #
            var targetElement = document.getElementById(targetId);
            targetElement.scrollIntoView({
                behavior: 'smooth' // Animasi scroll
            });
        });
    });


    const urlParams = new URLSearchParams(window.location.search);
    console.log(urlParams); // Tambahkan ini untuk memeriksa nilai urlParams di console log
    const error = urlParams.get('error');
    
    console.log(error); // Tambahkan ini untuk memeriksa nilai error di console log
    if (error === 'invalid_credentials') {
        alert("Username atau password salah. Silakan coba lagi.");
        // Atau gunakan modal atau pesan yang sesuai dengan desain Anda
    }
});
