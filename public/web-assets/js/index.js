$(function () {
    showDropdown()
    allSlider()
    menuToggler() 
    Fancybox.bind("[data-fancybox]", {
        buttons: [
            "slideShow",
            "thumbs",
            "zoom",
            "fullScreen",
            "share",
            "close"
        ],
        thumbs: {
            autoStart: true // Display thumbnails on open
        },
        loop: false,
        protect: true
    });
})

$(window).on("load", () => {
})

function showDropdown() {
    let buttons = document.querySelectorAll("header.desktopMenu ul.mainMenu >  li > a");

    buttons.forEach((btn) => {
        let dropdownMenu = document.querySelector(`#${btn.dataset.menu}`);

        if (dropdownMenu) {
            // Add hover (mouseenter) event to show the dropdown
            btn.addEventListener("mouseenter", () => {
                dropdownMenu.classList.add('active');
            });

            // Remove hover (mouseleave) event to hide the dropdown
            btn.addEventListener("mouseleave", () => {
                setTimeout(() => {
                    if (!dropdownMenu.matches(':hover')) {
                        dropdownMenu.classList.remove('active');
                    }
                }, 100);
            });

            // Handle mouseenter on dropdown itself to keep it active
            dropdownMenu.addEventListener("mouseenter", () => {
                dropdownMenu.classList.add('active');
            });

            // Remove the active class if the mouse leaves the dropdown menu
            dropdownMenu.addEventListener("mouseleave", () => {
                setTimeout(() => {
                    if (!btn.matches(':hover')) {
                        dropdownMenu.classList.remove('active');
                    }
                }, 100);
            });
        }
    });
}

function allSlider() {
    const brandSwiper = new Swiper(".brandSwiper", {
        slidesPerView: 4,
        loop: true,
        spaceBetween: 10,
        autoplay: {
            delay: 1500
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            575: {
                slidesPerView: 4.5,
            },
            767: {
                slidesPerView: 5.5,
            },
            991: {
                slidesPerView: 7.75,
            },
            1199: {
                slidesPerView: 7,
            },
            1366: {
                slidesPerView: 10,
            },
        },
    });
    const carsSwiper = new Swiper(".carsSwiper:not(.notCenter)", {
        slidesPerView: 1.125,
        loop: true,
        spaceBetween: 20,
        autoplay: {
            delay: 1500
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            575: {
                slidesPerView: 1.5,
            },
            768: {
                slidesPerView: 2.5,
            },
            1199: {
                centeredSlides: true,
                slidesPerView: 4,
            },
        },
    });
    const carsSwiperNotCenter = new Swiper(".carsSwiper.notCenter", {
        slidesPerView: 1.125,
        loop: true,
        spaceBetween: 20,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            575: {
                slidesPerView: 1.5,
            },
            768: {
                slidesPerView: 2.5,
            },
            1199: {
                slidesPerView: 4,
            },
        },
    });
    const carFullSwiper = new Swiper(".carFullSwiper", {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 20,
        autoplay: {
            delay: 1500
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            575: {
                slidesPerView: 1.5,
            },
            768: {
                slidesPerView: 2.5,
            },
            1199: {
                centeredSlides: true,
                slidesPerView: 4,
            },
        },
    });
    const blogSwiper = new Swiper(".blogSwiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        // autoplay: {
        //     delay: 2500
        // },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            575: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            991: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1199: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
        },
    });
    const testiSwiper = new Swiper(".testiSwiper", {
        slidesPerView: 1,
        loop: true,
        // autoplay: {
        //     delay: 2500
        // },
    });
    const sliderBanner = new Swiper(".sliderBanner", {
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 2500
        },
        parallax: true,
        speed: 1000
    });
    const adsBannerSlider = new Swiper(".adsBannerSlider", {
        slidesPerView: 2,
        spaceBetween: 10,
        loop: true,
        // autoplay: {
        //     delay: 2000
        // },
        // Navigation arrows
        navigation: {
            nextEl: '.adsBannerCont .swiper-button-next',
            prevEl: '.adsBannerCont .swiper-button-prev',
        },
    });
}

