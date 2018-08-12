ymaps.ready(function () {
	var myMap = new ymaps.Map("yaMaps", {
		center: [54.737138, 55.976634],
		zoom: 17
	}),
	myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
		hintContent: '',
		balloonContent: ''
	}, {
		iconLayout: 'default#image',
		iconImageHref: map_pin_folder + '/img/svg/geolocation.svg', //adv/vs/wp-content/themes/advocats/img/svg/geolocation.svg
		iconImageSize: [57, 82],
		iconImageOffset: [-105, 0]
	});

	myPlacemark2 = new ymaps.Placemark(myMap.getCenter(), {
		hintContent: '',
		balloonContent: ''
	}, {
		iconLayout: 'default#image',
		iconImageHref: map_pin_folder + '/img/icons/pin_arrow.png', //adv/vs/wp-content/themes/advocats/img/icons/pin_arrow.png
		iconImageSize: [17, 24],
		iconImageOffset: [-70, 105]
	});

	myMap.behaviors.disable(['scrollZoom']);
	myMap.geoObjects.add(myPlacemark).add(myPlacemark2);
});