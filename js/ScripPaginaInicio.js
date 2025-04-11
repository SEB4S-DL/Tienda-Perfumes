document.addEventListener('DOMContentLoaded', function() {
   
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    let currentSlide = 0;
    
    function showSlide(index) {
        slides.forEach(slide => {
            slide.classList.remove('current');
        });
        
        slides[index].classList.add('current');
        currentSlide = index;
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            currentSlide--;
            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }
            showSlide(currentSlide);
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            currentSlide++;
            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }
            showSlide(currentSlide);
        });
    }
    
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
        
        dropdownToggle.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                dropdown.classList.toggle('active');
                
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown && otherDropdown.classList.contains('active')) {
                        otherDropdown.classList.remove('active');
                    }
                });
            }
        });
    });
    
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!e.target.closest('.dropdown')) {
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        }
    });
    
    const searchForm = document.querySelector('.search-bar');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchTerm = this.querySelector('input').value;
            if (searchTerm.trim() !== '') {
                alert('Buscando: ' + searchTerm);
            }
        });
    }
    
    const navLinks = document.querySelectorAll('.main-menu > li > a:not(.dropdown-toggle)');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    const dropdownLinks = document.querySelectorAll('.dropdown-menu a');
    dropdownLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            alert('Navegando a: ' + this.textContent);
            
            const parentDropdown = this.closest('.dropdown');
            const dropdownToggle = parentDropdown.querySelector('.dropdown-toggle');
            const originalText = 'Perfumes';
            
            sessionStorage.setItem('selectedPerfumeCategory', this.textContent);
            
            
            if (window.innerWidth <= 768) {
                parentDropdown.classList.remove('active');
            }
        });
    });
    
    const selectedCategory = sessionStorage.getItem('selectedPerfumeCategory');
    if (selectedCategory) {
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const originalText = 'Perfumes';
        
    }
});