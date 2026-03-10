<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" href="calc.css">
        <title>Calculator</title>
    </head>
    <body>
        <div id="calculator">
            <div id="buttons">

                <input type="text" id="disp" disabled><br>

                <button id="btn" onclick="clickk('7')">7</button>
                <button id="btn" onclick="clickk('8')">8</button>
                <button id="btn" onclick="clickk('9')">9</button>
                <button id="btnc" onclick="clearr()">C</button><br>

                <button id="btn" onclick="clickk('4')">4</button>
                <button id="btn" onclick="clickk('5')">5</button>
                <button id="btn" onclick="clickk('6')">6</button>
                <button id="btne" onclick="clickk('/')">÷</button><br>

                <button id="btn" onclick="clickk('1')">1</button>
                <button id="btn" onclick="clickk('2')">2</button>
                <button id="btn" onclick="clickk('3')">3</button>
                <button id="btne" onclick="clickk('*')">x</button><br>

                <button id="btn" onclick="clickk('0')">0</button>
                <button id="btne" onclick="calc()">=</button>
                <button id="btne" onclick="clickk('+')">+</button>
                <button id="btne" onclick="clickk('-')">-</button><br>

            </div>
        </div>


        <script>
            var display = document.getElementById("disp");

            function clickk(val)
            {
                display.value += val;
            }

            function clearr()
            {
                display.value = '';
            }

            function calc()
            {
                try
                {
                    display.value = eval(display.value);
                }
                catch
                {
                    display.value = 'Error';
                }
            }

        </script>
    </body>
</html>