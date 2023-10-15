const route = (event) => {
    event = event || window.event;
    event.preventDefault();
    window.history.pushState({}, "", event.target.href);
    handleLocation();
};

const handleLocation = async () => {

    const possibilities = [
        "http://localhost", 
        "http://www.siacond.com.br",
        "https://www.siacond.com.br"
    ];

    let url = window.location.href,
        index = possibilities.findIndex((x) => url.indexOf(x) > -1),
        uri = url.replace(possibilities[index], '')
    ;

    document.getElementById("main-page").innerHTML = '';

    if((uri == '/' || !uri.length)){
        document.querySelectorAll(`script[route]`).forEach((script) => script.remove()); 
        window.history.pushState({}, "", "/home");
        uri = '/home';
    }

    let response = await fetch(uri).then((data) => data.text()),
        html = response.substring(0, response.indexOf(`<script async`)),
        script = response.substring(response.indexOf(`<script async`), response.length)
    ;

    setTimeout(()=>{
        document.querySelectorAll(`script[route]:not([route="${uri}"])`).forEach((script) => script.remove()); 
        document.getElementById("main-page").innerHTML = html;

        let container = document.body,
            range = document.createRange()
        ;

        container.appendChild(range.createContextualFragment(script));
    }, 150);
};

window.onpopstate = handleLocation;
window.route = route;
handleLocation();
