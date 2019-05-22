let websocketPort = wsPort ? wsPort : 8080;
let conn = new WebSocket('ws://localhost:' + websocketPort);

conn.onopen = function (e) {
    console.log("Connection established!");
};

conn.onerror = function (e) {
    console.log('Connection failed!');
};

let chatWindow = document.getElementById('chatMessages');

conn.onmessage = function (e) {
    console.log(e.data);
    chatWindow.insertAdjacentHTML('afterbegin', e.data + '\n');


    let $el = $('li.messages-menu ul.menu li:first').clone();
    $el.find('p').text(e.data);
    $el.find('h4').text('Websocket user');
    $el.prependTo('li.messages-menu ul.menu');

    let cnt = $('li.messages-menu ul.menu li').length;
    $('li.messages-menu span.label-success').text(cnt);
    $('li.messages-menu li.header').text('You have ' + cnt + ' messages');
};

let button = document.getElementById('messageButton');
let messageField = document.getElementById('messageField');
button.addEventListener('click', () => {
    conn.send(messageField.value);
    messageField.value = '';
});
