
const siteURL = fyp_site_get_url.currentSite



const modalDisplay = function () {
	const modalButton = document.querySelector('#insert-my-media')
	const modal = document.querySelector('.fyp-container')

	// Controls the tweening of the modal.
	tl = new TimelineMax({ paused: true });
	tl.to(modal, .3, { autoAlpha: 1 })
	event.preventDefault();

	// Event listener that shows modal.
	function showModal(event) {
		tl.play();
	}
	modalButton.addEventListener('click', showModal, false)

	// Closes modal when Escape key is pressed.
	document.onkeydown = function (evt) {
		evt = evt || window.event
		var isEscape = false
		if ("key" in evt) {
			isEscape = evt.key == "Escape" || evt.key == "Esc"
		} else {
			isEscape = evt.keyCode == 27
		}
		if (isEscape) {
			tl.reverse();
		}
	}


}
window.onload = modalDisplay





var number = 50;

const url = siteURL + '/wp-json/wp/v2/media/?per_page=' + number;
console.log(url)

const listMediaThumbs = function () {
	fetch(url)
		.then(
			function (response) {
				if (response.status !== 200) {
					console.log('Looks like there was a problem. Status Code: ' +
						response.status);
					return;
				}

				// Examine the text in the response
				response.json().then(function (thumbs) {
					listMediaThumbs.render(thumbs);
				});
			}
		)
		.catch(function (err) {
			console.log('Fetch Error :-S', err);
		});
}
listMediaThumbs()



/**
 * renderPost - Display posts on the page
 *
 * @param  {Array} posts Array of Posts in JSON
 */
listMediaThumbs.render = function (thumbs) {

	for (let thumb of thumbs) {
		listMediaThumbs.renderThumb(thumb);
	}
};

let thumbTitle;
let thumbLi;
let photoTitle = document.querySelector('#photo-title');
let photoAlt = document.querySelector('#photo-alt');
let thumbDetailImg = document.querySelector('.thumb-detail img');
let photoCopyright = document.querySelector('#photo-copyright');
let photoAperture = document.querySelector('#photo-aperture');
let photoShutter = document.querySelector('#photo-shutter');
let slideshowSlides = []


/**
 * renderPost - Displays an individual post on the page
 *
 * @param  {Object} post Individual post
 */
listMediaThumbs.renderThumb = function (thumb) {

	const portalUl = document.querySelector('.fyp-photo-portal ul'),
		thumbLi = document.createElement('li'),
		thumbImg = document.createElement('img'),
		thumbSource = thumb.media_details.sizes.thumbnail.source_url,
		medSource = thumb.media_details.sizes.medium.source_url,
		thumbAlt = thumb.alt_text,
		thumbTitle = thumb.title.rendered,
		thumbCopyright = thumb.media_details.image_meta.copyright,
		thumbCamera = thumb.media_details.image_meta.camera,
		sliderWrapper = document.querySelector('.swiper-wrapper'),
		sliderImage = document.createElement('img')


	var thumbAperture = thumb.media_details.image_meta.aperture
	if (thumbAperture != 0) {
		'f/' + thumb.media_details.image_meta.aperture
	} else {
		thumbAperture = ""
	}


	var thumbShutter = thumb.media_details.image_meta.shutter_speed
	if (thumbShutter != 0) {
		thumbShutter = "1/" + Math.floor(1 / thumbShutter)
	} else {
		thumbShutter = ""
	}


	thumbImg.src = thumbSource
	thumbLi.appendChild(thumbImg)
	portalUl.appendChild(thumbLi)



	loadImageData = function () {

		photoTitle.value = thumbTitle;
		photoAlt.value = thumbAlt;
		photoCopyright.value = thumbCopyright;
		photoShutter.value = thumbShutter;
		photoAperture.value = thumbAperture;
		thumbDetailImg.src = medSource;
		thumbLi.classList.add('current-thumb');


		sliderImage.src = medSource
		sliderImage.classList.add("swiper-slide")
		slideshowSlides.push(sliderImage)


		for (var i = 0; i < slideshowSlides.length; i++) {
			sliderWrapper.appendChild(slideshowSlides[i])
		}
		var mySwiper = new Swiper('.swiper-container', {
			// Optional parameters
			loop: true,
			speed: 2000,
			autoplay: true,
			effect: "fade",
			autoHeight: true,
		})

	}
	thumbLi.addEventListener("click", loadImageData)


	function leftArrowPressed() {

	}

	function nextItem() {
		thumb = thumb + 1; // increase i by one
		// thumb = thumb % thumb.length; // if we've gone too high, start from `0` again
		return thumb;
	}

	function rightArrowPressed() {
		loadImageData()
	}

	document.onkeydown = function (evt) {
		evt = evt || window.event;
		switch (evt.keyCode) {
			case 37:
				leftArrowPressed();
				break;
			case 39:
				rightArrowPressed();
				break;
		}
	};


};








