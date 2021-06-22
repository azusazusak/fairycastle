const CheckDate = function () {

    const checkDate = this;
    checkDate.form = document.querySelector("form");
    checkDate.checkIn = document.getElementById("checkIn");
    checkDate.checkOut = document.getElementById("checkOut");

    checkDate.checkIn.addEventListener("change", function () {
        if (checkDate.checkOut.readOnly) {
            checkDate.checkOut.readOnly = false;
        }
        checkDate.checkOut.style.opacity = 1;
        let checkInDate = checkDate.checkIn.value;
        let checkOutDate = checkDate.checkOut.value;

        checkDate.checkOut.addEventListener("focus", function () {
            this.style.border = "2px solid #E8C547";
        });

        checkDate.checkOut.addEventListener("blur", function () {
            this.style.border = "0.02rem solid #5A9E72";
        });

        if (checkInDate >= checkOutDate) {
            checkDate.checkOut.parentNode.classList.add("dateError");
        } else {
            checkDate.checkOut.parentNode.classList.remove("dateError");
        }
    })

    checkDate.checkOut.addEventListener("change", function () {
        let checkInDate = checkDate.checkIn.value;
        let checkOutDate = checkDate.checkOut.value;
        if (checkInDate >= checkOutDate) {
            checkDate.checkOut.parentNode.classList.add("dateError");
        } else {
            checkDate.checkOut.parentNode.classList.remove("dateError");
        }
    })

    checkDate.form.addEventListener("submit", function (e) {

        let isError = checkDate.form.querySelector(".dateError");

        if (isError) {
            e.preventDefault();
        }
    })
}

new CheckDate();


