/* menuHamburger */
const mh = document.getElementsByClassName('n-hb')[0];

/* navigationMenu */
const nm = document.getElementsByClassName('n-nav')[0];

/* responsiveMenuHandler */
function rsp() {
	mh.classList.toggle('n-hb--a');

	if (window.getComputedStyle(ht).overflow === 'hidden') {
		ht.style.overflow = 'auto';
	} else {
		ht.style.overflow = 'hidden';
	}
}

/* Define a function to add or remove listeners based on window width */
function updateEventListeners() {
	if (window.innerWidth <= 1024) {
		mh.addEventListener('click', rsp);
		nm.addEventListener('click', rsp);
	} else {
		mh.removeEventListener('click', rsp);
		nm.removeEventListener('click', rsp);
	}
}

updateEventListeners();
window.addEventListener('resize', updateEventListeners);
