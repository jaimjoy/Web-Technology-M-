<!DOCTYPE html>
<html>
    <body>
        <h1 id="new">"This is the JS Intro Class"</h1>
        
        <h2 id="new2">" "</h2>

        <p id="para"> Today we will learn about Dom and form validation</p>
        
        <button id="btn" onclick="greet()">click me</button>
        
        <script>
            document.getElementById("new").innerHTML="Welcome to AIUB Guys";
            document.getElementById("new2").innerHTML="Welcome to DOM Class";

            var para = document.getElementById("para");
            para.style.color="red";
            para.style.backgroundColor="green";
            para.style.fontWeight="bold";


            var b = document.getElementById("btn");
            b.style.fontSize="30px";
            var f=false;
            function greet()
            {
                alert("Hello World");
                if(f == false)
                {
                    b.style.backgroundColor="black";
                    b.style.color="white";
                    f=true;
                }
                else 
                {
                    b.style.backgroundColor="green";
                    b.style.color="white";
                    f=false;
                }
            }
        </script>
    </body>
</html>