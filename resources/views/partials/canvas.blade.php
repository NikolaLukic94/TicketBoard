<canvas id="canvas1" class="border-gray-900 border-b-2"></canvas>
<div id="over-canvas" class="pl-32">
    <h2 id="join">The #1 software development tool used by agile teams</h2>
    <button class="promotion transform p-4 text-white">
        Get it free
    </button>
</div>

<style>
    .promotion {
        background-color: #1a202c;
    }

    .promotion:hover {
        background-color: #fff;
        color: #1a202c;
        border: 1px solid #1a202c;
        font-weight: bold;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    #canvas1 {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 550px;
        background-color: white;
        opacity: .5;
    }

    #over-canvas {
        position: absolute;
        top: 250px;
    }

    #join {
        text-align: center;
        color: #202020;
        font-size: 2.75rem;
        font-weight: 700;
        line-height: 1.284em;
        display: block;
        margin-bottom: 16px;
    }


</style>

<script>
    const canvas = document.getElementById('canvas1');
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    let particlesArray;

    let mouse = {
        x: null,
        y: null,
        radius: (canvas.height / 80) * (canvas.width / 80)
    }

    window.addEventListener('mousemove', function (event) {
        mouse.x = event.x;
        mouse.y = event.y;
    })

    // create particle
    class Particle {
        constructor(x, y, directionX, directionY, size, color) {
            this.x = x;
            this.y = y;
            this.directionX = directionX;
            this.directionY = directionY;
            this.size = size;
            this.color = color;
        }

        // method to draw individual particle
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            ctx.fillStyle = '#B0B0B0';
            ctx.fill();
        }

        // check particle position, check mouse position, move the particle, draw the particle
        update() {
            // check if particle is still within canvas
            if (this.x > canvas.width || this.x < 0) {
                this.directionX = -this.directionX;
            }

            if (this.y > canvas.width || this.y < 0) {
                this.directionY = -this.directionY;
            }

            // check collision detection - mouse position / particle position
            let dx = mouse.x - this.x;
            let dy = mouse.y - this.y;
            let distance = Math.sqrt(dx * dx + dy * dy);
            if (distance < mouse.radius + this.size) {
                if (mouse.x < this.x < canvas.width - this.size * 10) {
                    this.x += 10;
                }

                if (mouse.x > this.x && this.x > this.size * 10) {
                    this.x -= 10;
                }

                if (mouse.y < this.y < canvas.height - this.size * 10) {
                    this.x += 10;
                }

                if (mouse.y > this.x && this.y > this.size * 10) {
                    this.x -= 10;
                }
            }

            // move particle
            this.x += this.directionX;
            this.y += this.directionY;
            // draw particle
            this.draw();
        }
    }

    // create particle array
    function init() {
        particlesArray = [];

        let numerOfParticles = (canvas.height * canvas.width) / 9000;

        for (let i = 0; i < numerOfParticles * 2; i++) {
            let size = (Math.random() * 5) + 1;
            let x = (Math.random() * ((innerWidth - size * 2) - (size * 2)) + 2);
            let y = (Math.random() * ((innerHeight - size * 2) - (size * 2)) + 2);
            let directionX = (Math.random() * 5) - 2.5;
            let directionY = (Math.random() * 5) - 2.5;
            let color = '#B0B0B0';

            particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
        }
    }

    function animate() {
        requestAnimationFrame(animate);
        ctx.clearRect(0, 0, innerWidth, innerHeight);

        for (let i = 0; i < particlesArray.length; i++) {
            particlesArray[i].update();
        }

        connect();
    }

    function connect() {
        let opacityValue = 1;

        for (let a = 0; a < particlesArray.length; a++) {
            for (let b = 0; b < particlesArray.length; b++) {
                let distance = ((particlesArray[a].x - particlesArray[b].x) * (particlesArray[a].x - particlesArray[b].x))
                    + ((particlesArray[a].y - particlesArray[b].y) * (particlesArray[a].y - particlesArray[b].y))

                if (distance < (canvas.width / 7) * (canvas.height / 7)) {
                    opacityValue = 1 - (distance / 20000)

                    // ctx.strokeStyle = 'rgba(140,85,31,' + opacityValue + ')';
                    ctx.strokeStyle = '#B0B0B0'
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                    ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                    ctx.stroke();
                }
            }
        }

    }

    // resize event
    window.addEventListener('resize', function () {
        canvas.width = innerWidth;
        canvas.height = innerHeight;
        mouse.radius = ((canvas.height / 80) * (canvas.height / 80));
        init();
    })

    // mouse out event
    window.addEventListener('mouseout', function () {
        mouse.x = undefined;
        mouse.y = undefined;
    })

    init();
    animate();

</script>

