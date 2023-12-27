const nav = document.getElementsByClassName('n');

function navOffset() {
	if (nav) {
		document.body.style.paddingTop = `${nav.offsetHeight}px`;
	}
}
navOffset(), window.addEventListener('resize', navOffset);

let navTop = nav.offsetTop;
window.onscroll = function () {
	window.scrollY > navTop + 100
		? nav.classList.add('n--c')
		: nav.classList.remove('n--c');
};

if (nav && nav.clientHeight) {
	document.documentElement.style.setProperty(
		'--navHeight',
		`${nav.clientHeight}px`
	);
}

function toggleMenuActiveState() {
	let elemsWithChildren = document.querySelectorAll('.menu-item-has-children');

	elemsWithChildren.forEach((elem) => {
		elem.addEventListener('click', function (event) {
			event.stopPropagation();
			this.classList.toggle('active');
		});
	});

	document.addEventListener('click', function (event) {
		if (!event.target.closest('.sub-menu')) {
			elemsWithChildren.forEach((elem) => {
				elem.classList.remove('active');
			});
		}
	});
}
toggleMenuActiveState();

const n_c = document.querySelector('.n__c');
const navElement = document.querySelector('.n-nav');
const originalParent = n_c.parentNode;
const BREAKPOINT = 1024;

function moveN_c() {
	if (
		window.innerWidth < BREAKPOINT &&
		!n_c.parentNode.isSameNode(navElement)
	) {
		navElement.appendChild(n_c);
	} else if (
		window.innerWidth >= BREAKPOINT &&
		n_c.parentNode.isSameNode(navElement)
	) {
		originalParent.appendChild(n_c);
	}
}

moveN_c();

window.addEventListener('resize', moveN_c);

function changeFontSize(event) {
	event.preventDefault();
	var newSize = event.target.getAttribute('data-font-size');
	document.body.style.fontSize = newSize;
}
