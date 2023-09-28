document.querySelector('#submit').addEventListener('click', function(e) {
    // Fade out the elements you want to hide
    const elementsToHide = ['.fullname', '.username', '.password', '.passwordconfirm', '.buddy', '.singupwith', '.ordiv', '.acc'];

    elementsToHide.forEach(selector => {
        const element = document.querySelector(selector);

        // After the transition is complete, hide the element by setting display to 'none'
        element.addEventListener('transitionend', function() {
            element.style.display = 'none';
        }, { once: true });

        element.style.opacity = '0';

    });

    // Fade in the elements you want to show
    const elementsToShow = ['.phone', '.bdate', '.email', '.profileimage'];

    elementsToShow.forEach(selector => {
        const element = document.querySelector(selector);
        element.style.display = 'inherit';
        if (element.classList.contains('profileimage')) {
            element.style.display = 'inline';
        }


        element.style.opacity = '1';


        // Trigger reflow to restart the opacity transition
        element.offsetWidth;


    });
});