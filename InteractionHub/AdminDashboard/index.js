const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

//responsive
window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

//tema gelap terang
const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});

//snackbar
let modal = document.getElementById("myModal");
let span = document.getElementsByClassName("close")[0];

function openModal(title, value) {
    document.getElementById("modalTitle").textContent = title;
    document.getElementById("modalValue").textContent = value;
    modal.style.display = "block";
    
    setTimeout(function() {
        modal.style.display = "none";
    }, 5000);
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

async function getUserData() {
    try {
        const response = await fetch('https://jsonplaceholder.typicode.com/users/1');
        const userData = await response.json();

        // Ambil template dan buat instance baru
        const template = document.getElementById('user-template');
        const userDataContainer = document.getElementById('userDataContainer');
        userDataContainer.innerHTML = ""; // Kosongkan kontainer

        // Buat salinan node template
        const userInstance = document.importNode(template.content, true);

        // Masukkan data ke dalam elemen template
        userInstance.querySelector(".name").textContent = userData.name;
        userInstance.querySelector(".username").textContent = userData.username;
        userInstance.querySelector(".email").textContent = userData.email;
        userInstance.querySelector(".phone").textContent = userData.phone;
        userInstance.querySelector(".website").textContent = userData.website;
        userInstance.querySelector(".company").textContent = userData.company.name;

        // Tambahkan instance ke kontainer
        userDataContainer.appendChild(userInstance);
    } catch (error) {
        console.error("Terjadi kesalahan:", error);
    }
}
