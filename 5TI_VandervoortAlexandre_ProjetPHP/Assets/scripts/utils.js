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
        window.location.assign("/");
    }
}

const redirigeApresXSecondes = function(secondes) {
    window.setTimeout(() => window.location.assign("/"), secondes * 1000);
}

const redirectTo = function(redirectPath) {
    window.location.assign(redirectPath);
}

const toggleTypeForm = function(val) {
    const root = document.documentElement;
    const styles = root.style;
    styles.setProperty('--visibility-classe', "none");
    styles.setProperty('--visibility-eleve', "none");

    let enableClass = val == 0 ? "classe" : "eleve";
    let disableClass = val == 0 ? "eleve" : "classe";

    let visiKey = "--visibility-" + enableClass;

    styles.setProperty(visiKey, "inherit");
    let els = root.getElementsByClassName(disableClass);
    for (let i = 0; i < els.length; i++) {
        let el = els[i];
        el.value = '';
        el.required = "";
    }

    els = root.getElementsByClassName(enableClass);
    for (let i = 0; i < els.length; i++) {
        let el = els[i];
        el.required = "required";
    }
}