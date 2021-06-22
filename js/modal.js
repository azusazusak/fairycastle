const Modal = function (element, imageFile) {
    const body = document.body;
    const modal = this;
    modal.element = element;
    modal.imageFile = imageFile;
    modal.container = document.createElement("div");
    modal.content = document.createElement("div");
    modal.image = document.createElement("img");
    modal.closeBtn = document.createElement("a");
    
    modal.show = function () {
        modal.container.style.display = "flex";
        body.style.overflow = "hidden";

        setTimeout(function () {
            modal.container.style.opacity = 1;
        }, 0)
    }

    modal.hide = function () {
        modal.container.style.opacity = 0;
        body.style.overflow = "visible";

        setTimeout(function () {
            modal.container.style.display = "none";
        }, 200)
    }

    modal.init = function () {
        modal.element.style.backgroundImage = "url(" + modal.imageFile + ")";
        modal.element.style.backgroundPosition = "center";
        modal.element.style.backgroundSize = "cover";
        modal.element.style.backgroundRepeat = "no-repeat";
        modal.element.style.cursor = "pointer";
        modal.element.style.transition = "opacity .1s linear";

        modal.element.addEventListener("mouseover", function () {
            modal.element.style.opacity = 0.7;
        })

        modal.element.addEventListener("mouseout", function () {
            modal.element.style.opacity = 1;
        })

        body.appendChild(modal.container);
        modal.container.style.display = "none";
        modal.container.style.opacity = 0;
        modal.container.style.position = "fixed";
        modal.container.style.top = "0px";
        modal.container.style.left = "0px";
        modal.container.style.backgroundColor = "rgba(0,0,0,.7)";
        modal.container.style.width = "100%";
        modal.container.style.height = "100%";
        modal.container.style.justifyContent = "center";
        modal.container.style.alignItems = "center";
        modal.container.style.zIndex = 200;
        modal.container.style.transition = "all .2s linear";

        modal.container.appendChild(modal.content);
        modal.content.style.position = "relative";
        modal.content.style.margin = "0 auto";

        const checkMediaQuery = function () {
            if (window.innerWidth <= 480)
            {
                console.log('S size');
                modal.content.style.maxWidth = "80vw";
                modal.content.style.maxHeight = "85vh";
            } else if (window.innerWidth > 480 && window.innerWidth <= 960) 
            {
                console.log('M size');
                modal.content.style.maxWidth = "80vw";
                modal.content.style.maxHeight = "70vh";
            } else if (window.innerWidth > 960) 
            {
                modal.content.style.maxWidth = "60vw";
                modal.content.style.maxHeight = "80vh";
                console.log('L size');
            }
        }

        window.addEventListener('load', checkMediaQuery);
        window.addEventListener('resize', checkMediaQuery);

        modal.content.appendChild(modal.image);
        modal.image.style.maxWidth = "inherit";
        modal.image.style.maxHeight = "inherit";
        modal.image.style.boxShadow = "2px 2px 6px rgba(0,0,0,.6)";

        modal.content.appendChild(modal.closeBtn);
        modal.closeBtn.classList.add("modalCloseBtn");
        modal.closeBtn.innerHTML = "Close";
        modal.closeBtn.style.textDecoration = "none";
        modal.closeBtn.style.color = "#FFFFFF";
        modal.closeBtn.style.position = "absolute";
        modal.closeBtn.style.top = "-1.8rem";
        modal.closeBtn.style.right = "0px";
        modal.closeBtn.style.cursor = "pointer";
        modal.closeBtn.style.transition = "color .1s linear";
        // modal.closeBtn.style.fontFamily = "Verdana, sans-serif";

        modal.closeBtn.addEventListener("mouseover", function () {
            modal.closeBtn.style.color = "rgba(255, 255, 255, .6)";
        })

        modal.closeBtn.addEventListener("mouseout", function () {
            modal.closeBtn.style.color = "#FFFFFF";
        })

        modal.closeBtn.addEventListener("click", function (e) {
            e.preventDefault();
            modal.hide();
        })

        modal.element.addEventListener("click", function () {
            modal.image.src = modal.imageFile;
            modal.show();
        })
    }
    modal.init();
}


let modalImages = document.querySelectorAll(".modalImage");

modalImages.forEach(function (element) {
    let imageFile = element.getAttribute("data-backgroundimage");

    new Modal(element, imageFile);
})






