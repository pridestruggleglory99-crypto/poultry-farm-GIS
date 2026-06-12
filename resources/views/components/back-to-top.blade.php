<!-- BACK TO TOP -->
<button
    id="backToTopBtn"
    class="
        fixed
        bottom-5
        right-5
        sm:bottom-6
        sm:right-6
        z-50
        hidden
        items-center
        justify-center
        w-12
        h-12
        rounded-full
        bg-blue-500
        hover:bg-blue-600
        active:bg-blue-700
        text-white
        shadow-lg
        transition-all
        duration-300
    "
>

    <i class="fa-solid fa-arrow-up text-sm"></i>

</button>

<script>

    const backToTopBtn =
        document.getElementById('backToTopBtn');

    window.addEventListener('scroll', () => {

        if (window.scrollY > 300) {

            backToTopBtn.classList.remove('hidden');
            backToTopBtn.classList.add('flex');

        } else {

            backToTopBtn.classList.add('hidden');
            backToTopBtn.classList.remove('flex');

        }

    });

    backToTopBtn.addEventListener('click', () => {

        window.scrollTo({

            top: 0,
            behavior: 'smooth'

        });

    });

</script>