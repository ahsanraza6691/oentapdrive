
// window.onload = function () {
//     const loaderWrapper = document.getElementById('loader_wrapper');
//     loaderWrapper.classList.add('exit_loader');

//     // Use timeout for delay, it should be a little more than the total time of opacity transition and split animation
//     setTimeout(() => {
//         loaderWrapper.style.display = 'none';
//     }, 5000);
// };


// amimation

function reveal() {
    var reveals = document.querySelectorAll(".reveal");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 20;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
        } else {
            reveals[i].classList.remove("active");
        }
    }
}

window.addEventListener("scroll", reveal);
window.onload = () => reveal()


//  ACCORDION


const onOpenCollapse = (id) => {
    let parentElem = document.getElementById(id);
    let contentHeight = document.getElementById(`${id}-content`).getBoundingClientRect().height;

    if (parentElem.getBoundingClientRect().height > 60) {
        parentElem.style.height = 60 + "px"
        document.getElementById(`${id}-arrow`).style.transform = 'rotate(0deg)'
    } else {
        console.log(parentElem, contentHeight + 60)
        parentElem.style.height = `${contentHeight + 60}px`
        document.getElementById(`${id}-arrow`).style.transform = 'rotate(-180deg)'
    }
}


// DETAILS SCREEN FILTERS FUNCTION


const onOpenDetailsFilter = (id, x) => {
    let elem = document.getElementById(id)

    if (elem.classList.contains('open_filters')) {
        elem.classList.remove("open_filters")
        x.classList.remove("x")


    } else {
        elem.classList.add("open_filters")
        x.classList.add("x")
    }
}


