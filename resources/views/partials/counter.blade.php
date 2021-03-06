<section class="counters bg-gray-800 text-white">
    <div class="container" id="box">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="100px" height="100px" class="m-auto">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <div class="counter" data-target="60000">0</div>
            <h3>Subscribers</h3>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="100px" height="100px" class="m-auto">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
            <div class="counter" data-target="15000">0</div>
            <h3>Tickets</h3>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="100px" height="100px" class="m-auto">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
            </svg>
            <div class="counter" data-target="9000">0</div>
            <h3>Projects</h3>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="100px" height="100px" class="m-auto">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
            </svg>
            <div class="counter" data-target="5000">0</div>
            <h3>Finished Projects</h3>
        </div>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Roboto', sans-serif;
        url('https://i.pinimg.com/originals/3c/24/46/3c24462450c2a902bf7e18f3d9aada81.jpg');
    }

    .container {
        max-width: 1100px;
        margin: 0 auto;
        overflow: auto;
    }

    header {
        flex: 1;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    header h1 {
        font-size: 60px;
    }

    .counters {
        color: #fff;
        padding: 40px 20px;
    }

    .counters .container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 30px;
        text-align: center;
    }

    .counters i {
        color: lightskyblue;
        margin-bottom: 5px;
    }

    .counters .counter {
        font-size: 45px;
        margin: 10px 0;
    }

    @media (max-width: 700px) {
        .counters .container {
            grid-template-columns: repeat(2, 1fr);
        }

        .counters .container > div:nth-of-type(1),
        .counters .container > div:nth-of-type(2) {
            border-bottom: 1px lightskyblue solid;
            padding-bottom: 20px;
        }
    }
</style>


<script type="text/javascript">
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    var element = document.getElementById('box');
    var elementHeight = element.clientHeight;

    document.addEventListener('scroll', runCounter);

    // check if element is in view
    function inView() {
        // get window height
        var windowHeight = window.innerHeight;
        // get number of pixels that the document is scrolled
        var scrollY = window.scrollY || window.pageYOffset;

        // get current scroll position (distance from the top of the page to the bottom of the current viewport)
        var scrollPosition = scrollY + windowHeight;
        // get element position (distance from the top of the page to the bottom of the element)
        var elementPosition = element.getBoundingClientRect().top + scrollY + elementHeight;

        // is scroll position greater than element position? (is element in view?)
        if (scrollPosition > elementPosition) {
            return true;
        }

        return false;
    }

    // animate element when it is in view
    function runCounter() {
        // is element in view?
        if (inView()) {


            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;

                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 1);
                    } else {
                        count.innerText = target;
                    }
                }

                updateCount();
            })
        }
    }


</script>
