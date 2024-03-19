const delAccountPrompt = function() {
    let site = prompt("Please enter your password to confirm");
    if (site != null) {
        let f = document.createElement("form");
        f.action = "/del";
        f.method = "POST";
        f.target = "_self";

        let i = document.createElement("input");
        i.type="hidden";
        i.name="pass";
        i.value= site;
        f.appendChild(i);

        document.body.appendChild(f);

        let xhr = new XMLHttpRequest()
        xhr.open('POST', "/del", true);
        xhr.send(new FormData(f));
        window.location.href = "/";
    }
}