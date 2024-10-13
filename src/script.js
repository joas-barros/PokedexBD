let dropdownToggle = document.getElementById('dropdownToggle');
let dropdownMenu = document.getElementById('dropdownMenu');

function handleClick() {
    if (dropdownMenu.className.includes('block')) {
        dropdownMenu.classList.add('hidden')
        dropdownMenu.classList.remove('block')
    } else {
        dropdownMenu.classList.add('block')
        dropdownMenu.classList.remove('hidden')
    }
}
dropdownToggle.addEventListener('click', handleClick);


// Modal ---------------------------------------------------------------------------------------------

function showModal() {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modalContent');
    const blurBackground = document.getElementById('blurBackground');

    blurBackground.style.display = 'block'; // Show the blur background
    blurBackground.classList.add('backdrop-blur'); // Apply blur effect

    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modal.classList.add('opacity-100');
        modalContent.classList.remove('opacity-0');
        modalContent.classList.add('opacity-100');
    }, 10); // Delay for transition
}

function hideModal() {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modalContent');
    const blurBackground = document.getElementById('blurBackground');

    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0');
    modalContent.classList.remove('opacity-100');
    modalContent.classList.add('opacity-0');

    // Remove blur background after modal transition
    setTimeout(() => {
        modal.classList.add('hidden');
        blurBackground.style.display = 'none'; // Hide blur background
        blurBackground.classList.remove('backdrop-blur'); // Remove blur effect
    }, 300); // Delay to match transition duration
}