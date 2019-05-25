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
    let inputMessage = JSON.parse(e.data);
    chatWindow.insertAdjacentHTML('afterbegin', inputMessage.text + '\n');


    let $el = $('li.messages-menu ul.menu li:first').clone();
    $el.find('p').text(inputMessage.text);
    $el.find('h4').text(inputMessage.name);
    $el.prependTo('li.messages-menu ul.menu');

    let cnt = $('li.messages-menu ul.menu li').length - 1;
    $('li.messages-menu span.label-success').text(cnt);
    $('li.messages-menu li.header').text('You have ' + cnt + ' messages');
};

let button = document.getElementById('messageButton');
let messageField = document.getElementById('messageField');
button.addEventListener('click', () => {
    chatWindow.insertAdjacentHTML('afterbegin', messageField.value + '\n');
    let message = {
        name: userName,
        text: messageField.value
    };
    conn.send(JSON.stringify(message));
    messageField.value = '';
});