function menuToggler() {
    let btn = document.querySelector(".mobileMenu #menuToggle")
    let closeBtn = document.querySelector(".mobileMenu .closeBtn")
    let menu = document.querySelector(".mobileMenu .sideMenu")
    let mobileLinks = document.querySelectorAll('.sideMenu ul li a')
    let loginBtn = document.querySelector('.sideMenu .loginPopup')
    let allSubMenu = document.querySelectorAll('.sideMenu .subMenu')
    let filterBtn = document.getElementById("filterBtn")

    btn.addEventListener('click', () => {
        if (menu.classList.contains('active')) {
            menu.classList.remove('active')
        } else {
            menu.classList.add('active')
        }
    })

    closeBtn.addEventListener('click', () => {
        if (menu.classList.contains('active')) {
            menu.classList.remove('active')
        } else {
            menu.classList.add('active')
        }
    })

    loginBtn.addEventListener('click', () => {
        if (menu.classList.contains('active')) {
            menu.classList.remove('active')
        } else {
            menu.classList.add('active')
        }
    })

    mobileLinks.forEach((link) => {
        link.addEventListener('click', () => {
            document.querySelector(`.mobileMenu #${link.dataset.menu}`).classList.add('active')
        })
    })

    allSubMenu.forEach((menu) => {
        let subMenuCloseBtn = menu.querySelector('.subMenuCloseBtn')
        subMenuCloseBtn.addEventListener('click', () => {
            menu.classList.remove('active')
        })
    })
    if (filterBtn) {
        filterBtn.addEventListener('click', () => {
            if (document.querySelector('.filterCont').classList.contains('active')) {
                document.querySelector('.filterCont').classList.remove('active')
            } else {
                document.querySelector('.filterCont').classList.add('active')
            }
        })
    }
}

function onOpenCollapse(id) {
    let parentElem = document.getElementById(id);
    let contentHeight = document.getElementById(`${id}-content`).getBoundingClientRect().height;

    if (parentElem.getBoundingClientRect().height > 60) {
        parentElem.style.height = 60 + "px";
        document.getElementById(`${id}-arrow`).style.transform = 'rotate(0deg)';
    } else {
        // console.log(parentElem, contentHeight + 60);
        parentElem.style.height = `${contentHeight + 60}px`;
        document.getElementById(`${id}-arrow`).style.transform = 'rotate(-180deg)';
    }
}

$('.collapse_content').find('input[type="checkbox"]').on('change', function() {
    let showUpdateBtn = false;
    $(this).closest('.collapse_content').find('input[type="checkbox"]').each(function(){
        if(
            ($(this).data('state') == "checked" && !$(this).prop("checked"))
            || ($(this).data('state') == "unchecked" && $(this).prop("checked"))
        ) {
            showUpdateBtn = true
        }
    })

    $(this).closest('.collapse_content').find('.updateBtn').toggle(showUpdateBtn);
});


$('.collapse_content').find('select').on('change', function () {
    let showUpdateBtn = false;
    console.log($(this).find("option:selected").data('state') == "unselected", $(this).find("option:selected").prop("selected"))
    if(
        $(this).find("option:selected").data('state') == "selected" && !$(this).find("option:selected").prop("selected")
        || $(this).find("option:selected").data('state') == "unselected" && $(this).find("option:selected").prop("selected")
    ) {
        showUpdateBtn = true;
    }
    console.log(showUpdateBtn)
    let parentElement = $(this).closest('.custom_collapse');
    var newWidth = parentElement.outerHeight() + 40;

    if (!(parentElement.hasClass("extendedHeight"))) {
        parentElement.addClass("extendedHeight").css({"height":newWidth});
    }

    let eleCSS = showUpdateBtn ? {display:'block'} : {display:'none'}
    $(this).closest('.collapse_content').find('.updateBtn').toggle(showUpdateBtn).css(eleCSS);
})
