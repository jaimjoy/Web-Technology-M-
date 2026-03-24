function analyzeText() 
{
    text = document.getElementById("textInput").value;
    trimmedText = text.trim();

    if (trimmedText == "") 
    {
        document.getElementById("result").innerHTML = "Please enter some text first!";
        return;
    }

    var characters = text.length;
    var words = trimmedText.split(/\s+/);
    var wordCount = words.length;
    var reversed = text.split("").reverse().join("");

    document.getElementById("result").innerHTML =
    "<b>Character Count:</b> " + characters + "<br>" +
    "<b>Word Count:</b> " + wordCount + "<br><br>" +
    "<b>Reversed Text:</b><br>" + reversed;
}