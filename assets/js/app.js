let scrollComponent = (function() {
    const navToggleBtn = document.querySelector('.navbar-toggle');
    const navCollapse = document.querySelector('#navbar-collapse');

    let setupEventListener = function() {
        navToggleBtn.addEventListener('click', toggleNavCollapse);
    }

    let toggleNavCollapse = function() {
        navCollapse.classList.toggle('collapse');
    }

    return {
        init: function() {
            setupEventListener();
        }
    }
})();


let accentHandler = (function() {
    const chatlogGrid = document.querySelector('#chatlog-grid');
    const playerChatlogCards = document.querySelectorAll('.player-chatlog-card');
    const cardIconsContainers = document.querySelectorAll('.card__icon-wrapper');
    const iconContainer = document.querySelector('.icon-container');
    
    let counter = 0;

    const svgDataOutlinedIcon = '<svg class="card__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V6c0-.55.45-1 1-1h8c.55 0 1 .45 1 1v12z"/></svg>';
    const svgDataFilledIcon = '<svg class="card__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/></svg>';

    let setupEventListener = function() {
        chatlogGrid.addEventListener('click', checkClass);
        iconContainer.addEventListener('click', toggleHide);
    }
    
    let checkPlayerCards = function() {
        for (let i = 0; i < playerChatlogCards.length; i++) {
            if (playerChatlogCards[i].classList.contains('command-highlight')) {
                counter++;
            }
        }
        if (counter === playerChatlogCards.length && playerChatlogCards.length > 0) {
            iconContainer.style.animation = 'bounce-icon-infinite .25s infinite ease-in-out';
        }
    }

    let toggleHide = function() {
        if (iconContainer.classList.contains('active')) {
            iconContainer.classList.toggle('active');
            for (let i = 0; i < playerChatlogCards.length; i++) {
                if (playerChatlogCards[i].classList.contains('command-highlight')) {
                    playerChatlogCards[i].style.display = 'none';
                }
            }
            if (counter === playerChatlogCards.length && playerChatlogCards.length > 0) {
                iconContainer.style.animation = 'bounce-icon-infinite .25s infinite ease-in-out';
            }
        } else {
            iconContainer.classList.toggle('active');
            for (let i = 0; i < playerChatlogCards.length; i++) {
                if (playerChatlogCards[i].classList.contains('command-highlight')) {
                    playerChatlogCards[i].style.display = 'unset';
                }
            }
            if (counter === playerChatlogCards.length && playerChatlogCards.length > 0) {
                iconContainer.style.animation = 'none';
            }
        }
    }


    let checkClass = function(event) {
        const parentClassName = event.target.parentNode.classList[0];
        let target = {}

        if (parentClassName == 'card__icon') {
            target = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.classList;
        } else if (event.target.classList[0] == 'card__icon') {
            target = event.target.parentNode.parentNode.parentNode.parentNode.classList;
        } else {
            return;
        }

        if (target[2] == 'player-chatlog-card') {
            toggleAccentColors(target[1]);
        }
    }


    let toggleAccentColors = function(targetUUID) {
        for (let i = 0; i < playerChatlogCards.length; i++) {
            if (playerChatlogCards[i].classList[1] == targetUUID) {
                playerChatlogCards[i].classList.toggle('highlight');
                if (playerChatlogCards[i].classList.contains('highlight')) {
                    cardIconsContainers[i].innerHTML = svgDataFilledIcon;
                } else {
                    cardIconsContainers[i].innerHTML = svgDataOutlinedIcon;
                }
            }
        }
    }

    return {
        init: function() {
            setupEventListener();
            checkPlayerCards();
        }
    }
})();

scrollComponent.init();
accentHandler.init();