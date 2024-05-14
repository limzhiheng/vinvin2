<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: none; /* hide default cursor */
        }

        .container {
            text-align: center;
        }

        .cursor {
            position: fixed; /* Change to fixed position */
            width: 20px;
            height: 20px;
            background-color: transparent;
            pointer-events: none; /* ensure the cursor doesn't interfere with clicking */
            z-index: 9999; /* ensure cursor is above other elements */
        }

        .trail {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            opacity: 0;
            animation: trail 2s infinite;
        }

        @keyframes trail {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(3);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="cursor">
        <div class="trail"></div>
        <div class="trail"></div>
        <div class="trail"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cursor = document.querySelector('.cursor');
            document.addEventListener('mousemove', function(e) {
                cursor.style.left = `${e.clientX}px`;
                cursor.style.top = `${e.clientY}px`;
            });
        });
    </script>
</body>
</html>