var mySwiper = new Swiper('.swiper-container', {
	// Optional parameters
	loop: true,
	speed: 2000,
	autoplay: true,
	effect: "fade",
	autoHeight: true,
})


function msToTime(s) {
	var ms = s % 1000;
	s = (s - ms) / 1000;
	var secs = s % 60;
	s = (s - secs) / 60;
	var mins = s % 60;
	var hrs = (s - mins) / 60;

	return mins + ':' + secs + " minutes";
}





const width = function () {

	document.getElementById("slideLength").oninput = function () {
		myFunction()
	};

	function myFunction() {
		var val = document.getElementById("slideLength").value //gets the oninput value

		let slideTimeText = document.querySelector(".slide-time").innerHTML;
		const numLi = document.querySelectorAll("li").length;
		const slideTime = (numLi * val * 1000);
		const songLength1 = 40600;
		const songBarWidth = songLength1 / slideTime;

		document.querySelector(".slide-time").innerHTML = msToTime(slideTime);
		document.querySelector(".song").style.width = songBarWidth * 100 + "%";
		document.querySelector(".song-time").innerHTML = msToTime(songLength1);
	}

}
width();


const thumbSize = function () {
	var slider = document.querySelector("#myRange");
	var output = document.querySelector(".fyp-container ul");

	// output.style.setProperty("grid-auto-rows", slider.value + "vw"); // Display the default slider value

	// Update the current slider value (each time you drag the slider handle)
	slider.oninput = function () {
		var thumbsInRow = Math.floor(96 / this.value)
		var thumbWidth = (96 / thumbsInRow) - 0.25 + (0.25 / thumbsInRow)
		output.style.setProperty("grid-auto-rows", thumbWidth + "vw");
		// output.style.setProperty("width", (thumbsInRow * 5) + "px");
		// output.style.setProperty("grid-columns:", thumbsInRow + "fr");
		output.style.setProperty("grid-template-columns", "repeat(" + thumbsInRow + ", " + thumbWidth + "vw");
	}
}
thumbSize()


const uploadSwitch = function () {

	const portalPanel = document.querySelector('.fyp-photo-portal')
	const uploadPanel = document.querySelector('.fyp-photo-upload')
	const portalLink = document.querySelector('#portal-link')
	const uploadLink = document.querySelector('#upload-link')

	function one() {
		uploadPanel.style.display = "block"
		portalPanel.style.display = "none"
	}
	function two() {
		portalPanel.style.display = "block"
		uploadPanel.style.display = "none"
	}

	portalLink.addEventListener("click", one, false)
	uploadLink.addEventListener("click", two, false)
}
uploadSwitch()


const showHideSorter = function () {

	const settingsIcon = document.querySelector('.icon-settings');
	const sorter = document.querySelector('.sorter');

	function showSorter() {
		sorter.classList.toggle('show-sorter')
	}

	settingsIcon.addEventListener("click", showSorter, false)

}
showHideSorter()





const getMore = function () {

	const loadMoreButton = document.querySelector(".load-more")

	loadMoreButton.addEventListener("click", listMediaThumbs)

}
getMore()



const modeSwitcher = function () {

	const photoModePanel = document.querySelector('.photo-mode')
	const slideshowModePanel = document.querySelector('.slide-show-mode')
	const somethingElseModePanel = document.querySelector('.something-else-mode')
	const photoModeLink = document.querySelector('#photo-mode')
	const slideshowModeLink = document.querySelector('#slide-show-mode')
	const somethingElseModeLink = document.querySelector('#something-else-mode')

	function one() {
		photoModePanel.style.display = "flex"
		slideshowModePanel.display = "none"
		somethingElseModePanel.style.display = "none"
	}
	function two() {
		photoModePanel.style.display = "none"
		slideshowModePanel.style.display = "flex"
		somethingElseModePanel.style.display = "none"
	}
	function three() {
		photoModePanel.style.display = "none"
		slideshowModePanel.style.display = "none"
		somethingElseModePanel.style.display = "flex"
	}

	photoModeLink.addEventListener("click", one, false)
	slideshowModeLink.addEventListener("click", two, false)
	somethingElseModeLink.addEventListener("click", three, false)
}
modeSwitcher()
