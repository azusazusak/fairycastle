let BackgroundImage = {

    init: function () {
        let arrImageDOMs = document.querySelectorAll("[data-backgroundimage]");

        arrImageDOMs.forEach(function (domElement) {

            let backgroundImageFile = domElement.getAttribute("data-backgroundimage");

            domElement.style.backgroundImage = "url(" + backgroundImageFile + ")";
            domElement.style.backgroundPosition = "center";
            domElement.style.backgroundSize = "cover";
            domElement.style.backgroundRepeat = "no-repeat";
        })
    }
}

BackgroundImage.init();